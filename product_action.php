<?php
include_once('function.php');
 if(isset($_POST['submit']))
{
	
	$product=htmlentities($_REQUEST['product']);
	$company=htmlentities($_REQUEST['company']);
	$category=htmlentities($_REQUEST['category']);
	$min=htmlentities($_REQUEST['min']);
	$bar=htmlentities($_REQUEST['barcode']);
	if($bar=="")
	{
	$bar=time();	
	}
	$mrp=htmlentities($_REQUEST['mrp']);
	$price=htmlentities($_REQUEST['price']);
	//$sell_price=htmlentities($_REQUEST['sell_price']);
	$retail=htmlentities($_REQUEST['retailer_pcnt']);
	$distributer=htmlentities($_REQUEST['distributer_pcnt']);
	$customer=htmlentities($_REQUEST['customer_pcnt']);
	
	$fetch=mysql_query("select * from `product` where `prod_name`='$product' and `category`='$category' and`company`='$company' and `minimum`='$min'");
	$res=mysql_numrows($fetch);
	$fetchbar=mysql_query("select * from `product` where `barcode`='$bar'");
	$resbar=mysql_numrows($fetchbar);
	
	if($product!="" && $company!="" && $category!="" && $res==0 && $resbar==0)
	{
		//mysql_query("insert into `product` set `prod_name`='$product',`category`='$category',`company`='$company',`minimum`='$min' ,`retailer`='$retail',`distributer`='$distributer',`customer`='$customer',`barcode`='$bar',`mrp`='$mrp',`price`='$price',`sell_price`='$sell_price'");
		mysql_query("insert into `product` set `prod_name`='$product',`category`='$category',`company`='$company',`minimum`='$min' ,`retailer`='$retail',`distributer`='$distributer',`customer`='$customer',`barcode`='$bar',`mrp`='$mrp',`price`='$price'");
		echo $msg="Sucessfully Product Added";
	
	}else{$msg="Enter Different Data";}
	header("location:purchase.php?msg=$msg");
}
?>