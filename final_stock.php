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
<script>
function getcomment(cmnt,ival)
{
var proid=$('#hdproid'+ival).val();
var prc=$('#hdprice'+ival).val();
var bar=$('#hdbarcode'+ival).val();
	$.ajax({url:"insert_comment.php?hdproidval="+proid+'&hdpriceval='+prc+'&hdbarcodeval='+bar+'&comntval='+cmnt,
	       success:function(result){
                }
		});
}
</script>


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
 <h2>Final Inventory:</h2>
<!--<form name="f" action="insert_comment.php" method="post">-->
<table class="table1" width="100%">
<tr class="tr1">
<th>Product name</th>
<th>Quantity</th>
<th>Price</th>
<th>Barcode</th>
<th>Add Comment</th>
</tr>
<?php
$i=0;
if(isset($_POST['prodsub']))
{
 $pid=$_REQUEST['hiprod'];
 $sql=mysql_query("select `barcode`,`product_id`,`price`,sum(`quantity`) as quant from `stock` where `product_id`='$pid' group by `price`,`barcode`");
} else {
$sql=mysql_query("select `barcode`,`product_id`,`price`,sum(`quantity`) as quant from `stock` group by `price`,`barcode`");
}
while($ress=mysql_fetch_array($sql)){
$i++;
   $stockquant=$ress['quant'];
$sqlsel=mysql_query("select *,sum(`quantity`) as qty from `sell` where `barcode`='$ress[barcode]'")or die(mysql_error());
while($ressel=mysql_fetch_array($sqlsel)){
 $sellquant=$ressel['qty'];

$less=$stockquant-$sellquant;
if($less<0)
{ $less=0;}
$sqlproname=mysql_query("select * from `product` where `id`='$ress[product_id]'");
$resproname=mysql_fetch_array($sqlproname);
$min=$resproname['minimum'];

if($less<$min)
{
?>
<tr id="<?php echo $i;?>">
<td class="td" style="border:1px solid #fa3232; "><?php echo $resproname['prod_name'];?><input type="hidden" name="hdproid" id="hdproid<?php echo $i;?>" value="<?php echo $resproname['id'];?>"/></td>
<td class="td" style="border:1px solid #fa3232;  "><?php echo $less;?></td>
<td class="td" style="border:1px solid #fa3232;  "><?php echo $ress['price'];?><input type="hidden" name="hdprice" id="hdprice<?php echo $i;?>" value="<?php echo $ress['price'];?>"/></td>
<td class="td" style="border:1px solid #fa3232; "><?php echo $ress['barcode'];?><input type="hidden" name="hdbarcode" id="hdbarcode<?php echo $i;?>" value="<?php echo $ress['barcode'];?>"/></td>
<td>
<textarea class="text" style="width:110px; text-align:center; margin-left:5px; border:1px solid #fa3232;" name="comnt" id="comnt<?php echo $i;?>" onBlur="return getcomment(this.value,<?php echo $i;?>);">
<?php
$sqll=mysql_query("select * from `comment` where `product_id`='$resproname[id]' and `price`='$ress[price]' and `barcode`='$ress[barcode]'");
$no=mysql_num_rows($sqll);
if($no==0){
echo "Low Stock";
}
else{
while($res=mysql_fetch_array($sqll)){
echo $res['review'];
}
}
?>
</textarea>
</td>
</tr>

<?php
}
else
{
?>
<tr>
<td class="td"><?php echo $resproname['prod_name'];?></td>
<td class="td"><?php echo $less;?></td>
<td class="td"><?php echo $ress['price'];?></td>
<td class="td" ><?php echo $ress['barcode'];?></td>
<td>&nbsp;</td>
</tr>
<?php
}
}
}
?>
</table>
				</div>
</body>
</html><?php }?>