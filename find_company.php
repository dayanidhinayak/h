<?php
include_once('function.php');
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $fetch=mysql_query("select * from `product` where `category`='$id' group by `company`");
    ?>
<select name="company" id="company" class="form" onchange="return getproduct(this.value);">
    <?php
    while($res=mysql_fetch_array($fetch))
    {
	$comapny_id=$res['company'];
	$compname=mysql_query("select `comp_name`,`id` from `company` where `id`='$comapny_id'");
	$rowcompname=mysql_fetch_array($compname);
	?>
<option value="<?php echo $rowcompname['id'];?>"><?php echo $rowcompname['comp_name'];?></option><?php }?>
<option value="all">All</option>
</select>
<?php }?>