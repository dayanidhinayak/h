<?php
include_once('function.php');
 if(isset($_POST['sub']))
    {
        $n=htmlentities($_REQUEST['user']);
        $p=htmlentities($_REQUEST['pass']);
	//echo "select * from `login` where `username`='$n' and `password`='$p'";
       $res=mysql_fetch_array(mysql_query("select * from `login` where `username`='$n' and `password`='$p'"));
      $name=$res['username'];
      $pass=$res['password'];
      if($pass==$p && $name==$n)
       {
	$_SESSION['user']=$n;
	header("location:purchase.php");
       }
       else
       {
	 $msg=" Username password not found";
	header("location:index.php?msg=$msg");
       }
       
    }
?>