<?php include_once('function.php');
if(!$_SESSION['user'])
{ header("location:index.php");}
else
{
$getvendor=mysql_query("select * from `vendor`  where `type`='0'")or die(mysql_error());
   while($resvendor=mysql_fetch_array($getvendor))
    {
	$getemvendor[] = array(
	'value'  => $resvendor['name']."(".$resvendor['slno'].")",
	'idval' => $resvendor['slno']
	);
    }
$getproduct=mysql_query("select * from `product`")or die(mysql_error());
while($resproduct=mysql_fetch_array($getproduct))
{
$getemproduct[] = array(
'value'  =>$resproduct['prod_name'],
'idval' => $resproduct['id']
	);
}
$getcompany=mysql_query("select * from `company`")or die(mysql_error());
while($rescompany=mysql_fetch_array($getcompany))
{
$getemcompany[] = array(
'value'  =>$rescompany['comp_name'],
'idval' => $rescompany['id']
	);
}
    
$getcategory=mysql_query("select * from `category`")or die(mysql_error());
   while($rescategory=mysql_fetch_array($getcategory))
    {
	$getemcategory[] = array(
	'value'  => $rescategory['cat_name']."(".$rescategory['id'].")",
	'idval' => $rescategory['id']
	);
    }
$getcategory1=mysql_query("select * from `category`")or die(mysql_error());
while($rescategory1=mysql_fetch_array($getcategory1))
{
$getemail[] = array(
'value'  =>$rescategory1['cat_name'],
'idval' => $rescategory1['id']
	);
}
$getcompany1=mysql_query("select * from `company`")or die(mysql_error());
while($rescompany1=mysql_fetch_array($getcompany1))
{
$getemails[] = array(
'value'  =>$rescompany1['comp_name'],
'idval' => $rescompany1['id']
	);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..::Shop::..</title>
<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
 <!--autocomplete end-->
  <script type="text/javascript"> 
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemvendor); ?>;
        $('#vendor').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#vendor').val(valshow);
		 $('#vendid').val(ui.item.idval);
		}
        });
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemproduct); ?>;
        $('#product').autocomplete({
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
		 $('#product').val(valshow);
		 $('#porid').val(ui.item.idval);
                 $.ajax({url:"purch_product_detail.php?pid="+barcode,success:function(result)
		 {
                    var obj=result.split(",");
                    $('#compid').val(obj[0]);
                    $('#company').val(obj[1]);
                    $('#catid').val(obj[2]);
                    $('#category').val(obj[3]);
                    $('#barcode').val(obj[4]);
                    $('#barcode').focus();
		 }
                 
		 });
                 
		 
		}
		
		
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemcompany); ?>;
        $('#company').autocomplete({
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
		 $('#company').val(valshow);
		 $('#compid').val(ui.item.idval);
		}
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemcategory); ?>;
        $('#category').autocomplete({
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
		 $('#category').val(valshow);
		 $('#catid').val(ui.item.idval);
		}
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
</script>
<script type="text/javascript">
    $(function(){
        var availabledrug=<?= json_encode($getemail); ?>;
        $('#cateid').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrug,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#cateid').val(valshow);
		 $('#hdcatid').val(ui.item.idval);
        return false;
		}
        });
});
</script>
<script type="text/javascript">
    $(function(){
        var availabledrugs=<?= json_encode($getemails); ?>;
        $('#compnid').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#compnid').val(valshow);
		 $('#hdcompid').val(ui.item.idval);
        return false;
		}
        });
});
</script>
<script language="javascript">
function deleteRow(t)
{
   
    document.getElementById("table1").deleteRow(t);

}

function addRow(tableID){
var table=document.getElementById(tableID);
var rowCount=table.rows.length;
var lastRow = table.rows[ table.rows.length - 1 ];
rowCount1=lastRow.id-0+1;
var row=table.insertRow(rowCount);
        row.id=rowCount;
var cell1=row.insertCell(0);
var element1=document.createElement("input");
        element1.type="button";
        element1.value="-";
        element1.name="purchase["+rowCount1+"][minus]";
        element1.id="minus"+rowCount1;
        element1.className="minus textbox";
        cell1.appendChild(element1);
        $(element1).click( function(){  deleteRow(this.parentNode.parentNode.rowIndex) });
var cell2=row.insertCell(1);
var element2=document.createElement("input");
        element2.type="text";
        element2.name="purchase["+rowCount1+"][barcode]";
        element2.id="barcode"+rowCount1;
        //element2.setAttribute('elementid',rowCount);
        element2.className="barcode textbox";
        cell2.appendChild(element2);
        var b=$('#barcode').val();
        if (b!="") {element2.value=b; $('#barcode').val(""); }
         $('#barcode'+rowCount1).blur( function(){ barcode(rowCount1);});
var cell3=row.insertCell(2);
var element3=document.createElement("input");
        element3.type="text";
        element3.name="purchase["+rowCount1+"][product]";
        element3.id="product"+rowCount1;
        element3.className="product textbox";
        cell3.appendChild(element3);
		
		//var prd=$('#product').val();
		// if (prd!="") {element3.value=prd; }
		
       // $("#product"+rowCount1).blur( function(){  product(rowCount); });
var cell4=row.insertCell(3);
var element4=document.createElement("input");
        element4.type="text";
        element4.name="purchase["+rowCount1+"][quantity]";
        element4.id="quantity"+rowCount1;
        element4.className="quantity textbox";
        cell4.appendChild(element4);
	
var cell5=row.insertCell(4);
var element5=document.createElement("input");
        element5.type="text";
        element5.name="purchase["+rowCount1+"][freeqty]";
        element5.id="freeqty"+rowCount1;
        element5.className="freeqty textbox";
        cell5.appendChild(element5);
	$('.freeqty').blur( function(){  totqty(rowCount); });
var cell6=row.insertCell(5);
var element6=document.createElement("input");
        element6.type="text";
        element6.name="purchase["+rowCount1+"][totqty]";
        element6.id="totqty"+rowCount1;
        element6.className="totqty textbox";
        cell6.appendChild(element6);
var cell7=row.insertCell(6);
var element7=document.createElement("input");
        element7.type="text";
        element7.name="purchase["+rowCount1+"][mrp]";
        element7.id="mrp"+rowCount1;
        element7.className="mrp textbox";
        cell7.appendChild(element7);
		
		
var cell8=row.insertCell(7);
var element8=document.createElement("input");
        element8.type="text";
        element8.name="purchase["+rowCount1+"][priceunit]";
        element8.id="priceunit"+rowCount1;
        element8.className="priceunit textbox";
        cell8.appendChild(element8);
        $('.priceunit').blur( function(){  totqty(rowCount); });
var cell9=row.insertCell(8);
var element9=document.createElement("input");
        element9.type="text";
        element9.name="purchase["+rowCount1+"][totprice]";
        element9.id="totprice"+rowCount1;
        element9.className="totprice textbox";
        cell9.appendChild(element9);
var cell10=row.insertCell(9);
var element10=document.createElement("input");
        element10.type="text";
        element10.name="purchase["+rowCount1+"][spldis]";
        element10.id="spldis"+rowCount1;
        element10.className="spldis textbox";
        cell10.appendChild(element10);
var cell11=row.insertCell(10);
var element11=document.createElement("input");
        element11.type="text";
        element11.name="purchase["+rowCount1+"][deldis]";
        element11.id="deldis"+rowCount1;
        element11.className="deldis textbox";
        cell11.appendChild(element11);
var cell12=row.insertCell(11);
var element12=document.createElement("input");
        element12.type="text";
        element12.name="purchase["+rowCount1+"][schdis]";
        element12.id="schdis"+rowCount1;
        element12.className="schdis textbox";
        cell12.appendChild(element12);
var cell13=row.insertCell(12);
var element13=document.createElement("input");
        element13.type="text";
        element13.name="purchase["+rowCount1+"][taxin]";
        element13.id="taxin"+rowCount1;
        element13.className="taxin textbox";
        cell13.appendChild(element13);
	$('.taxin').blur( function(){  discount(rowCount); });
var cell14=row.insertCell(13);
var element14=document.createElement("input");
        element14.type="text";
        element14.name="purchase["+rowCount1+"][tottax]";
        element14.id="tottax"+rowCount1;
        element14.className="tottax textbox";
        cell14.appendChild(element14);
var cell15=row.insertCell(14);
var element15=document.createElement("input");
        element15.type="text";
        element15.name="purchase["+rowCount1+"][totamt]";
        element15.id="totamt"+rowCount1;
        element15.className="totamt textbox";
        cell15.appendChild(element15);
        $('.totamt').blur( function(){  addall() });

var cell16=row.insertCell(15);
var element16=document.createElement("input");
        element16.type="hidden";
        element16.name="purchase["+rowCount1+"][pid]";
        element16.id="pid"+rowCount1;
        element16.className="pid textbox";
        cell16.appendChild(element16);
        cell16.setAttribute("hidden", true);
var cell17=row.insertCell(16);
var element17=document.createElement("input");
        element17.type="hidden";
        element17.name="purchase["+rowCount1+"][orderno]";
        element17.id="orderno"+rowCount1;
        element17.className="orderno textbox";
        cell17.appendChild(element17);
        cell17.setAttribute("hidden", true);
var cell18=row.insertCell(17);
var element18=document.createElement("input");
        element18.type="hidden";
        element18.name="purchase["+rowCount1+"][vendorid]";
        element18.id="vendorid"+rowCount1;
        element18.className="vendorid textbox";
        cell18.appendChild(element18);
        cell18.setAttribute("hidden", true);
var cell19=row.insertCell(18);
var element19=document.createElement("input");
        element19.type="hidden";
        element19.name="purchase["+rowCount1+"][companyid]";
        element19.id="companyid"+rowCount1;
        element19.className="companyid textbox";
        cell19.appendChild(element19);
        cell19.setAttribute("hidden", true);
var cell20=row.insertCell(19);
var element20=document.createElement("input");
        element20.type="text";
        element20.name="purchase["+rowCount1+"][categoryid]";
        element20.id="categoryid"+rowCount1;
        element20.className="categoryid textbox";
        cell20.appendChild(element20);
        cell20.setAttribute("hidden", true);
$("#barcode"+rowCount1).blur();
$('#quantity'+rowCount1).focus();
        }
        
function barcode(barcodeid)
{
     var bar=$('#barcode'+barcodeid).val();
     var ordernum=$('#order').val();
     var vendor=$('#vendid').val();
     var comp=$('#compid').val();
     var cat=$('#catid').val();
     if (vendor=="") { vendor=1;}
    $.ajax({url:"purchase_detail.php?bar="+bar,success:function(result)
		 {
                    var obj = JSON.parse(result);
                    $("#product"+barcodeid).val(obj.prod_name);
                    $("#pid"+barcodeid).val(obj.id);
                    $("#mrp"+barcodeid).val(obj.mrp);
                     $("#priceunit"+barcodeid).val(obj.price);
                     $("#orderno"+barcodeid).val(ordernum);
                     $("#vendorid"+barcodeid).val(vendor);
                     $("#companyid"+barcodeid).val(comp);
                      $("#categoryid"+barcodeid).val(cat);
                       // alert("inside");
                      $("#product").val("");
                      $("#porid").val("");
                      $("#company").val("");
                      $("#compid").val("");
                      $("#category").val("");
                      $("#catid").val("");
                      //$("#barcode"+barcodeid).val(obj.barcode);
                     
		 }});
}
function product(barcodeid)
{
     var prod=$('#product'+barcodeid).val();
     var ordernum=$('#order').val();
     var vendor=$('#vendid').val();
     var comp=$('#compid').val();
     if (comp=="") { comp=$("#companyid"+barcodeid).val();}
     var cat=$('#catid').val();
     if (cat=="") { cat=$("#categoryid"+barcodeid).val();}
     if (vendor=="") { vendor=1;}
    $.ajax({url:"purchase_detail.php?prod="+prod,success:function(result)
		 {
                    var obj = JSON.parse(result);
                    $("#barcode"+barcodeid).val(obj.barcode);
                    $("#pid"+barcodeid).val(obj.id);
                    $("#mrp"+barcodeid).val(obj.mrp);
                     $("#priceunit"+barcodeid).val(obj.price);
                     $("#orderno"+barcodeid).val(ordernum);
                     $("#vendorid"+barcodeid).val(vendor);
                     $("#companyid"+barcodeid).val(comp);
                     $("#categoryid"+barcodeid).val(cat);
		 }});
}
function fixbarcode(bar)
{
    $.ajax({url:"purch_product_detail.php?bar="+bar,success:function(result)
		 {
                    var obj=result.split(",");
                    $('#compid').val(obj[0]);
                    $('#company').val(obj[1]);
                    $('#catid').val(obj[2]);
                    $('#category').val(obj[3]);
                    //$('#barcode').val(obj[4]);
                    $('#porid').val(obj[5]);
                    $('#product').val(obj[6]);
		 }});
    addRow('table1')
}


function totqty(keyval)
{
var qty=$("#quantity"+keyval).val();
if (qty=="")
{
    qty=0;
}
var freeqty=$("#freeqty"+keyval).val();
if (freeqty=="")
{
    freeqty=0;
}
var priceunit=$("#priceunit"+keyval).val();
var totqty=parseInt(qty)+parseInt(freeqty);
var totprice=qty*priceunit;
$("#totqty"+keyval).val(totqty);
$("#totprice"+keyval).val(totprice);

}


function discount(disval)
{
var spldis=$("#spldis"+disval).val();
if (spldis==""){ spldis=0;}
var deldis=$("#deldis"+disval).val();
if (deldis=="")
{
    deldis=0;
}
var schdis=$("#schdis"+disval).val();
if (schdis=="")
{
    schdis=0;
}
var tax=$("#taxin"+disval).val();
if (tax=="")
{
    tax=0;
}
var totaldis=parseFloat(spldis)+parseFloat(deldis)+parseFloat(schdis);
var tot=$("#totprice"+disval).val();
var totalamt=parseFloat(tot)+(parseFloat(tot)*(totaldis/100));
if (tax!="")
{
    var totaltax=totalamt-(totalamt*(parseFloat(tax)/100));
}
$("#totamt"+disval).val(totalamt);
$("#tottax"+disval).val(totaltax);
}

function Allprice(mrp)
{
   var retailerpcnt=$('#retailer').val();
   var distributerpcnt=$('#distributer').val();
   var customerpcnt=$('#customer').val();
   var price=$('#price').val();
   if (price=="") { price=0;}
   
   var tempmrp=parseFloat(mrp)-parseFloat(price);
   var retailprice=parseFloat(tempmrp)*parseFloat(retailerpcnt/100)+parseFloat(price);
   var distributerprice=parseFloat(tempmrp)*parseFloat(distributerpcnt/100)+parseFloat(price);
   var customerprice=parseFloat(tempmrp)*parseFloat(customerpcnt/100)+parseFloat(price);
   
   $("#retailer_pcnt").val(retailprice);
   $("#distributer_pcnt").val(distributerprice);
   $("#customer_pcnt").val(customerprice);
}

function convert_retail_price()
    {
        var mrp=$("#mrp").val();
        var price=$("#price").val();
        if (price=="") { price=0;}
        var tempmrp=parseFloat(mrp)-parseFloat(price);
        
        var rpcent=$("#retailer_price_pcnt").val();
        if (rpcent!="")
        {
            var rprice=(parseFloat(tempmrp)*parseFloat(rpcent/100)+parseFloat(price)).toFixed(2);
            $("#retailer_pcnt").val(rprice);
        }
        var dpcent=$("#distributer_price_pcnt").val();
        if (dpcent!="")
        {
            var dprice=(parseFloat(tempmrp)*parseFloat(dpcent/100)+parseFloat(price)).toFixed(2);
            $("#distributer_pcnt").val(dprice);
        }
        var cpcent=$("#customer_price_pcnt").val();
        if (cpcent!="")
        {
           var cprice=(parseFloat(tempmrp)*parseFloat(cpcent/100)+parseFloat(price)).toFixed(2);
           $("#customer_pcnt").val(cprice);
        }
    }
    
    function convert_pcent()
    {
       
        var mrp=$("#mrp").val();
        var price=$("#price").val();
        if (price=="") { price=0;}
        var tempmrp=parseFloat(mrp)-parseFloat(price);
        var rprice=$("#retailer_pcnt").val();
        if (rprice!="" && rprice>price)
        {
        var tempprice=parseFloat(rprice)-parseFloat(price);
        var rpcen=((parseFloat(tempprice)*100)/tempmrp).toFixed(2);    
            $("#retailer_price_pcnt").val(rpcen);
        }
        
        var dprice=$("#distributer_pcnt").val();
        if (dprice!="" && dprice>price)
        {
            var tempprice=parseFloat(dprice)-parseFloat(price);
        var dpcen=((parseFloat(dprice)*100)/mrp).toFixed(2);    
            $("#distributer_price_pcnt").val(dpcen);
        }
        var cprice=$("#customer_pcnt").val();
        if (cprice!="" && cprice>price)
        {
            var tempprice=parseFloat(cprice)-parseFloat(price);
            var cpcen=((parseFloat(cprice)*100)/mrp).toFixed(2);    
            $("#customer_price_pcnt").val(cpcen);
        }
    }
    
    function addall() {
                var add = 0; 
                $(".totamt").each(function() { 
		add += Number($(this).val()); 
                }); 
                $("#total").text(add);
		$("#total").val(add);
	  }


function checkform() {
    
    var table=document.getElementById('table1');
    var form=document.getElementById('f');
    form.appendChild(table);
}

</script>
<link href="style.css?=wefdftrgrdreret" rel="stylesheet" type="text/css"  />

<link rel="stylesheet" href="css/reveal.css?=dfgd">	
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<style>
.product{ width:200px !important;}
.quantity{width:50px !important;}
.textbox {
height:18px;
float: left;
padding-left: 8px;
font-size: 14px;
color: #333;
border: 1px solid #CCC;
background: none repeat scroll 0% 0% #FFF;
    width:80%;
}
</style>
<script>
		function validate()
		{
		var name=document.getElementById('name').value;
		var phonee=document.getElementById('phone').value;
		var emailid=document.getElementById('email').value;
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
	if(emailid!="" && !emailid.match(format))

	{

	alert("You have entered an wrong email address!"); 
	return false;
    

	}
		}
		function valid()
		{
		var prodval=$('#prod').val();
		if(prodval=="")
		{
		alert("enter product");
		return false;
		}
		}
                
		</script>
 <script type="text/javascript">
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>
<style>
html{ height:100%;}
body{ height:100%;}
</style>
</head>

<body style="background:#f1f1f1; overflow:hidden;">

<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->

<div id="content1">
		<table style="width:80%;">
		
				<tr>
						<td><a href="#" class="big-link" data-reveal-id="myModal1"  data-animation="fade" style="text-decoration:none; color:#333;"> Vendor </a></td>
						<td><a href="#" class="big-link" data-reveal-id="myModal2"  data-animation="fade" style="text-decoration:none; color:#333;">Product</a> </td>
						<td> <a href="#" class="big-link" data-reveal-id="myModal3"  data-animation="fade" style="text-decoration:none; color:#333;">Company</a> </td>
						<td><a href="#" class="big-link" data-reveal-id="myModal4"  data-animation="fade" style="text-decoration:none; color:#333;"> Category </a></td>
						<td> barcode </td>

		
				</tr>
				<tr>
                                    <td> <input type="text" name="vendor" id="vendor" class="barcode form"> </td>
                                        <input type="hidden" name="vendid" id="vendid" class="barcode form">
                                    <td> <input type="text" name="product" id="product" class="form"> </td>
                                        <input type="hidden" name="porid" id="porid" class="barcode form">
				    <td> <input type="text" name="company" id="company" class="form" > </td>
                                        <input type="hidden" name="compid" id="compid" class="barcode form">
                                    <td> <input type="text" name="category" id="category" class="form"> </td>
						 <input type="hidden" name="catid" id="catid" class="barcode form">
				    <td> <input type="text" name="barcode" id="barcode" onblur="fixbarcode(this.value)" class="form"> </td>
				    <td> <?php $order_no=uniqid();?><input type="hidden" name="order" id="order" class="form" value="<?php echo $order_no;?>" > </td>
		
				</tr>
                       
		</table>

</div>

<div id="content2" style="height:75%; overflow:auto;">
    <form name="f" action="purchase_insert.php" method="post" onsubmit="checkform()" id="f" >
		<div style="width:100%; height:auto; float:left; margin-bottom:10px;">
				<input type="button" onclick="addRow('table1')" value="addrow" style="float:left;" class="button">
				<input type="submit" name="submit" value="insert" onsubmit="form1.appendChild(table1)" style="float:left; margin-left:5px;" class="button">
		</div>
		<table id="table1" class="table2" style="text-align:center;" cellpadding="5">
				<tr class="tr1" id="0">
											<th>Minus</th>
											<th>Barcode</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Free<br>quantity</th>
											<th>Total<br>quantity<span style="color:red;">*</span></th>
											<th>Mrp<br></th>
											<th>Price/<br>Unit</th>
											<th>Total<br>price</th>
											<th>Special<br>discount<br>in %</th>
											<th>Dealer<br>discount<br>in %</th>
											<th>Scheme<br>discount<br>in %</th>
											<th>Tax<br>in %</th>
											<th>Total<br>tax</th>
											<th>Total<br>amount</th>
												
				</tr>
		
		</table>
<div>
	    <table id="table2" class="table2" style="text-align:center;" cellpadding="3">
		<tr>
		    <td>Total</td>
		    <td><input type="text" name="total" id="total"></td>
		</tr>
	    </table>
</div>
</div>
</form>

<?php
if(isset($_GET['msg']))
{
$msg=$_GET['msg'];
echo "<script>alert('".$msg."')</script>";
}
?>
		<div id="myModal1" class="reveal-modal">
			<h1 style="font-size:18px;">Add Vendor</h1>
			 <form name="" action="vendor_action.php" method="post" enctype="multipart/form-data" onSubmit="return validate();">
				    <table class="table3">
					<tr>
							<td>Vendor Name<br /><input type="text" name="name" id="name" class="form2"/></td>
					</tr>
					<tr>
							<td>Contact<br /><input type="text" name="phone" id="phone" onKeyPress="return numbersonly(event)" class="form2"/></td>
					</tr>
					<tr>
							<td>Address<br /><textarea name="address" id="address" class="form2" style="height:60px;"></textarea></td>
					</tr>
					<tr>
							<td>Email<br /><input type="email" name="email" id="email" class="form2"/></td>
					</tr>
					<tr>
					    <td><input type="submit" name="submit" value="Add" class="button"></td>
					</tr>
				    </table>
				    </form>
			<a class="close-reveal-modal">&#215;</a>
		</div>
		
		<div id="myModal2" class="reveal-modal" style="width:900px; left:40%;">
			<h1 style="font-size:18px;">Add Product</h1>
			 <form name="f" action="product_action.php" method="post" enctype="multipart/form-data" onSubmit="return valid();">
			 <div style="width:440px; height:auto; float:left;">
				    <table class="table3" >
                                        <?php
                                            $fpercent=mysql_query("select * from percent");
                                            $rpercent=mysql_fetch_array($fpercent);
                                            ?>
                                            <input type="hidden" name="retailer" id="retailer" value="<?php echo $rpercent['retailer']?>">
                                            <input type="hidden" name="distributer" id="distributer" value="<?php echo $rpercent['distributer']?>">
                                            <input type="hidden" name="customer" id="customer" value="<?php echo $rpercent['customer']?>">
					<tr>
					    <td>Product<br/>
						<input type="text" name="product" class="form2" id="prod">
						</td>
					</tr>
					<tr>					
					    <td>Category<br/>
						<input type="text" name="categ" id="cateid" class="form2"  />
						<input type="hidden" name="category" id="hdcatid" style="width:120px;"/>
						</td>
					</tr>
					<tr>					
					    <td>Company<br/>
						<input type="text" name="compa" id="compnid" class="form2" />
						<input type="hidden" name="company" id="hdcompid" style="width:120px;"/>
						</td>
					</tr>
					<tr>	
					    <td>Minimum quantity<br/>
						<input type="text" name="min" class="form2" value="1"/>
						</td>
					</tr>
					<tr>					
					    <td>Barcode<br/>
						<input type="text" name="barcode" class="form2"/>
						</td>	
					</tr>
                                        <tr>					
					    <td>Price/Unit<br/>
						<input type="text" name="price" id="price" class="form2"/>
						</td>	
					</tr>
					
				    </table>
					</div>
					
					
					<div style="width:440px; height:auto; float:left;">
					<table>
							<tr>					
					    <td>Mrp<br/>
						<input type="text" name="mrp" id="mrp" class="form2" onblur="Allprice(this.value)"/>
						</td>	
					</tr>
					<!--<tr>					
					    <td>Sell Price<br/>
						<input type="text" name="sell_price" class="form2"/>
						</td>	
					</tr>-->
					<tr>					
					    <td>Retailer price<br/>
						<input type="text" name="retailer_pcnt" id="retailer_pcnt" onblur="convert_pcent()" class="form2"/>
						</td>
                                            <td>Retailer %<br/>
						<input type="text" name="retailer_price_pcnt" id="retailer_price_pcnt" value="<?php echo $rpercent['retailer']?>" onblur="convert_retail_price()" class="form2"/>
						</td>	
					</tr>
					<tr>					
					    <td>Distributer Price<br/>
						<input type="text" name="distributer_pcnt" id="distributer_pcnt" onblur="convert_pcent()" class="form2"/>
						</td>
                                            <td>Distributer %<br/>
						<input type="text" name="distributer_price_pcnt" id="distributer_price_pcnt" value="<?php echo $rpercent['distributer']?>" onblur="convert_retail_price()" class="form2"/>
						</td>
					</tr>
					<tr>					
					    <td>Customer Price<br/>
						<input type="text" name="customer_pcnt" id="customer_pcnt" onblur="convert_pcent()" class="form2"/>
						</td>
                                            <td>Customer %<br/>
						<input type="text" name="customer_price_pcnt" id="customer_price_pcnt" value="<?php echo $rpercent['customer']?>" onblur="convert_retail_price()" class="form2"/>
						</td>
					</tr>
					<tr> 
					<td><input type="submit" name="submit" value="Add" class="button"></td>
					</tr>
					</table>
					</div>
					</form>
			<a class="close-reveal-modal">&#215;</a>
		</div>
		
		<div id="myModal3" class="reveal-modal">
			<h1 style="font-size:18px;">Add Company</h1>
			<form name="f" action="insert_company.php" method="post" enctype="multipart/form-data">
			<table class="table3">
					<tr>
							<td>Company Name<br /><input type="text" name="name" id="name" required class="form2"/></td>
					</tr>
					<tr>
					    <td><input type="submit" name="submit" value="Add" class="button"/></td>
					</tr>
			</table>
			</form>
			<a class="close-reveal-modal">&#215;</a>
		</div>
		
		<div id="myModal4" class="reveal-modal">
			<h1 style="font-size:18px;">Add Category</h1>
			<form name="f" action="insert_category.php" method="post" enctype="multipart/form-data">
			<table class="table3">
					<tr>
							<td>Category Name<br /><input type="text" name="name" id="name" required class="form2"/></td>
					</tr>
					<tr>
					    <td><input type="submit" name="submit" value="Add" class="button"/></td>
					</tr>
			</table>
			</form>	   
				   
			<a class="close-reveal-modal">&#215;</a>
		</div>
</body>
</html><?php }?>