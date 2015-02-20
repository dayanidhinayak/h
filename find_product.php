<?php
include_once('function.php');
if(isset($_GET['id']))
{
if($_GET['id']=="all")
{
 $fetch=mysql_query("select * from `product`");
}
else{
    $comid=$_GET['id'];
    $fetch=mysql_query("select * from `product` where `company`='$comid'");
	}
}
else if(isset($_GET['catid']))
{
$catid=$_GET['catid'];
$fetch=mysql_query("select * from `product` where `category`='$catid'");
}
    ?>
<select name="product" id="product" class="form">
    <?php
	if($_GET['id']=="all")
{
?>
<option></option>
<?php
 while($res=mysql_fetch_array($fetch))
    {
	?>
	<option value="<?php echo $res['id'];?>"><?php echo $res['prod_name'];?></option>
	<?php
}
}
else{
    while($res=mysql_fetch_array($fetch))
    { ?>
<option value="<?php echo $res['id'];?>"><?php echo $res['prod_name'];?></option>
<?php 
}
}
?>
</select>
