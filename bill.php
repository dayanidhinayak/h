<?php
include_once("function.php");
$billid=$_GET['bid'];
 //$type=$_GET['type'];
 $grand=$_GET['grand'];
 $paid=$_GET['paid'];
 $t_p=0;
 $t_d=0;
$fetch=mysql_query("select * from `sell` where `billid`='$billid'")or die(mysql_error());
$res=mysql_fetch_array($fetch);
 $foun=mysql_num_rows($fetch);
 if($foun!=0){
   /* $getcust=mysql_query("select * from `vendor` where `type`='$type'")or die(mysql_error());
while($rescust=mysql_fetch_array($getcust))
{
$getemails[] = array(
'value'  =>$rescust['name']."(".$rescust['address'].")",
'idval' => $rescust['slno']
	);
}*/
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>shop</title>
	<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<style>
@media print
{    
    .no-print
    {
        display: none !important;
    }
	
}
</style>
<script type="text/javascript">
    function pr()
    {
      window.print();
		    window.close();
    }
</script>
</head>
<body onLoad="pr()">
    <table align="center" border="0" style="border:none; text-align:center;">
	<tr>
	    <td colspan="6" align="center">
		<font size="1">MMS FOODS<br>
		G-MINI MART<br>
		SARASPUR,AHMEDABAD<br>
		PIN:380018<br>
		C care: 8866125008 </font>
</br>	    </td>
	</tr>
	<tr>
	    <td align="center" colspan="6">-------------------------------------------- </td> 
	 
	</tr>
	<tr>
	    <th colspan="6"><font size="1"> CASH MEMO</font></th>
	</tr>
	<!--<tr>
	    <td align="center" colspan="6">-------------------------------------------- </td> 
	 
	</tr>-->
	<tr>
	    <td colspan="6">
		<font size="1"><center>
		C.M.Dt : <?php echo $res['date'];?><br>
		C.M.No : <?php echo $billid;?><br> Cashier :<?php //echo $_SESSION['user']; ?>

		</center></font>	    </td>
	</tr>
	<tr>
      <th colspan="6"><font size="1"> PRODUCTS</font></td>
	 </tr>
	 <tr>
	    <td align="center" colspan="6">-------------------------------------------- </td>
	 
	</tr>
	<tr>      
	    <th><font size="1">Particulars</font></th>
	    <th><font size="1">Qty</font></th>
	    <th><font size="1">Rate</font></th>
		<th><font size="1">Value</font></th>
		<th><font size="1"> Dis </font></th>
	    <th><font size="1">Amount</font></th>
	</tr>
	<tr>
	    <td align="center" colspan="6">-------------------------------------------- </td> 
	 
	</tr>
	<?php
	$total=0;
	$t=0;
		$fetch1=mysql_query("select * from `sell` where `billid`='$billid'")or die(mysql_error());
		while($res1=mysql_fetch_array($fetch1))
		{
		$fetproduct=mysql_query("select * from `product` where `id`='$res1[productid]'");
		$resproduct=mysql_fetch_array($fetproduct);
		$total=$total+$res1['totprice'];
		if($res1['checked']!=""){
		}
		?>
	<tr>
	    <td>
		<font size="1"><?php
		echo $resproduct['prod_name'];
		$t_p=$t_p+$res1['price']*$res1['quantity'];
		$t_d=$t_d+($res1['price']*$res1['quantity'])-$res1['totprice'];
		?></font>	    </td>
	    <td><font size="1"><?php echo $res1['quantity'];?></font></td>
	    <td><font size="1"><?php echo $res1['price'];?></font></td>
		<td><font size="1"><?php echo $res1['price']*$res1['quantity'];?></font></td>
		<td><font size="1"><?php echo ($res1['price']*$res1['quantity'])-$res1['totprice'];?></font></td>
	    <td><font size="1"><?php echo $res1['totprice'];?></font></td>
	</tr><?php }?>
	
	<tr>
	   <td align="center" colspan="6">-------------------------------------------- </td>
	 
	</tr>
	<tr>
	    <td align="right" colspan="3" style="font-size:12px;">Total:  
	  </td>
	    <td><font size="2"><?php echo number_format((float)abs($t_p), 2, '.', '');?></font></td>
	    <td><font size="2"><?php echo number_format((float)abs($t_d), 2, '.', '');?></font></td>
	    <td><font size="2"><?php echo number_format((float)abs($grand), 2, '.', '');?></font></td>

	</tr>
	<tr>
	   <td align="center" colspan="6">-------------------------------------------- </td>
	</tr>
	<!--<tr>
	    <td colspan="3" align="right"></td>
	    <td><font size="1"><?php //echo $total;?></font></td>
	</tr>-->
	
	
	<?php
	if(isset($_GET['paid'])){
	?>
	<tr>
	    <td colspan="5" align="right" style="font-size:12px;">Cash Received: </td>
	    
	    <td><?php echo number_format((float)$paid, 2, '.', '');?></td>
	</tr><?php }?>
	<tr>
	  <td align="center" colspan="6">-------------------------------------------- </td>
	 
	</tr>
<tr>
	    <td colspan="6" align="center">
		<font size="1">Above  Price are inclusive of all taxes</br>
Tin:  24072504245</br>
This is computer generated invoice dose not requird signature </font>	    </td>
	</tr>
	<!--<tr>
	    <td align="center" colspan="6">-------------------------------------------- </td>
	 
	</tr>-->
<tr>
	    <td colspan="6" align="center">
		<font size="1">THANK YOU VISIT AGAIN</br>
"For feedback/complaints,</br>please write
to us at,</br> suggestionmmsfood@gmail.com </font>	    </td>
	</tr>
    </table>
</body>
</html><?php }?>