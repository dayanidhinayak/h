<?php
include_once('function.php');
	$code=htmlentities($_POST['bar'],ENT_QUOTES);
	//echo $pname=htmlentities($_POST['pname'],ENT_QUOTES);
	$pid=htmlentities($_POST['hpid'],ENT_QUOTES);
	$quant=htmlentities($_POST['quant'],ENT_QUOTES);
	$price=htmlentities($_POST['price'],ENT_QUOTES);
	
	 $category=htmlentities($_POST['cat'],ENT_QUOTES);
	 $company=htmlentities($_POST['comp'],ENT_QUOTES);
	 
	 $orderno=$_POST['ordername'];
	
	$retailerprice=htmlentities($_POST['priceretailer'],ENT_QUOTES);
	$distributerprice=htmlentities($_POST['pricedistributer'],ENT_QUOTES);
	$date=date('Y-m-d');
	
	$fetch1=mysql_query("select * from `product` where `id`='$pid'")or die(mysql_error());
	$res1=mysql_fetch_array($fetch1);
	$pname=$res1['prod_name'];
	if($pname!="" && $quant!="" && $price!="")
	{
	    //echo "insert into `stock` set `product_id`='$pid',`quantity`='$quant',`price`='$price',`retailer_price`='$retailerprice',`distributer_price`='$distributerprice',`totprice`='$pr',`barcode`='$code',`uniqueid`='$uid',`date`='$date',`cat`='$category',`comp`='$company'";
	   
	    mysql_query("insert into `stock` set `product_id`='$pid',`quantity`='$quant',`price`='$price',`retailer_price`='$retailerprice',`distributer_price`='$distributerprice',`totprice`='$pr',`barcode`='$code',`uniqueid`='$uid',`date`='$date',`cat`='$category',`comp`='$company',`order_no`='$orderno'")or die(mysql_error());
	    mysql_query("update `product` set stock=stock+'$quant',godown=godown-'$quant'  where id='$pid'") or die(mysql_error());
	    //echo "update `product` set stock='stock+$quant',godown='godown-$quant'  where id='$pid'";
		$msg="Successfully Added";

		}
		else
		{
		$msg="Please enter required fields";
		}
		
		header("location:product_to_stock.php?msg=$msg");
?>