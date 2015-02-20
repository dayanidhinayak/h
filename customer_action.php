<?php
include_once('function.php');
 if(isset($_POST['submit']))
    {
	$type=$_REQUEST['type'];
	$date=$_REQUEST['date'];
	$phone=htmlentities($_REQUEST['phone']);
	$name=htmlentities($_REQUEST['name']);
	$father=htmlentities($_REQUEST['fatname']);
	$dob=htmlentities($_REQUEST['dob']);
	$age=htmlentities($_REQUEST['age']);
	$year=htmlentities($_REQUEST['year']);
	if (isset($_POST['sex'])){
	$sex=htmlentities($_REQUEST['sex']);
	}
	$address=htmlentities($_REQUEST['addr']);
	$location=htmlentities($_REQUEST['location']);
	if (isset($_POST['occupation'])){
	$occupation=$_REQUEST['occupation'];
	}
	$introducer=htmlentities($_REQUEST['introducer']);
	$introid=htmlentities($_REQUEST['introid']);
	if (isset($_POST['iproof'])){
	$identity=htmlentities($_REQUEST['iproof']);
	}
	$email=htmlentities($_REQUEST['email']);
	$amount=$_REQUEST['amount'];
	
	$fet=mysql_query("select * from `vendor` where `name`='$name' and `phone`='$phone' and `type`='$type'");
	$num=mysql_numrows($fet);
	
	if($num==0 && $name!="" && $phone!="" && $type!="")
	{
	    echo "insert into `vendor` set `name`='$name',`phone`='$phone',`address`='$address',
			`email`='$email',`type`='$type',`location`='$location',`balance`='$amount',`date`='$date',`father`='$father',`dob`='$dob'
			,`age`='$age',`year`='$year',`sex`='$sex',`occupation`='$occupation',`introducer`='$introducer',`introid`='$introid',`identity`='$identity'";
	    mysql_query("insert into `vendor` set `name`='$name',`phone`='$phone',`address`='$address',
			`email`='$email',`type`='$type',`location`='$location',`balance`='$amount',`date`='$date',`father`='$father',`dob`='$dob'
			,`age`='$age',`year`='$year',`sex`='$sex',`occupation`='$occupation',`introducer`='$introducer',`introid`='$introid',`identity`='$identity'") or die(mysql_error());
			
			$sql=mysql_query("SELECT MAX(`slno`) AS `max` FROM  `vendor`");
			$res=mysql_fetch_array($sql);
			
			$paycard=0;
			$payamount=$amount;
			$amount11=$payamount+$paycard;
	
	if($amount11!=0)
	{
		
	mysql_query("insert into `transaction` set `amount`='$amount11',`customer_id`='$res[max]',`desc`='customer  payment',`date`='$date',`cash`='$payamount',`card`='$paycard'");
	echo "insert into `transaction` set `amount`='$amount11',`customer_id`='$res[max]',`desc`='customer  payment',`date`='$date',`cash`='$payamount',`card`='$paycard'";
	
	}
	    $msg="sucessfully inserted";
	}
	else{ $msg="Enter appropriate value";}
	header("location:sell.php?msg=$msg");
    }
?>