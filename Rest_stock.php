<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
 $getprod=mysql_query("select * from `product`")or die(mysql_error());
   while($resprod=mysql_fetch_array($getprod))
    {
	$get[] = array(
	'value'  => $resprod['prod_name'],
	'idval' => $resprod['id']
	);
    }
 ?>
<html>
<head>
<link href="style.css" rel="stylesheet"  type="text/css"/>
<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
 <!--autocomplete end-->
  <script type="text/javascript">
    $(function(){
        var availabledrugs=<?= json_encode($get); ?>;
        $('#product').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#product').val(valshow);
		 $('#hiprod').val(ui.item.idval);
		}
        });
});
  </script>
</head>
<body style="background:#f1f1f1;">
<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->
		<div id="content1">
<form name="f1" method="post">
<table class="table" style="height:100px;">
    <tr>
     <td>product</td>
     <td><input type="text" name="product" id="product" class="form"></td>
     <input type="hidden" name="hiprod" id="hiprod">
    </tr>
    <tr>
     <td><input type="submit" name="prodsub" value="show" class="button"></td>
    </tr>
</table>
</form>
</div>
 <div id="content2"> 
 <h2>Rest Inventory:</h2>
<!--<form name="f" action="insert_comment.php" method="post">-->
<table class="table1" width="100%">
<tr class="tr1">
<th>Product name</th>
<th>Quantity</th>
<th>Mrp</th>
<th>Price</th>
<th>TotalPrice</th>
<th>Barcode</th>
</tr>
</table>
 <div id="content2" style="height:220px; overflow:auto; overflow-x:hidden; background:none; padding-top:0px; padding-bottom:0px;">
  <table  class="table1" width="100%">
     <?php
     if(isset($_POST['prodsub']))
{
 $pid=$_REQUEST['hiprod'];
// echo "select *,sum(`totalquantity`) as quant from `purchase` where product_id='$pid' group by `uniqueid`";
  $sql=mysql_query("select *,sum(`totalquantity`) as quant from `purchase` where product_id='$pid' group by `uniqueid`");
     }else
     {
      $sql=mysql_query("select *,sum(`totalquantity`) as quant from `purchase` group by `uniqueid`");
     }
  while($ress=mysql_fetch_array($sql)){
  //echo "<br/>".$ress['quant']."-----".$ress['product_id']."----".$ress['uniqueid']."stock<br/>";
  $purchasequant=$ress['quant'];
  $sqlstock=mysql_query("select *,sum(`quantity`) as qty from `stock` where `barcode`='$ress[bar]' and `product_id`='$ress[product_id]' and `uniqueid`='$ress[uniqueid]'")or die(mysql_error());
  //echo "select *,sum(`quantity`) as qty from `stock` where `barcode`='$ress[bar]' and `product_id`='$ress[product_id]' and `uniqueid`='$ress[uniqueid]'";
  while($resstock=mysql_fetch_array($sqlstock)){
  //echo "<br/>".$resstock['qty']."-----".$resstock['product_id']."----".$resstock['uniqueid']."-----".$resstock['barcode']."<br/>";
  $stockquant=$resstock['qty'];
  $less=$purchasequant-$stockquant;
  //echo $less;
  $sqlproname=mysql_query("select * from `product` where `id`='$ress[product_id]'");
  $resproname=mysql_fetch_array($sqlproname);
  ?>
  <tr>
 <td class="td" style="width: 340px;"><?php echo $resproname['prod_name'];?></td>
  <td class="td" style="width: 210px;"><?php echo $less;?></td>
  <td class="td" style="width: 110px;"><?php echo $ress['mrp'];?></td>
   <td class="td" style="width: 135px;"><?php echo $resstock['price'];?></td>
     <td class="td" style="width: 240px;"><?php echo $tprice=$less*$ress['price'];?></td>
  <td class="td" ><?php echo $ress['bar'];?></td>
  </tr>
  <?php
  }
  }
  ?>
  </table>
 </div>
				</div>
</body>
</html><?php }?>