<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
$date=date('Y-m-d');
ini_set("display_errors",0);

 if(isset($_POST['type'])){
	 $typeval=$_POST['type'];
	 }
	 else{$typeval=="";}


if(isset($_POST['stdate'])){
    $stdate=$_POST['stdate'];
    $endate=$_POST['endate'];
    
}
else{
   // $stdate=$date;
    //$endate=$date; 
}

$getcategory=mysql_query("select * from `category`")or die(mysql_error());
   while($rescategory=mysql_fetch_array($getcategory))
    {
	$getemcategory[] = array(
	'value'  => $rescategory['cat_name'],
	'idval' => $rescategory['id']
	);
    }
    
    $getvendor=mysql_query("select * from `vendor`")or die(mysql_error());
   while($resvendor=mysql_fetch_array($getvendor))
    {
	$getemvendor[] = array(
	'value'  => $resvendor['name'],
	'idval' => $resvendor['slno']
	);
    }
    if(isset($_POST['prodsub']))
    {
        $catid=$_POST['catid'];
        $category=$_POST['category'];
		$company=$_POST['company'];
        $product=$_POST['product'];
        $vendorid=$_POST['vendorid'];
        $quantity=$_POST['quantity'];
        $type=$_POST['type'];
		$query=" ";
		//$queryy=" ";
		if($type=="sell"){
			if($product!='')
			{
				$query.=" and `productid`='$product'";
				//$queryy.=" and `product_id`='$product'";
			} 
			if($vendorid!='')
			{
				$query.=" and `name`='$vendorid'";
				//$queryy.=" and `vendor_id`='$vendorid'";
			} 
			if($quantity!='')
			{
				$query.=" and `quantity` >= '$quantity'";
			} 
			if($stdate!='' && $endate!='')
			{
				$query.=" and `date` between '$stdate' and '$endate'";
			} 
		
		$fetch=mysql_query("select * from `sell` where 1 $query");
		//echo "select * from `sell` where 1 $query";
		}
		else if($type=="purchase")
		{
		if($product!='')
			{
				$query.=" and `product_id`='$product'";
			} 
			if($vendorid!='')
			{
				$query.=" and `vendor_id`='$vendorid'";
			} 
			if($quantity!='')
			{
				$query.=" and `quantity` >= '$quantity'";
			} 
			if($stdate!='' && $endate!='')
			{
				$query.=" and `date` between '$stdate' and '$endate'";
			} 
			$fetch=mysql_query("select * from `purchase` where 1 $query");
			//echo "select * from `purchase` where 1 $query";
		}
		else if($type=="stock")
		{
			if($product!='')
			{
				$query.=" and `product_id`='$product'";
			} 
			if($vendorid!='')
			{
				$query.=" and `vendor_id`='$vendorid'";
			} 
			if($quantity!='')
			{
				$query.=" and `quantity` >= $quantity";
			} 
			if($stdate!='' && $endate!='')
			{
				$query.=" and `date` between '$stdate' and '$endate'";
			} 
			$fetch=mysql_query("select *,sum(quantity) as quan from `stock` where 1 $query");
			
		}
		
		
       /* if($catid!="" ||  $vendorid!="" || $quantity!="" && $type=="sell")
        {
            //echo "select * from `sell` where `quantity`>='$quantity' and `name`='$vendorid' and `productid`='$product'";
            $fetch=mysql_query("select * from `sell` where `quantity`>='$quantity' and `name`='$vendorid' and `productid`='$product'");
			//echo "select * from `sell` where `quantity`>='$quantity' or `name`='$vendorid' or `productid`='$product'";
        }else
        {
            //echo "select * from `purchase` where `totalquantity`>='$quantity' and `vendor_id`='$vendorid' and `product_id`='$product'";
            //$fetch=mysql_query("select * from `purchase` where `totalquantity`>='$quantity' and `vendor_id`='$vendorid' and `product_id`='$product'");
            //$fetch=mysql_query("select * from `purchase`");
        }*/
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
 <!--autocomplete end-->
  <script type="text/javascript">
    $(function(){
	 //jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemcategory); ?>;
        $('#category').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var id=ui.item.idval;
        $('#category').val(valshow);
		 $('#catid').val(ui.item.idval);
		 
		 $.ajax({url:"find_company.php?id="+id,success:function(result){
		 $("#comp").html(result);
                 }})
				  $.ajax({url:"find_product.php?catid="+id,success:function(result){
		 $("#ap").html(result);
                 }});
		}
        });
});
    
    
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
		 $('#vendorid').val(ui.item.idval);
		}
        });
});
function getproduct(idval)
{
$.ajax({url:"find_product.php?id="+idval,success:function(result){
		 $("#ap").html(result);
                 }});
}
  </script>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>

<script>
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
</head>

<body>
<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->


<div id="content1">
<form name="f1" method="post" action="#">
<table class="table" style="height:100px;">
    <tr>
    <td>Category</td>
     <td><input type="text" name="category" id="category" class="form" value="<?php   if(isset($_POST['category']))
    {echo $_POST['category'];}?>">
     <input type="hidden" name="catid" id="catid" />
     </td>
	 <td>Company</td>
	 <td id="comp">
	<!-- <input type="text" name="company" id="company" class="form"/>-->
	<select name="company" id="company" class="form">
	<option value="<?php echo $company;?>">
	<?php 
	$sqlcom=mysql_query("select `comp_name` from `company` where `id`='$company'");
	$rescom=mysql_fetch_array($sqlcom);
	echo $rescom['comp_name'];
	?>
	</option>
    </select>
	 </td>
     <td>product</td>
     <td id="ap">
	 <!--<input type="text" name="product" id="product" class="form"></td>
     <input type="hidden" name="hiprod" id="hiprod">-->
	 <select name="product" id="product" class="form">
	<option value="<?php echo $product;?>">
	<?php 
	$sqlpr=mysql_query("select `prod_name` from `product` where `id`='$product'");
	$respr=mysql_fetch_array($sqlpr);
	echo $respr['prod_name'];
	?>
	</option>
    </select>
    </tr>
    <tr>
    <td>Vendor</td>
     <td><input type="text" name="vendor" id="vendor" class="form" value="<?php  if(isset($_POST['vendor']))
    { echo $_POST['vendor'];}?>">
     <input type="hidden" name="vendorid" id="vendorid" />
     </td>
     <td>quantity >=</td>
     <td><input type="text" name="quantity" id="quantity" class="form" value="<?php   if(isset($_POST['quantity']))
    {echo $_POST['quantity'];}?>"></td>
     
    </tr>
        <tr>
     <td>Start date</td>
     <td><input type="text" name="stdate"  class="form" value="<?php if(isset($stdate)){echo $stdate; }?>"  id="inputField"></td>
          <td>End date</td>
     <td><input type="text" name="endate" class="form"  value="<?php if(isset($endate)){echo $endate;} ?>"  id="inputField1"></td>
    
    </tr>
        <tr>
            <td>
                <select name="type" id="type" class="form">
                    <option value="">Select</option>
                    <option value="sell" <?php if($typeval=="sell"){echo "selected";}?>>Sell Report</option>
                    <option value="purchase" <?php if($typeval=="purchase"){echo "selected";}?>>Purchase Report</option>
					 <option value="stock" <?php if($typeval=="stock"){echo "selected";}?>>Stock Report</option>
                   
                </select>    
            </td>
        </tr>
    <tr>
     <td><input type="submit" name="prodsub" value="show" class="btn button"></td>
    </tr>
</table>
</form>
</div>

<div id="content2"> 
	<h2>Rest Inventory:</h2>
<table class="table1" width="100%">

<tr class="tr1">
<?php if($typeval=="stock"){}else{?><th>Vendor</th><?php }?>
<th>Category</th>
<th>Product name</th>
<th>Quantity</th>
<?php if($typeval=="stock"){}else{?><th>Mrp</th><?php }?>
<th><?php if($typeval=="sell"){echo "Sell Price";}else{echo "Price";}?></th>
<th>TotalPrice</th>
<?php if($typeval=="sell"){?>
<th>Purchase Price</th>
<th>P/L</th>
<?php
}else{}
?>
<th>Barcode</th>
<th>Date</th>
</tr>
     <?php
     $totmrp=0;
     $totpr=0;
	 $totpurch=0;
	 $totdiff=0;
	 
     if($typeval=='sell')
  {
     while($ress=mysql_fetch_array($fetch))
     {
	// echo "select `price` from `purchase` where `uniqueid`='$ress[uniqueid]'";
	 $sqlpurch=mysql_query("select `price`,`mrp` from `purchase` where `uniqueid`='$ress[uniqueid]'");
	 $respurch=mysql_fetch_array($sqlpurch);
        $getven=mysql_query("select * from `vendor` where `slno`='$ress[name]'");
        $resven=mysql_fetch_array($getven);
        
         $getpor=mysql_query("select * from `product` where `id`='$product'");
        $respor=mysql_fetch_array($getpor);
         $totmrp=$totmrp+$ress['price'];
       
  ?>
  <tr>
        <td class="td" style="width: 200px;"><?php echo $resven['name'].$ress['name'];?></td>
    <td class="td" style="width: 200px;"><?php echo $category;?></td>
  <td class="td" style="width: 200px;"><?php echo $respor['prod_name'];?></td>
  <td class="td" style="width: 100px;"><?php echo $ress['quantity'];?></td>
   <td class="td" style="width: 100px;"><?php echo $respurch['mrp'];?></td>
   <td class="td" style="width: 100px;"><?php echo $ress['price'];?></td>
     <td class="td" style="width: 90px;"><?php echo $tprice=$ress['quantity']*$ress['price'];?></td>
	 <td><?php echo $respurch['price'];?></td>
	 <td><?php echo $diff=$tprice-$respurch['price'];?></td>
  <td class="td" ><?php echo $ress['barcode'];?></td>
    <td class="td" ><?php echo $ress['date'];?></td>
  </tr>
  <?php  
  $totpr=$totpr+$tprice; 
   $totpurch=$totpurch+$respurch['price']; 
   $totdiff=$totdiff+$diff; 
  }
  
  ?>
  <tr>
    <td>Total</td>
    <td></td>
    <td></td>
    <td></td>
	<td></td>
    <td><?php echo $totmrp;?></td>
     <td><?php echo $totpr;?></td>
    <td><?php echo $totpurch;?></td>
    <td><?php echo $totdiff;?></td>
    <td></td>
  </tr>

  <?php
  }
 else if($typeval=="purchase")
  {
  
     while($ress=mysql_fetch_array($fetch))
     {
	  $getven=mysql_query("select * from `vendor` where `slno`='$ress[vendor_id]'");
      $resven=mysql_fetch_array($getven);
	  $getpor=mysql_query("select * from `product` where `id`='$ress[product_id]'");
      $respor=mysql_fetch_array($getpor);
  ?>
  <tr>
        <td class="td" style="width: 200px;"><?php echo $resven['name'];?></td>
    <td class="td" style="width: 200px;"><?php echo $category;?></td>
  <td class="td" style="width: 200px;"><?php echo $respor['prod_name'];?></td>
  <td class="td" style="width: 100px;"><?php echo $ress['quantity'];?></td>
  <td class="td" style="width: 100px;"><?php echo $ress['mrp'];?></td>
   <td class="td" style="width: 100px;"><?php echo $ress['price'];?></td>
     <td class="td" style="width: 90px;"><?php echo $tprice=$ress['quantity']*$ress['price'];?></td>
  <td class="td" ><?php echo $ress['bar'];?></td>
    <td class="td" ><?php echo $ress['date'];?></td>
  </tr>
  <?php 
  }
  }
  else if($typeval=="stock")
  {
  
     while($ress=mysql_fetch_array($fetch))
     {
	 $stockqunt=$ress['quan'];
	 $sqlsell=mysql_query("select sum(quantity) as selquant from `sell` where `productid`='$ress[product_id]'");
	 $ressell=mysql_fetch_array($sqlsell);
	 $sellquant=$ressell['selquant'];
	 $less=$stockqunt-$sellquant;
	  $getven=mysql_query("select * from `vendor` where `slno`='$ress[vendor_id]'");
      $resven=mysql_fetch_array($getven);
	  $getpor=mysql_query("select * from `product` where `id`='$ress[product_id]'");
      $respor=mysql_fetch_array($getpor);
  ?>
  <tr>    
    <td class="td" style="width: 200px;"><?php echo $category;?></td>
  <td class="td" style="width: 200px;"><?php echo $respor['prod_name'];?></td>
  <td class="td" style="width: 100px;"><?php echo $less;?></td>
   <td class="td" style="width: 100px;"><?php echo $ress['price'];?></td>
     <td class="td" style="width: 90px;"><?php echo $tprice=$ress['quantity']*$ress['price'];?></td>
  <td class="td" ><?php echo $ress['barcode'];?></td>
    <td class="td" ><?php echo $ress['date'];?></td>
  </tr>
  <?php 
  }
  }
  ?>
  </table>
</div>
</body>
</html><?php }?>