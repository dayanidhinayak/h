<?php
include_once('function.php');
$proid='';
echo $total=htmlentities($_POST['total']);
foreach($_POST ['purchase'] as $key => $value)
    {
          //print_r( $value);//."----".$value;
         $bar=$value['barcode'];
         $product=$value['product'];
         $quantity=$value['quantity'];
         $freeqty=$value['freeqty'];
         $totqty=$value['totqty'];
         $mrp=$value['mrp'];
         $priceunit=$value['priceunit'];
         $totprice=$value['totprice'];
         $spldis=$value['spldis'];
         $deldis=$value['deldis'];
         $schdis=$value['schdis'];
         $taxin=$value['taxin'];
         $tottax=$value['tottax'];
         $totamt=$value['totamt'];
         
         $product_id=$value['pid'];
         $orderno=$value['orderno'];
         $vendorid=$value['vendorid'];
         $catval=$value['categoryid'];
         $compval=$value['companyid'];
         $date=date("Y-m-d");
         $uid=uniqid();
        echo "insert into `purchase` set `vendor_id`='$vendorid',`product_id`='$product_id',`quantity`='$quantity',`freequantity`='$freeqty',
                    `totalquantity`='$totqty',`mrp`='$mrp',`price`='$priceunit',`totalprice`='$totprice',`specialdiscount`='$spldis',
                    `dealerdiscount`='$deldis',`schemediscount`='$schdis',`tax`='$taxin',`totaltax`='$tottax',
                    `totalamount`='$totamt',`date`='$date',`bar`='$bar',`category`='$catval',`company`='$compval',
                    `uniqueid`='$uid',`order_no`='$orderno'";
     mysql_query("insert into `purchase` set `vendor_id`='$vendorid',`product_id`='$product_id',`quantity`='$quantity',`freequantity`='$freeqty',
                    `totalquantity`='$totqty',`mrp`='$mrp',`price`='$priceunit',`totalprice`='$totprice',`specialdiscount`='$spldis',
                    `dealerdiscount`='$deldis',`schemediscount`='$schdis',`tax`='$taxin',`totaltax`='$tottax',
                    `totalamount`='$totamt',`date`='$date',`bar`='$bar',`category`='$catval',`company`='$compval',
                    `uniqueid`='$uid',`order_no`='$orderno'") or die(mysql_error());
					
			
			$proid=$product_id;
                        
                        mysql_query("update `product` set `godown`=godown+'$quantity',mrp='$mrp',price='$priceunit' where `id`='$proid'");
                        $msg="inserted sucessfully";
				
    }
    mysql_query("insert into `transaction` set `vendor_id`='$vendorid',`amount`='-$total',`date`='$date',`desc`='product purchesed'");
    
 header("location:purchase.php?msg=$msg");
?>