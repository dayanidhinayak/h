<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
$getvendor=mysql_query("select * from `vendor`  where `type` NOT LIKE '0'")or die(mysql_error());
   while($resvendor=mysql_fetch_array($getvendor))
    {
	$getemvendor[] = array(
	'value'  => $resvendor['name'].$resvendor['slno'],
	'idval' => $resvendor['slno'],
	'add' => $resvendor['address']
	);
    }
    
    
    
    if(isset($_POST['submit']))
    {
        $custid=$_POST['custid'];
        $startdt=$_POST['stdate'];
        $enddt=$_POST['endate'];
        
    $query=mysql_query("select s.*,v.`name`,p.prod_name from `sell` s,`vendor` v,`product` p where v.slno=s.name and p.id=s.productid and s.`name`='$custid' and s.`date` between '$startdt' and '$enddt'")or die(mysql_error());
    
    
        
        
    }
    else{
        $query='';
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
		 
		}
		
        });
});
    
    
    function return_product(slno,pid)
    {
        var qty=$('#return'+slno).val();
        var existqty=$('#qty'+slno).val();
        var r = confirm("Do U want to return product?");
if (r == true) {
    
    if (parseInt(qty) < parseInt(existqty)) {
        
     $.ajax({url:"returnproduct.php?id="+slno+"&prodid="+pid+"&qtyval="+qty,
           success:function(result){
           
		if (result.trim()=='OK') {
                    alert("Successfully return product");
                    location.reload();
                }
   
}
    });
     
     
     
    }
    else{
        alert("Return quantity shouldbe less or equal to "+existqty);
        $('#return'+slno).val('');
    }

   
} else {
    
    
        
    }
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
html{ height:100%;}
body{ height:100%;}
</style>

 
</head>

<body style="background:#f1f1f1;">
<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->

<div id="content1">
    <form name="form1" method="post" action="#">
<table>

        <tr>
                <td> <a href="#" class="big-link" data-reveal-id="myModal1"  data-animation="fade" style="text-decoration:none; color:#333;">Customer Id</a> </td>
               <!-- <td> Category </td>
                <td> Name </td>-->
		<td>Date From </td>
                <td> Date To </td>
                

        </tr>
        <tr>
            
                <td> <input type="text" name="customer" id="customer" class="barcode form"> </td>
		<input type="hidden" name="custid" id="custid" class="barcode form">
		
                <!--<td> <input type="text" name="category" id="category" > </td>
                <td> <input type="text" name="name" id="name" > </td>-->
		<td> <input type="text" name="stdate"  class="form" value="<?php if(isset($stdate)){echo $stdate; }?>"  id="inputField"></td>
                <td><input type="text" name="endate" class="form"  value="<?php if(isset($endate)){echo $endate;} ?>"  id="inputField1"> </td>
                <td><input type="submit" name="submit" value="Find"/></td>

        </tr>
      
</table>
    </form>
</div>


<div id="content2" style="height:70%; overflow:auto;">                  

   
<table id="table1" class="table2" style="text-align:center;" cellpadding="3">

        <tr class="tr1">
                                                                        
                                                                       <th>Sellid</th>
                                                                        <th>Barcode</th>
									<th>Product</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Discount</th>
									<th>Total<br>amount</th>
                                                                        <th>Return</th>
									
	</tr>
        <?php
        if($query)
        {
        while($result=mysql_fetch_array($query))
        {
        ?>
        <tr>
             <td><?php echo $result['id']?></td>
            <td><?php echo $result['barcode']?></td>
             <td><?php echo $result['prod_name']?></td>
              <td><?php echo $result['quantity']?>
              <input type="hidden" id="qty<?php echo $result['id'];?>" value="<?php echo $result['quantity']?>"/>
              </td>
               <td><?php echo $result['price']?></td>
                <td><?php echo $result['dis']?></td>
                 <td><?php echo $result['totprice']?></td>
                  <td><input type="text" name="return" id="return<?php echo $result['id'];?>" />
                  <input type="button" name="return<?php echo $result['id'];?>" value="return" onclick="return_product(<?php echo $result['id'];?>,<?php echo $result['productid'];?>)"/>
                  </td>  
        </tr>       
        <?php
        }
        }
        ?>
</table>
</div>
</body>
</html><?php }?>
