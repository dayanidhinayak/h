<?php
include_once('function.php');
if(isset($_GET['prod']))
{
    $prod=$_GET['prod'];
//$fetch=mysql_query("select mrp,price,bar,product_id,(select prod_name from product where id=purchase.product_id) as prod_name from `purchase` where `product_id`=(select id from product where prod_name='$prod')");
//echo "select mrp,price,bar,product_id,(select prod_name from product where id=purchase.product_id) as prod_name from `purchase` where `product_id`=(select id from product where prod_name='$prod')";
$fetch=mysql_query("select `mrp`,`prod_name`,`price`,`id`,barcode from product where `prod_name` like '$prod'") or die(mysql_error());
//echo "select `mrp`,`prod_name`,`price`,`id`,barcode from product where `id`='$prod'";
$res=mysql_fetch_array($fetch);
echo json_encode($res);
}else
{
    $bar=$_GET['bar'];
//$fetch=mysql_query("select mrp,price,product_id,(select prod_name from product where id=purchase.product_id) as prod_name from `purchase` where `bar`='$bar'");
$fetch=mysql_query("select `mrp`,`prod_name`,`price`,`id` from product where `barcode`='$bar'");
$res=mysql_fetch_array($fetch);
echo json_encode($res);
}
?>