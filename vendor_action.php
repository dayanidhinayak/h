<?php
include_once('function.php');
 if(isset($_POST['submit']))
    {
	$name=htmlentities($_REQUEST['name']);
	$phone=htmlentities($_REQUEST['phone']);
	$address=htmlentities($_REQUEST['address']);
	$email=htmlentities($_REQUEST['email']);
	
	$fet=mysql_query("select * from `vendor` where `name`='$name' and `phone`='$phone' and `type`='0'");
	$num=mysql_numrows($fet);
	
	if($num==0 && $name!="" && $phone!="")
	{
	    mysql_query("insert into `vendor` set `name`='$name',`phone`='$phone',`address`='$address',`email`='$email'");
	    $msg="Sucessfully Vendor Added";
	}else{ $msg="This is already exist";}
	header("location:purchase.php?msg=$msg");
    }
?>