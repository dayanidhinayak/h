<?php
include_once('function.php');
//var_dump($_POST);
$date=date("Y-m-d");
$time=$_SESSION['time']=time();
$cash=htmlentities($_POST['cash']);
$check=htmlentities($_POST['check']);
$due=htmlentities($_POST['due']);
$currentbalance=$cash+$check+$due;
$altotal=htmlentities($_POST['alltotal']);
$remaining=$currentbalance-$altotal;
$paid=$cash+$check;
foreach($_POST ['sell'] as $key => $value)
    {
        //print_r($value);
        $bar=$value['barcode'];
        $product=$value['product'];
        $quantity=$value['quantity'];
        $price=$value['price'];
        $discount=$value['discount'];
        $total=$value['total'];
        $uid=$value['uid'];
        $pid=$value['pid'];
        $unitprice=$value['pric'];
        $custid=$value['cid'];
        
        $faddress=mysql_query("select address from vendor where slno='$custid'");
        $raddress=mysql_fetch_array($faddress);
        $custarea=$raddress['address'];
        
        /*echo "insert into `sell` set `billid`='$time',`name`='$custid',`productid`='$pid',`quantity`='$quantity',
                    `price`='$unitprice',`totprice`='$total',`g_total`='$alltotal',`barcode`='$bar',`date`='$date',
                    `address`='$custarea',`uniqueid`='$uid'";*/
        mysql_query("insert into `sell` set `billid`='$time',`name`='$custid',`productid`='$pid',`quantity`='$quantity',
                    `price`='$unitprice',`totprice`='$total',`g_total`='$alltotal',`barcode`='$bar',`date`='$date',
                    `address`='$custarea',`uniqueid`='$uid'");
        mysql_query("update vendor set balance='$remaining' where slno='$custid' ");
        //echo "update `product` set sell_price='$unitprice',`stock`=`stock`-$quantity where `id`='$pid'";
       mysql_query("update `product` set sell_price='$unitprice',`stock`=`stock`-$quantity where `id`='$pid'");
        
    }
    if($cash!="" || $check!="")
    {
        
        //echo "insert into `transaction` set `amount`='$paid',`billid`='$time',`date`='$date',`customer_id`='$custid',`desc`='customer  payment',`cash`='$cash',`card`='$check'";
        mysql_query("insert into `transaction` set `amount`='$paid',`billid`='$time',`customer_id`='$custid',`desc`='customer  payment',`date`='$date',`cash`='$cash',`card`='$check'");
    }
    header("location:bill.php?bid=$time&grand=$altotal&paid=$paid");
        ?>