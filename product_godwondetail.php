<?php
include_once('function.php');
$bar=$_GET['code'];
//echo "select * from `stock` where `bar`='$bar' or `product_name`='$bar'";
//echo "select * from `purchase` where `bar`='$bar'";
$fetch=mysql_query("select * from `purchase` where `bar`='$bar'");
$num=mysql_num_rows($fetch);
if($num>0){
$res=mysql_fetch_array($fetch);
$pid=$res['product_id'];

	$mprice=$res['mrp'];
	$price=$res['price'];
	$mrpval=$mprice-$price;
$sql=mysql_query("select * from `percent`");
$res2=mysql_fetch_array($sql);
$retailer=$res2['retailer'];
$distributer=$res2['distributer'];
$customer=$res2['customer'];
$aret=$mrpval*($retailer/100);
$ret1=$price+$aret;
 $ret=number_format((float)$ret1, 2, '.', ''); 
$adis=$mrpval*($distributer/100);
$dis1=$price+$adis;
 $dis=number_format((float)$dis1, 2, '.', ''); 
$acust=$mrpval*($customer/100);
$cust1=$price+$acust;
 $cust=number_format((float)$cust1, 2, '.', ''); 
?>
                                        <tr>
					    <td>Product Name</td>
					    <td colspan="2">
						<?php
					    //echo "select * from `product` where `barcode`='$bar'";
					    $fetchpro=mysql_query("select * from `product` where `barcode`='$bar'");
					    ?>
					    <select class="text" name="hpid" id="hpid" onchange="return change(this.value)" style="width:177px;">
					    <?php
					    while($respro=mysql_fetch_array($fetchpro))
					    {
						$avlquant=$respro['godown'];
					    if($avlquant>0){
					    ?>
					      <option value="<?php echo $respro['id'];?>"><?php echo $respro['prod_name']."(".$respro['mrp'].")";?></option><?php }}?>
					     </select>
					    </td>
					</tr>
					<tr>
						<td>category</td>
						<?php
						$fetchcategory=mysql_query("select * from `category` where `id`='$res[category]'");
						$rescategory=mysql_fetch_array($fetchcategory);
						?>
						<td colspan="2"><input type="text" name="hcat" id="hcat" value="<?php echo $rescategory['cat_name'];?>" readonly="true"  class="text"></td>
						<input type="hidden" name="cat" id="cat" value="<?php echo $rescategory['id'];?>">
					</tr>
					<tr>
						<td>company</td>
						<?php
						$fetchcompany=mysql_query("select * from `company` where `id`='$res[company]'");
						$rescompany=mysql_fetch_array($fetchcompany);
						?>
						<td colspan="2"><input type="text" name="hcomp" id="hcomp" value="<?php echo $rescompany['comp_name'];?>" readonly="true"  class="text"></td>
						<input type="hidden" name="comp" id="comp" value="<?php echo $rescompany['id'];?>" readonly="true" >
					</tr>
					<tr>
						<td>Quantity</td>
						<td><input type="text" name="quant" class="text" id="qtyid" value=""/></td>
						<td id="stk"></td>
					</tr>
					<tr>
						<td>Mrp</td>
						<td colspan="2"><input type="text" name="mrp" id="mrp" value="<?php echo $res['mrp'];?>" readonly="true"  class="text"></td>
						<input type="hidden" name="ordername" id="order" value="<?php echo $res['order_no'];?>">
					</tr>
					<tr>
						<td>purchase price </td>
						<td colspan="2"><input type="text" name="spri" id="spri" value="<?php echo $res['price'];?>" readonly="true"  class="text"></td>
					</tr>
					<tr>
						<td>Retailer</td>
						<td>Distributer</td>
						<td>Customer</td>
					</tr>
					<tr>
					<td><input type="text" name="retailpcnt" id="retailpcnt" value="<?php echo $retailer;?>" class="text" style="width: 50px; margin-right:3px;" onblur="return calprice1(this.value)"/>%<input type="text" name="priceretailer" id="priceretailer" class="text" value="<?php echo $ret;?>" onblur="return calpercent1(this.value)" style="width: 50px;  margin-right:3px;margin-left:4px;"/>Rs</td>
					<td><input type="text" name="distpcnt" id="distpcnt" class="text" value="<?php echo $distributer;?>" style="width: 50px; margin-right:3px;"  onblur="return calprice2(this.value)"/>%<input type="text" name="pricedistributer" id="pricedistributer" class="text" value="<?php echo $dis;?>" onblur="return calpercent2(this.value)" style="width: 50px; margin-right:3px;margin-left:4px;"/>Rs</td>
					<td><input type="text" name="custpcnt" id="custpcnt" value="<?php echo $customer;?>" class="text" style="width: 50px; margin-right:3px;"  onblur="return calprice3(this.value)"/>%<input type="text" name="price" id="price" class="text" value="<?php echo $cust;?>" onblur="return calpercent3(this.value)" style="width: 50px; margin-right:3px;margin-left:4px;"/>Rs</td>
					</tr><?php }?>