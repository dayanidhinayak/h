<?php
include_once('function.php');
if(isset($_GET['pid']))
{
$prodval=$_GET['pid'];
}else
{
    $bar=$_GET['bar'];
$fetch1=mysql_query("select * from `product` where `barcode`='$bar'");
$res1=mysql_fetch_array($fetch1);
$prodval=$res1['id'];
}
$fetch=mysql_query("select * from `product` where `id`='$prodval'");
$res=mysql_fetch_array($fetch);
$sqlcompany=mysql_query("select * from `company` where `id`='$res[company]'");
$rescompany=mysql_fetch_array($sqlcompany);
$sqlcategory=mysql_query("select * from `category` where `id`='$res[category]'");
$category=mysql_fetch_array($sqlcategory);
echo $date=$res['company'].",".$rescompany['comp_name'].",".$res['category'].",".$category['cat_name'].",".$res['barcode'].",".$res['id'].",".$res['prod_name'];
?>