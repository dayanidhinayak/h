<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
$getcompany=mysql_query("select * from `area` group by `area`")or die(mysql_error());
while($rescompany=mysql_fetch_array($getcompany))
{
$getemails[] = array(
'value'  =>$rescompany['area'],
'idval' => $rescompany['slno']
	);
}

$getcust=mysql_query("select * from `area`")or die(mysql_error());
while($rescust=mysql_fetch_array($getcust))
{
$getemai[] = array(
'value'  =>$rescust['introducer_id'],
'idval' => $rescust['introducer_name'],
'area' => $rescust['area'],
'slno' => $rescust['slno']
	);
}
$getvendor=mysql_query("select * from `vendor`  where `type` NOT LIKE '0'")or die(mysql_error());
   while($resvendor=mysql_fetch_array($getvendor))
    {
	$getemvendor[] = array(
	'value'  => $resvendor['name'].$resvendor['slno'],
	'idval' => $resvendor['slno'],
	'add' => $resvendor['address'],
	'balance' => $resvendor['balance']
	);
    }
    $getproduct=mysql_query("select * from `product`")or die(mysql_error());
   while($resproduct=mysql_fetch_array($getproduct))
    {
	$getemproduct[] = array(
	'value'  => $resproduct['prod_name'],
	'idval' => $resproduct['barcode']
	);
    }
	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..::Shop::..</title>
<style>
.textbox {
    width: 100px;
}
html{ height:100%;}
body{ height:100%;}
</style>
<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
 <!--autocomplete end-->
  <script type="text/javascript"> 
    $(function(){
	 //jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemvendor); ?>;
        $('#customer').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#customer').val(valshow);
		 $('#custid').val(ui.item.idval);
		 $('#address').val(ui.item.add);
		 $('#due').val(ui.item.balance);
		}
		
        });
});
    
     $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemproduct); ?>;
        $('#fproduct').autocomplete({
		maxResults: 10,
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
  
},
        source: function(request, response) {
        var results = $.ui.autocomplete.filter(availabledrugs, request.term);
        
        response(results.slice(0, this.options.maxResults));
    },
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#fproduct').val(valshow);
		 $('#fbarcode').val(ui.item.idval);
		 addRow('table1');
		 $('#fproduct').val("");
		 $('.quantity').addClass(barcode);
		}
        });
		
		
$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
  </script>
  <script>
   $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemails); ?>;
        $('#locatio').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#locatio').val(valshow);
		 $('#hdlocatio').val(ui.item.idval);
        return false;
		}
        });
});
    
     $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemai); ?>;
        $('#introducer').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#introducer').val(valshow);
		 $('#introid').val(ui.item.idval);
		 $('#locatio').val(ui.item.area);
		 $('#hdlocatio').val(ui.item.slno);
        return false;
		}
        });
});
  </script>



<script language="javascript">
function addRow(tableID){
var table=document.getElementById(tableID);
var rowCount=table.rows.length;
var lastRow = table.rows[ table.rows.length - 1 ];
rowCount1=lastRow.id-0+1;
var row=table.insertRow(rowCount);
        row.id=rowCount;
var cell0=row.insertCell(0);
var cell1=row.insertCell(1);
var element0=document.createElement("input");
        element0.type="button";
        element0.value="-";
        element0.name="sell["+rowCount1+"][minus]";
        element0.id="minus"+rowCount1;
        element0.className="minus textbox";
        cell0.appendChild(element0);
        $(element0).click( function(){  document.getElementById("table1").deleteRow(this.parentNode.parentNode.rowIndex); });
var element1=document.createElement("input");
        element1.type="text";
        element1.name="sell["+rowCount1+"][barcode]";
        element1.id="barcode"+rowCount1;
        element1.setAttribute('elementid',rowCount);
        element1.className="barcode textbox";
        cell1.appendChild(element1);
         $('#barcode'+rowCount1).blur( function(){  barcode(rowCount); });
var cell2=row.insertCell(2);
var element2=document.createElement("input");
        element2.type="text";
        element2.name="sell["+rowCount1+"][product]";
        element2.id="product"+rowCount1;
        element2.className="product textbox";
        cell2.appendChild(element2);
        $('#product'+rowCount1).blur( function(){  product(rowCount); });
var cell3=row.insertCell(3);
var element3=document.createElement("input");
        element3.type="text";
        element3.name="sell["+rowCount1+"][quantity]";
        element3.id="quantity"+rowCount1;
        element3.className="quantity textbox";
        cell3.appendChild(element3);
	$('#quantity'+rowCount1).blur( function(){  totalhd(rowCount); });
var cell4=row.insertCell(4);
var element4=document.createElement("input");
        element4.type="text";
        element4.name="sell["+rowCount1+"][price]";
        element4.id="price"+rowCount1;
        element4.className="price textbox";
        cell4.appendChild(element4);
var cell5=row.insertCell(5);
var element5=document.createElement("input");
        element5.type="text";
        element5.name="sell["+rowCount1+"][discount]";
        element5.id="discount"+rowCount1;
        element5.className="discount textbox";
        cell5.appendChild(element5);
	$('#discount'+rowCount1).blur( function(){  Tafterdiscount(rowCount); });
var cell6=row.insertCell(6);
var element6=document.createElement("input");
        element6.type="text";
        element6.name="sell["+rowCount1+"][total]";
        element6.id="total"+rowCount1;
        element6.className="total textbox";
        cell6.appendChild(element6);
	$('#total'+rowCount1).blur( function(){  adall(); });
var cell7=row.insertCell(7);
var element7=document.createElement("input");
        element7.type="hidden";
        element7.name="sell["+rowCount1+"][uid]";
        element7.id="uid"+rowCount1;
        element7.className="uid textbox";
        cell7.appendChild(element7);
        cell7.setAttribute("hidden", true);
var cell8=row.insertCell(8);
var element8=document.createElement("input");
        element8.type="hidden";
        element8.name="sell["+rowCount1+"][pid]";
        element8.id="pid"+rowCount1;
        element8.className="pid textbox";
        cell8.appendChild(element8);
        cell8.setAttribute("hidden", true);
var cell9=row.insertCell(9);
var element9=document.createElement("input");
        element9.type="hidden";
        element9.name="sell["+rowCount1+"][pric]";
        element9.id="pric"+rowCount1;
        element9.className="pric textbox";
        cell9.appendChild(element9);
        cell9.setAttribute("hidden", true);
var cell10=row.insertCell(10);
var element10=document.createElement("input");
        element10.type="hidden";
        element10.name="sell["+rowCount1+"][cid]";
        element10.id="cid"+rowCount1;
        element10.className="cid textbox";
        cell10.appendChild(element10);
	cell10.setAttribute("hidden", true);
var cell11=row.insertCell(11);
var element11=document.createElement("input");
        element11.type="hidden";
        element11.name="sell["+rowCount1+"][totalhd]";
        element11.id="totalhd"+rowCount1;
        element11.className="totalhd textbox";
        cell11.appendChild(element11);
	cell11.setAttribute("hidden", true);
var cell12=row.insertCell(12);
var element12=document.createElement("input");
        element12.type="hidden";
        element12.name="sell["+rowCount1+"][stockquntity]";
        element12.id="stockquntity"+rowCount1;
        element12.className="stockquntity textbox";
        cell12.appendChild(element12);
	cell12.setAttribute("hidden", true);
var fbarcode=$('#fbarcode').val();
if (fbarcode!="") { $('#fbarcode').val(""); $('#barcode'+rowCount).val(fbarcode);barcode(rowCount);}
$('#barcode'+rowCount1).focus();
        }
        
function barcode(barcodeid)
{
     var bar=$('#barcode'+barcodeid).val();
     var custid=$('#custid').val();
    $.ajax({url:"sell_ajax.php?bar="+bar,success:function(result)
		 {
                    var obj = JSON.parse(result);
		    $("#barcode"+barcodeid).val(obj.barcode);
		    $("#product"+barcodeid).val(obj.prod_name);
		    $("#uid"+barcodeid).val(obj.uniqueid);
		    $("#pid"+barcodeid).val(obj.product_id);
		    $("#pric"+barcodeid).val(obj.price);

		    $("#quantity"+barcodeid).val(1);
		    $("#price"+barcodeid).val(obj.price);
		    $("#total"+barcodeid).val(obj.price);
		    $("#cid"+barcodeid).val(custid);
		    $("#stockquntity"+barcodeid).val(obj.quantity);
		 }});
    addall();
}

function totalhd(totval)
{
    var quantity=$('#quantity'+totval).val();
    var price=$('#price'+totval).val();
    var classval=$('#barcode'+totval).val();
    var stockquntity=$('#stockquntity'+totval).val();
    var add = 0; 
                $("."+classval).each(function() { 
		add += Number($(this).val()); 
                });
	if(add>stockquntity){ alert("insert less quntity"); $('#quantity'+totval).val(""); return false;}	
		
    
    if (quantity!="" && price!="")
    {
	var totamount=parseInt(quantity)*parseFloat(price);
	$("#total"+totval).val(totamount);
	$("#totalhd"+totval).val(totamount);
	addall();
    }
}

function Tafterdiscount(disval)
{
    var bdis=$("#totalhd"+disval).val();
    var dis=$("#discount"+disval).val();
    if (dis!="")
    {
	totalafterdiscount=parseFloat(bdis)-(bdis*(dis/100));
	//alert(totalafterdiscount);
	$("#total"+disval).val(totalafterdiscount);
	addall();
    }
}


function addall() {
                var add = 0; 
                $(".total").each(function() { 
		add += Number($(this).val()); 
                }); 
                $("#alltotal").text(add);
		$("#alltotal").val(add);
	  }

function checkform() {
    
    var table=document.getElementById('table1');
    var form=document.getElementById('f');
    form.appendChild(table);

    //code
}

</script>

<!--datepicker start--->
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			
		});
		new JsDatePick({
			useMode:2,
			target:"inputField1",
			dateFormat:"%Y-%m-%d"
			
		});
	};
</script>
<!--datepicker end--->
<link href="style.css?=werdfdt" rel="stylesheet" type="text/css"  />

<link rel="stylesheet" href="css/reveal.css?=dfgfgd">	
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<style>
.product{ width:150px !important;}
.quantity{width:150px !important;}
.textbox {
height:18px;
padding-left: 8px;
font-size: 14px;
color: #333;
border: 1px solid #CCC;
background: none repeat scroll 0% 0% #FFF;
    width:90%;
}
</style>
<script>
		function validate()
		{
		var name=document.getElementById('name').value;
		var phonee=document.getElementById('phone').value;
		var emailid=document.getElementById('email').value;
		var fatname=document.getElementById('fatname').value;
		var address=document.getElementById('addr').value;
		var introducer=document.getElementById('introducer').value;
		
		var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
		if(name=="")
		{
		alert("enter a name");
		return false;
		}
		if(phonee=="")
		{
		alert("enter contact number");
		return false;
		}
		if(phonee.length<10)
	{
	 alert("Enter 10 digit contact number");

			return false;
	}
	if(phonee.length>10)
	{
	 alert("Enter 10 digit contact number");

			return false;
	}
	if(fatname=="")
		{
		alert("enter father name");
		return false;
		}
		if(address=="")
		{
		alert("enter address");
		return false;
		}
		if(introducer=="")
		{
		alert("enter introducer");
		return false;
		}
		}
		</script>
  <script  type='text/javascript'>
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>

</head>

<body style="background:#f1f1f1; overflow:hidden;">
<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->

<div id="content1">
<table>

        <tr>
                <td> <a href="#" class="big-link" data-reveal-id="myModal1"  data-animation="fade" style="text-decoration:none; color:#333;">Customer Id</a> </td>
               <!-- <td> Category </td>
                <td> Name </td>-->
		<td> Product </td>
		<td> Barcode </td>
                <td>&nbsp;</td>

        </tr>
        <tr>
                <td> <input type="text" name="customer" id="customer" class="barcode form"> </td>
		<input type="hidden" name="custid" id="custid" class="barcode form">
		<input type="hidden" name="address" id="address" class="barcode form">
                <!--<td> <input type="text" name="category" id="category" > </td>
                <td> <input type="text" name="name" id="name" > </td>-->
                <td> <input type="text" name="fproduct" id="fproduct" class="form"> </td>
		<td> <input type="text" name="fbarcode" id="fbarcode" onblur="addRow('table1')" class="form"> </td>
                <td>&nbsp;</td>

        </tr>
      
</table>
</div>


<div id="content2" style="height:70%; overflow:auto;">                  
<table class="table2" style="text-align:center;">
    <form name="f" action="sell_insert.php" method="post" onsubmit="checkform()" id="f" >
	<div style="width:100%; height:auto; float:left; margin-bottom:10px;">
				 <span style="float:left;"><input type="button" onclick="addRow('table1')" value="addrow" class="button"></span>
				<span style="float:left; margin-left:10px;"><input type="submit" name="submit" value="insert" onsubmit="form1.appendChild(table1)" class="button"></span>
				<span style="float:left; margin-left:10px;"> <span style="float:left; margin-right:8px;">Previous Due</span> <input type="text" name="due" id="due" class="form" /></span>
				<span style="float:left; margin-left:10px;"> <span style="float:left; margin-right:8px;">Cash</span><input type="text" name="cash" id="cash" class="form"  /></span>
				<span style="float:left; margin-left:10px;"> <span style="float:left; margin-right:8px;">Check</span> <input type="text" name="check" id="check"  class="form"  /></span>
		</div>

<table id="table1" class="table2" style="text-align:center;" cellpadding="3">

        <tr  class="tr1">
                                                                        <th>Minus</th>
                                                                        <th>Barcode</th>
									<th>Product</th>
									<th>Quantity</th>
									<!--<th>Free<br>quantity</th>
									<th>Total<br>quantity<span style="color:red;">*</span></th>
									<th>Mrp<br></th>-->
									<th>Price</th>
									<!--<th>Total<br>price</th>
									<th>Special<br>discount<br>in %</th>
									<th>Dealer<br>discount<br>in %</th>
									<th>Scheme<br>discount<br>in %</th>
									<th>Tax<br>in %</th>-->
									<th>Discount</th>
									<th>Total<br>amount</th>
									
	</tr>

</table>
	<div>
	    <table id="table2" class="table2" style="text-align:center;" cellpadding="3">
		<tr>
		    <td>Total</td>
		    <td><input type="text" name="alltotal" id="alltotal"></td>
		</tr>
	    </table>
	</div>
</form> 
</div>

<div id="myModal1" class="reveal-modal" style="width:900px; left:35%; border: 5px solid #4c89b2;">
			<h1 style="font-size:18px;">Customer</h1>
			<!--<table class="table3">
					<tr>
							<td>First Name<br /><input type="text" name="" value="" class="form2"  /></td>
					</tr>
					<tr>
							<td>Email<br /><input type="text" name="" value="" class="form2"  /></td>
					</tr>
					<tr>
							<td>password<br /><input type="text" name="" value="" class="form2"  /></td>
					</tr>
					<tr>
							<td>Phone<br /><input type="text" name="" value="" class="form2"  /></td>
					</tr>
			</table>-->
		<form name="" action="customer_action.php" method="post" enctype="multipart/form-data" onSubmit="return validate();">
		<div style="width:400px; height:auto; float:left;">
			<table class="table3" style="font-size:13px; height:100%; line-height:2.6;">
					<tr>
					    <td>Customer Type</td>
					</tr>
					<tr>
					    <td>Customer</td>
					    <td><input type="radio" name="type" value="1" /></td>
					</tr>
					<tr>
					    <td>Distributer</td>
					    <td><input type="radio" name="type" value="2" /></td>
					</tr>
					<tr>
					    <td>Retailer</td>
					    <td><input type="radio" name="type" value="3" /></td>
					</tr>
					<tr>
					    <td>Date</td>
					    <td>
						<input type="text" name="date" id="inputField" class="form2"/>
						</td>
					</tr>
					<tr>
					    <td>Contact</td>
					    <td><input type="text" name="phone" id="phone" onKeyPress="return numbersonly(event)" class="form2"/></td>
					</tr>
					<tr>
					<tr>
					    <td>Customer Name</td>
					    <td>
						<input type="text" name="name" id="name" class="form2"/>
						</td>
					</tr>
					<tr>
					    <td>Father/Husband Name</td>
					    <td>
						<input type="text" name="fatname" id="fatname" class="form2"/>
						</td>
					</tr>
					<tr>
					    <td>DOB</td>
					    <td><input type="text" name="dob" id="inputField1" class="form2"/></td>
					</tr>
					<tr>
					    <td>Age</td>
					    <td><input type="text" name="age" id="age" class="form2"/></td>
					</tr>
					
				    </table>
					</div>
					
					
					<div style="width:400px; height:auto; float:left; margin-left:20px;">
					<table style="width:100%; font-size:13px;">
							<tr>
					    <td>Sex</td>
					    <td><input type="radio" name="sex" id="sex"  value="m" style="width: 50px;"/>M<input type="radio" name="sex" id="sex" value="f" class="text" style="width: 50px;"/>F</td>
					</tr>
					<tr>
					    <td>Year</td>
					    <td><input type="text" name="year" id="year" class="form2"/></td>
					</tr>
					<tr>
					    <td>Address</td>
					    <td>
						<textarea name="addr" id="addr" class="form2" style="width:177px;"></textarea>
						</td>
					</tr>
					
					<tr>
					    <td>occupation</td>
					    <td>
					      Service Business Student Housewife Professional
					    </td>
					</tr>
					<tr>
					    <td></td>
					    <td>
						<input type="radio" name="occupation" id="occupation" value="service"  />
						<input type="radio" name="occupation" id="occupation" value="business" style="margin-left: 40px;" />
						<input type="radio" name="occupation" id="occupation" value="student" style="margin-left: 40px;"  />
						<input type="radio" name="occupation" id="occupation" value="housewife" style="margin-left: 40px;" />
						<input type="radio" name="occupation" id="occupation" value="professional" style="margin-left: 40px;"  />
					    </td>
					</tr>
					<tr>
					    <td>&nbsp;</td>
					    <td>
					       Others Society Company
					    </td>
					</tr>
					<tr>
					    <td></td>
					    <td>
						<input type="radio" name="occupation" id="occupation" value="others"  />
						<input type="radio" name="occupation" id="occupation" value="society" style="margin-left: 40px;"  />
						<input type="radio" name="occupation" id="occupation" value="company" style="margin-left: 40px;" />
					    </td>
					</tr>
					<tr>
					    <td>Introducer Id</td>
					    <td> <input type="text" name="introid" id="introid" class="form2"/></td>
					</tr>
					<tr>
					    <td>Introducer Name</td>
					    <td><input type="text" name="introducer" id="introducer" class="form2"/></td>
					</tr>
					<tr>
					    <td>Location</td>
					    <td>
					     <input type="text" name="location" id="locatio" class="form2"/>
						<input type="hidden" name="locat" id="hdlocatio"/>
						</td>
					</tr>
					<tr>
					    <td>Identity Proof</td>
					    <td>Addhar card  Voter card  Driving licence  Others</td>
					</tr>
					<tr>
					 <td></td>
					    <td>
					     <input type="radio" name="iproof" id="iproof" value="addharcard" />
					     <input type="radio" name="iproof" id="iproof" value="votercard" style="margin-left: 60px;" />
					     <input type="radio" name="iproof" id="iproof"  value="dl" style="margin-left: 60px;"/>
					     <input type="radio" name="iproof" id="iproof"  value="others" style="margin-left: 60px;"/>
					    </td>
					</tr>
					<tr>
					    <td>Email</td>
					    <td><input type="email" name="email" id="email" class="form2"/></td>
					</tr>
					<tr>
					    <td>Amount</td>
					    <td><input type="text" name="amount" id="amount" class="form2"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					    <td><input type="submit" name="submit" value="Add" class="btn button"></td>
					</tr>
					</table>
					
			</form>
			</div>
			
			
			<a class="close-reveal-modal">&#215;</a>
			
		</div>
</body>
</html><?php }?>
