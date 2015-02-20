<?php
include_once('function.php');
$pid=$_GET['pidval'];
$sqlpurchase=mysql_query("select * from `product` where `id`='$pid'");
$respurchase=mysql_fetch_array($sqlpurchase);
$avlquant=$respurchase['godown'];
?>
<input type="text" name="qty" value="<?php echo $avlquant;?>" style="width:60px;" id="quantt" readonly="true"/>
