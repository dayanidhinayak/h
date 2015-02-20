<?php
include_once('function.php');
$barcode=$_GET['brcd'];
$sqlmrp=mysql_query("select `mrp` from `product` where `barcode`='$barcode'");
$res=mysql_fetch_array($sqlmrp);
echo $res['mrp'];
?>