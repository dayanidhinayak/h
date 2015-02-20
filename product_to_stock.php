<?php
include_once('function.php');
if(!$_SESSION['user'])
{ 
header("location:index.php");
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..::Shop::..</title>
<?php
$getname=mysql_query("select * from `product`")or die(mysql_error());
    while($resname=mysql_fetch_array($getname))
    {
$getemail[] = array(
'value'  =>$resname['prod_name'],
'idval' => $resname['barcode']
	);
    }
?>
<!--autocomplete start-->
<link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
 <!--autocomplete end-->
  <script type="text/javascript"> 
    $(function(){
        var availabledrug=<?= json_encode($getemail); ?>;
        $('#productname').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrug,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#productname').val(valshow);
		 $('#hpid').val(ui.item.idval);
		 $('#bar').val(ui.item.idval);
		 var bar=$('#hpid').val();
		 fetchdet(bar)
        return false;
		}
        });
});
</script>
 <!--autocomplete end-->
<link href="style.css?=wefdftrgrdreret" rel="stylesheet" type="text/css"  />
<style>
.product{ width:200px !important;}
.quantity{width:50px !important;}
.textbox {
height:18px;
float: left;
padding-left: 8px;
font-size: 14px;
color: #333;
border: 1px solid #CCC;
background: none repeat scroll 0% 0% #FFF;
    width:80%;
}
</style>

  <script>
    function fetchdet(val)
    {
	$.ajax({url:"product_godwondetail.php?code="+val,success:function(result){
                $("#prodetail").html(result);
$('#qtyid').focus();
var pid=$('#hpid').val();
stckavl(pid);
                }});  
    }
    
    function stckavl(pi)
		{
		$.ajax({url:"checkavl.php?pidval="+pi,success:function(result){
              $("#stk").html(result);
                }}); 
		}

		
		function valid()
		{
		  var gvnqty=$("#qtyid").val();
		  var extqty=$("#quantt").val();
		  if (parseInt(gvnqty)>parseInt(extqty))
		  {
		    alert("given quntity should be less than existing quntity");
		    return false;
		  }
		  
		}
		
    
  </script>
  

</head>

<body style="background:#f1f1f1;">

<!-------------------------menu bar----------------------->
<?php include_once("menubar.php");?>
<!-------------------------menu bar end----------------------->

<div id="content2" style="width:50%; font-size:14px;">   
    <form name="f" action="product_insert_stock.php" method="post" enctype="multipart/form-data" onSubmit="return valid();">
				    <table class="table" style="width:100%;">
					<tr>
					<td>Bar</td>
					<td colspan="2"><input type="text" name="bar" id="bar" onBlur="return fetchdet(this.value);" class="form"></td>
					</tr>
					<tbody id="prodetail">
					<tr>
					    <td>Product Name</td>
					    <td colspan="2">
						<input type="text" name="productname" id="productname" class="form">
						<input type="hidden" name="hpid" id="hpid">
						</td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td><input type="text" name="quant"  onBlur="return chec(this.value);" class="form" id="qtyid"/></td>
						<td id="stk"></td>
					</tr>
					<tr>
						<td>Mrp</td>
						<td colspan="2"><input type="text" name="mrp" id="mrp" class="form"></td>
					</tr>
					<tr>
						<td colspan="3">Purchase Price</td>
					</tr>
					
					<tr>
						<td>Retailer</td>
						<td>Distributer</td>
						<td>Customer</td>
					</tr>
					<tr>
					<td><input type="text" name="retailpcnt" id="retailpcnt" class="text" style="width:70px; margin-right:3px;" />%<input type="text" name="priceretailer" id="priceretailer" class="text"  style="width: 50px;  margin-right:3px;margin-left:4px;"/>Rs</td>
					<td><input type="text" name="distpcnt" id="distpcnt" class="text"  style="width: 70px; margin-right:3px;"  />%<input type="text" name="pricedistributer" id="pricedistributer" class="text" style="width: 50px; margin-right:3px;margin-left:4px;"/>Rs</td>
					<td><input type="text" name="custpcnt" id="custpcnt" class="text" style="width: 70px; margin-right:3px;"  />%<input type="text" name="price" id="price" class="text"  style="width: 50px; margin-right:3px;margin-left:4px;"/>Rs</td>
					</tr>
					</tbody>
					
					<tr>
					    <td><input type="submit" name="submit" value="Add" class="btn button"/></td>
					    <td>&nbsp;</td>
					     <td>&nbsp;</td>
					</tr>
				    </table>
				    </form>
</div>
</body>
</html><?php }?>