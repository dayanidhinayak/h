<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
    $a=0;
    $c=0;
    $d=0;
 ?>
<html>
<head>
<link href="style.css" rel="stylesheet"  type="text/css"/>
    
 <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
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
<style>
.table3{border:1px solid #ccc; border-collapse:collapse;line-height:3; margin-top:0px;}
.table3 tr{border:1px solid #ccc; border-collapse:collapse;}
.table3 tr td{border:1px solid #ccc; border-collapse:collapse;}		 
		 
</style>
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
<input type="submit" name="submit" value="submit" class="button"/>
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
$sql=mysql_query("select * from `transaction` where date between '$_POST[rpt]' and '$_POST[rpt1]' ");

echo "<span style='font-family:arial; font-size:16px; color:#51A351;'>Report From"."  ".$from." To ".$to."</span><span style='font-weight:bold;color:#51A351;margin-left:5px;'>:</span>";

?>
</div>
<?php
}else{$sql=mysql_query("select * from `transaction`");}
?>
 <div id="content2"> 
	<table class="table1" width="100%">
	    <tr class="tr1">
		<th>Date</th>
		<th>Credit</th>
		<th>Debit</th>
		<th>Balance</th>
		<th>Details</th>
	    </tr>
	</table>
	<div id="content2" style="height:220px; overflow:auto; overflow-x:hidden; background:none; padding-top:0px; padding-bottom:0px;">
	   <table class="table1" width="100%">
	    <?php
	    while($res=mysql_fetch_array($sql))
	    {
		$amount=$res['amount'];
	    ?>
	    <tr style="border-collapse:collapse;">
		<td class="td" style="width: 170px;"><?php echo $res['date'];?></td>
		<?php $a=$amount+$a;
		if($amount>0)
		{ $c=$c+$amount; ?>
		<td class="td" style="width: 245px;"><?php echo $res['amount'];?></td>
		<td class="td" style="width: 215px;"></td>
		<td class="td" style="width: 325px;"><?php echo $a;?></td><?php } else { $d=$d+$amount; ?>
		<td class="td" style="width: 200px;"></td>
		<td class="td" style="width: 200px;"><?php echo $res['amount'];?></td>
		<td class="td" style=""><?php echo $a;?></td>
		<?php }?>
		<td class="td" style=""><?php echo $res['desc'];?></td>
	    </tr><?php }?>
	   </table>
	  
	</div>
	<div>
	<table class="table1" width="100%" border="1" cellspacing="0" cellpadding="0" style="line-height:3;" >
	<tr>
	    <td align="center"><?php echo $c;?></td>
	    <td align="center"><?php echo $d;?></td>
	    <td align="center"><?php echo $a;?></td>
	</tr>
	<tr>
	    <th align="left">TotalCredit</th>
	    <th align="center">TotalDebit</th>
	    <th align="center">Balance</th>
	</tr>
	</table>
	</div>
	 <!--<div id="content2" style="width:800px; padding:10px; ">
		<form name="f" method="post" action="transaction_to_excel.php">
		 <?php
		 if(isset($_POST['rpt'])=="" && isset($_POST['rpt1'])==""){
		  ?>
		    <input type="submit" name="submi" value="hardcopy" class="button">
		    <input type="hidden" name="table" value="transaction">
		      <?php } else{?>
		     <input type="submit" name="submi" value="hardcopy" class="button">
		    <input type="hidden" name="table" value="transaction">
		     <input type="hidden" name="from" value="<?php echo $from;?>">
		      <input type="hidden" name="to" value="<?php echo $to;?>">
		      <?php }?>
		</form>
	    </div>-->
		    </div>
		<div>
	    </div>
         </div> 
        </div> 
    </div>	
</div>
</body>
</html> <?php }?>