<?php
include_once('function.php');
if(isset($_GET['bar']))
{
    $bar=$_GET['bar'];
   //echo "select barcode,(select prod_name from product where id=stock.product_id) as prod_name,price,product_id,uniqueid from stock where barcode='$bar'";
    $fetch=mysql_query("select barcode,price,product_id,uniqueid,price,quantity,
                       (select prod_name from product where id=stock.product_id) as prod_name
                       from stock where barcode='$bar'");
    $res=mysql_fetch_array($fetch);
echo json_encode($res);
}
    ?>