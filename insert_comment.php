<?php
include_once('function.php');
	$hdproid=$_GET['hdproidval'];
	$hdprice=$_GET['hdpriceval'];
	$hdbarcode=$_GET['hdbarcodeval'];
	$comnt=$_GET['comntval'];
	$sql=mysql_query("select * from `comment` where `product_id`='$hdproid' and `price`='$hdprice' and `barcode`='$hdbarcode'");
	$num=mysql_num_rows($sql);
	if($num==0){
	    mysql_query("insert into `comment` set `product_id`='$hdproid',`price`='$hdprice',`barcode`='$hdbarcode',`review`='$comnt'");
		}
		else
		{
		mysql_query("update `comment` set `review`='$comnt' where `product_id`='$hdproid' and `price`='$hdprice' and `barcode`='$hdbarcode'")or die(mysql_error());
		}
		//header("location:final_stock.php");
?>