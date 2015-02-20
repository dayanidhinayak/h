<?php
include_once('function.php');
	$pname=htmlentities($_POST['name'],ENT_QUOTES);
	$sql=mysql_query("select * from `company` where `comp_name`='$pname'");
	$num=mysql_num_rows($sql);
	if($num==0){
	    mysql_query("insert into `company` set `comp_name`='$pname'");
		$msg="Successfully Company Added";
		}
		else
		{
		$msg="This company is already exist";
		}
		header("location:purchase.php?msg=$msg");
?>