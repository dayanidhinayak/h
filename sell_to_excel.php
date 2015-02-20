<?php
include_once('function.php');
 if(isset($_POST['submi'])){
  $get=$_REQUEST['table'];
  $from=$_REQUEST['from'];
  $to=$_REQUEST['to'];
  if(isset($_REQUEST['from'])=="" && isset($_REQUEST['to'])==""){
   $query = "SELECT  `$get`.`billid` ,  `product`.`prod_name` ,  `$get`.`quantity` ,  `$get`.`price` ,  `$get`.`totprice` ,  `$get`.`barcode` ,  `$get`.`address` ,`$get`.`uniqueid` ,  `$get`.`date` FROM  `$get` INNER JOIN  `product` ON  `$get`.`productid` =  `product`.`id` ORDER BY  `sell`.`id` ASC ";
   
  }else { $query = "SELECT  `$get`.`billid` ,  `product`.`prod_name` ,  `$get`.`quantity` ,  `$get`.`price` ,  `$get`.`totprice` ,  `$get`.`barcode` ,  `$get`.`address` ,`$get`.`uniqueid` ,  `$get`.`date` FROM  `$get` INNER JOIN  `product` ON  `$get`.`productid` =  `product`.`id` where `date` between '$from' and '$to' ORDER BY  `sell`.`id` ASC ";}
  
$header = '';
$data ='';

$export = mysql_query ($query ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $export );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
 
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");

print "$header\n$data";
exit(0);
}
else{
}
if(isset($_POST['sub'])){

$query = "SELECT * FROM `purchase` limit 60";
$header = '';
$data ='';
$export = mysql_query ($query ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $export );
 
for ( $i = 0; $i < $fields ; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . ",";
}
 
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value =$value . ",";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
 
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.csv");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
exit(0);
}
else{
}
?>

