<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
?>
<html>
<head>
<link href="style.css" rel="stylesheet"  type="text/css"/>
    <script src="js/jquery-1.7.1.min.js"></script>
<!--datepicker start--->
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			
		});
		new JsDatePick({
			useMode:2,
			target:"inputField1",
			dateFormat:"%Y-%m-%d"
			
		});
	};
</script>
<!--datepicker end--->
<script>
 function forgetEnterKey(evt)
{
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && ((node.type == "text") || 
          (node.type == "password")))
    {
        return false;
    }
} 
document.onkeypress = forgetEnterKey;
</script>
</head>
<body style="background:#f1f1f1;">
  <!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->
<div id="content1">
<form name="f" method="post">
<table class="table" style="height:100px;">
<tr>
<td>Date:</td>
<td>From</td>
<td><input type="text" name="rpt" size="12" id="inputField" class="form"/></td>
<td>To</td>
<td><input type="text" name="rpt1" size="12" id="inputField1" class="form"/></td>
</tr>
<tr>
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>
<input type="submit" name="submit" value="submit"  class="button"/>
</td>
</tr>
</table>
</form>
</div>
<?php
if(isset($_POST['rpt']) && isset($_POST['rpt1'])){
?>
<div style="width:auto; height:auto; float:left; margin-left:10px; word-spacing:5px;">
<?php
$from=$_POST['rpt'];
$to=$_POST['rpt1'];
$sql=mysql_query("select * from `sell` where date between '$_POST[rpt]' and '$_POST[rpt1]' ");
$res=mysql_fetch_array($sql);
echo "<span style='font-family:arial; font-size:16px; color:#51A351;'>Report From"."  ".$from." To ".$to."</span><span style='font-weight:bold;color:#51A351;margin-left:5px;'>:</span>";

?>
</div>
<?php
}
?>
<div id="content2"> 
				   <table class="table1" width="100%">
										<tr class="tr1">
											<th>Date</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Total Price</th>		
										</tr>
					</table>
					<div id="content2" style="height:400px; overflow:auto; overflow-x:hidden; background:none; padding-top:0px; padding-bottom:0px;">
				      <table class="table1" width="100%" >
										<?php
										if(isset($_POST['rpt'])=="" && isset($_POST['rpt1'])==""){
						$sqlsell=mysql_query("select * from `sell` order by id desc");
						}
						
						else{
						$sqlsell=mysql_query("select * from `sell` where date between '$_POST[rpt]' and '$_POST[rpt1]' order by id desc");
						$no=mysql_num_rows($sqlsell);
						if($no>0){
						}
						else{
						echo "<span style='font-family:arial;margin-left:20px;color:red;'>"."You have no records"."</span>";
						}
						}$total=0;
											while($ressell=mysql_fetch_array($sqlsell))
												{
											$sqlproname=mysql_query("select * from `product` where `id`='$ressell[productid]' ");
											$resproname=mysql_fetch_array($sqlproname);
											$total=$total+$ressell['totprice'];
										?>
										<tr>
										     <td class="td" style="width: 74px;"><?php  echo $ressell['date'];?></td>
										    <td class="td"  style="width: 200px;"><?php  echo $resproname['prod_name'];?></td>
										    <td class="td"  style="width: 100px;"><?php  echo $ressell['quantity'];?></td>
										    <td class="td"  style="width: 100px;"><?php  echo $ressell['price'];?></td>
										    <td class="td"  style="width: 100px;"><?php  echo $ressell['totprice'];?></td>
											
										</tr>
										<?php
												}
										?>
					</table>
				</div>	
			
				   <table border="1" class="table1" width="100%"  cellpadding="0" cellspacing="0" style="line-height:2.5; margin-bottom:10px;">
				       <tr>
					<td colspan="3" align="center">TOTAL</td>
					<td  align="center" style="color:#FF0000;"><?php echo $total;?></td>
				       </tr>
				   </table>
				  
		<!--<form name="f" method="post" action="sell_to_excel.php">
		 <?php
		 if(isset($_POST['rpt'])=="" && isset($_POST['rpt1'])==""){
		  ?>
		    <input type="submit" name="submi" value="hardcopy" class="button">
		    <input type="hidden" name="table" value="sell">
		      <?php } else{?>
		     <input type="submit" name="submi" value="hardcopy" class="button">
		    <input type="hidden" name="table" value="sell">
		     <input type="hidden" name="from" value="<?php echo $from;?>">
		      <input type="hidden" name="to" value="<?php echo $to;?>">
		      <?php }?>
		</form>-->
	    </div>				
</body>
</html><?php }?>