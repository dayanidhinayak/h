<?php
include_once('function.php');
$id=$_GET['id'];
$prodid=$_GET['prodid'];
$qtyval=$_GET['qtyval'];
$date=date("Y-m-d");
//echo "update `sell set `return_qty`=`return_qty`+$qtyval,`return_ondate`='$date',`quantity`=`quantity`-$qtyval  where `id`='$id'";
$query=mysql_query("update `sell` set `return_qty`=`return_qty`+$qtyval,`return_ondate`='$date',`quantity`=`quantity`-$qtyval  where `id`='$id'");
$query1=mysql_query("update `product` set `stock`='stock'+$qtyval where `id`='$prodid'");
if($query)
{
    echo "OK";
}

?>
