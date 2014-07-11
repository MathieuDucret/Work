
<script type="text/javascript">
function orderLetter(letter)
{			
	hidInput= document.createElement('input');	
	hidInput.setAttribute("type", 'hidden');
	hidInput.setAttribute("value", letter);
	hidInput.setAttribute("name", 'letter');
	var foo = document.getElementById("searchProducts");
	foo.appendChild(hidInput);
	document.searchProducts.submit();	
}

function orderField(field,direction)
{			
	hidInput= document.createElement('input');	
	hidInput.setAttribute("type", 'hidden');
	hidInput.setAttribute("value", field+' '+direction);
	hidInput.setAttribute("name", 'field');
	var foo = document.getElementById("searchProducts");
	foo.appendChild(hidInput);
	document.searchProducts.submit();	
}

function shipStatus(id)
{	
	var date;
	date = document.getElementById('shipDate'+id).value;
	if(date=='')
	{
		alert('Please enter the date this order was shipped');
	}
	else
	{
		shipped_id= document.createElement('input');	
		shipped_id.setAttribute("type", 'hidden');
		shipped_id.setAttribute("value", id);
		shipped_id.setAttribute("name", 'shipped_id');
		shipped_date= document.createElement('input');	
		shipped_date.setAttribute("type", 'hidden');
		shipped_date.setAttribute("value", date);
		shipped_date.setAttribute("name", 'shipped_date');
		
		var foo = document.getElementById("actions");
		foo.appendChild(shipped_id);
		foo.appendChild(shipped_date);
		document.actions.submit();	
	}
}

function paidStatus(id)
{	
	var transaction_id;
	transaction_id = document.getElementById('transactionId'+id).value;
	if(transaction_id=='')
	{
		alert('Please enter the transaction ID for this payment. This should be the unique reference number of the payment taken.');
	}
	else
	{
		order_id= document.createElement('input');	
		order_id.setAttribute("type", 'hidden');
		order_id.setAttribute("value", id);
		order_id.setAttribute("name", 'order_id');
		transaction_data= document.createElement('input');	
		transaction_data.setAttribute("type", 'hidden');
		transaction_data.setAttribute("value", transaction_id);
		transaction_data.setAttribute("name", 'transaction_id');
		
		var foo = document.getElementById("actions");
		foo.appendChild(order_id);
		foo.appendChild(transaction_data);
		document.actions.submit();	
	}
}

function unpaidStatus(id)
{	
	var confirm_var = confirm('Are you sure you want to decline this order?');
	if(confirm_var==true)
	{
		order_id= document.createElement('input');	
		order_id.setAttribute("type", 'hidden');
		order_id.setAttribute("value", id);
		order_id.setAttribute("name", 'reject_id');
		
		var foo = document.getElementById("actions");
		foo.appendChild(order_id);
		document.actions.submit();	
	}
}

function submitSearch()
{
	document.searchProducts.submit();
}

</script>
<style>
.shop img {
	margin-left:3px;
	margin-right:3px;
}
.shop
{
	font-size:11px;
	border-collapse:collapse;
}
.shop a 
{
	font-weight:400;
	text-decoration:underline;
	color:#676767;
}
.shop a:hover
{
	font-weight:400;
	text-decoration:underline;
	color:#676767;
}
.shop.searchtitle
{
	background-image:url("/images/table_bg.gif");
	background-repeat:repeat-x;
	border-style:none solid solid;
}
div.arrow { background:transparent url(/images/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;cursor:pointer;}
div.up { background-position:0px 0px;}

</style>
<script type="text/javascript">  
        $(document).ready(function(){
            $(".shop tr:odd").addClass("odd");
            $(".shop tr:not(.odd)").hide();
            $(".shop tr:first-child").show();
            
            $(".shop tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
		
		
	$(function() {
		$("#date_from").datepicker( { dateFormat: 'yy-mm-dd' } );
		$("#date_to").datepicker( { dateFormat: 'yy-mm-dd' } );	
		$(".shipDate").datepicker( { dateFormat: 'yy-mm-dd' } );	
	});
    </script>	
<?php $formObj = new formCreator;?>
<h1>View Orders</h1>
<?php if($errmsg!='') { ?><div id="errmsg"><?php echo $errmsg;?></div><?php } ?>
<p>Please select an option to perform on the following orders</p>
<form id="actions" name="actions" method="POST" action="" >
</form>
<form id="searchProducts" name="searchProducts" action="" method="POST" >
<input type="hidden" name="last_where" value="<?php echo $last_where;?>"  />
<table style="margin-left:auto;margin-right:auto;width:300px;">
	<tr>
		<td>Date From<input type="text" id="date_from" name="date_from" value="<?php echo $_POST['date_from'];?>"  /></td>
        <td>Date To<input type="text" id="date_to" name="date_to" value="<?php echo $_POST['date_to'];?>"  /></td>
	</tr>
    <tr>
    	<td>Status</td>
        <td><select name="status">
        	<option value="">--Select--</option>
            <option <?php if($_POST['status']=='1') echo 'selected';?> value="1">Paid</option>
            <option <?php if($_POST['status']=='2') echo 'selected';?> value="2">Pending</option>
            <option <?php if($_POST['status']=='0') echo 'selected';?> value="0">Unsuccessful</option>
		</select>  </td>
	</tr>
    <tr>
    	<td>Shipped Status</td>
        <td><select name="shipped_status">
        	<option value="">--Select--</option>
            <option <?php if($_POST['shipped_status']=='1') echo 'selected';?> value="1">Shipped</option>
            <option <?php if($_POST['shipped_status']=='0') echo 'selected';?> value="0">Not Shipped</option>
		</select>  </td>
	</tr>    
    <tr>
    	<td>Payment Method</td>
        <td><select name="payment_method">
        	<option value="">--Select--</option>
            <option <?php if($_POST['payment_method']=='sagepay') echo 'selected';?> value="sagepay">Sagepay</option>
            <option <?php if($_POST['payment_method']=='invoice') echo 'selected';?> value="invoice">Invoice</option>
            <option <?php if($_POST['payment_method']=='telephone') echo 'selected';?> value="phone">Telephone</option>
            <option <?php if($_POST['payment_method']=='voicepay') echo 'selected';?> value="voicepay">Voicepay</option>            
            <option <?php if($_POST['payment_method']=='paypal') echo 'selected';?> value="paypal">Paypal</option>
		</select>                    
    <tr>
    	<td colspan="2">
        <input type="text" name="search" value="<?php echo $_POST['search'];?>"  />
        <input id="searchnow" value="search" border="0" type="image" src="/images/searchicon.gif" style="padding-left: 10px; vertical-align: top;" name="searchnow"/></td>
	</tr> 
</table>  
<br />                                                                        
<table class="shop">
	<tr style="background-image:url(/images/table_bg.gif);font-size:11px;font-weight:700;">
    	<th>&nbsp;</th>
        <th>ID</th>
        <th>Customer<?php //<a href="javascript:orderField('first_name','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('first_name','desc');"><img src="/images/sortdown.gif" /></a>?></th>
        <th>Date<?php //<a href="javascript:orderField('date','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('date','desc');"><img src="/images/sortdown.gif" /></a>?></th>
        <th>Payment Status<?php //<a href="javascript:orderField('stock','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('stock','desc');"><img src="/images/sortdown.gif" /></a>?></th>
	<th>Shipping Status<?php //<a href="javascript:orderField('stock','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('stock','desc');"><img src="/images/sortdown.gif" /></a>?></th>
        <th>Messages<?php //<a href="javascript:orderField('price','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('price','desc');"><img src="/images/sortdown.gif" /></a>?></th>
        <th>Total<?php //<a href="javascript:orderField('visible','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('visible','desc');"><img src="/images/sortdown.gif" /></a>?></th>       
	</tr>
    <?php 
	if(count($data)==0)
	{
		?>
        <tr>
        <td colspan="9">No results available for this search term</td>
        </tr><?php
	}
for($i=0;$i<count($data);$i++)
{	
$shopObj = new shoppingCart;
$client_data = $shopObj->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$data[$i]['user_id']."'","master");
$order_data = $data;
if($data[$i]['shipped_status']==0){ $shipped_status = 'Pending'; }
if($data[$i]['shipped_status']==1){ $shipped_status = 'Shipped'; }
	?>
    <tr class="heading" style="height:50px;border-top:1px #000 solid;border-right:1px #000 solid;border-left:1px #000 solid;">
    	<td><div class="arrow"></div></td>
    	<td><?php echo $data[$i]['id'];?></td>
    	<td><?php echo $client_data[0]['first_name'].' '.$client_data[0]['last_name'].' ('.$client_data[0]['username'].')';?></td>
        <td><?php echo $data[$i]['date'];?></td>   
        <td><?php if($order_data[$i]['status']==1) echo '<span style="color:green;">Successful</span>'; elseif($order_data[$i]['status']==0) echo '<span style="color:blue;">Pending</span>'; elseif($order_data[$i]['status']==2) echo '<span style="color:red;">Unsuccessful</span>';?></td>
	<td><?php if($order_data[$i]['shipped_status']==0) echo '<span style="color:red;">Not Shipped</span>'; else echo date('jS M Y',strtotime($order_data[$i]['date_shipped']));?></td>   
        <td>Messages</td>  
        <td><?php echo CURRENCY_ENTITY;?><?php echo $data[$i]['total'];?></td>          
	</tr>
	<tr style="background-color:#F5F5F5;">
    	<td colspan="2" style="vertical-align:top;border-right:1px solid #000;border-left:1px solid #000;padding:5px;">
        <div><strong>Billing Details</strong></div>
<div>
	<div style="float:left;">Customer Details</div>
    <div style="float:right;">
    	<div><?php echo $order_data[$i]['billing_company'];?></div>
		<div><?php echo $order_data[$i]['billing_first_name'].' '.$order_data[$i]['billing_last_name'];?></div>
	    <div><?php echo $order_data[$i]['billing_address1'];?></div>
   	    <div><?php echo $order_data[$i]['billing_address2'];?></div>
	    <div><?php echo $order_data[$i]['billing_town'];?>, <?php echo $order_data[$i]['billing_county'];?> <?php echo $order_data[$i]['billing_postcode'];?></div>      
   	    <div><?php echo $order_data[$i]['billing_country'];?></div>          
	</div>        
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Email</div>
    <div style="float:right;"><?php echo $client_data[0]['email'];?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Date Ordered</div>
    <div style="float:right;"><?php echo date('jS M Y H:i:s',strtotime($order_data[$i]['date']));?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Payment Gateway</div>
    <div style="float:right;"><?php echo $order_data[$i]['payment_method'];?> - <?php echo $order_data[$i]['total'];?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Order Reference</div>
    <div style="float:right;"><?php echo $order_data[$i]['order_referenceid'];?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Payment Status</div>
    <div style="float:right;"><?php if($order_data[$i]['status']==1) echo '<span style="color:green;">Successful</span>'; elseif($order_data[$i]['status']==0) echo '<span style="color:blue;">Pending</span>'; elseif($order_data[$i]['status']==2) echo '<span style="color:red;">Unsuccessful</span>';?></div>
    <div style="clear:both;"></div>
</div>    	                                                     
		</td>
        <td colspan="2" style="vertical-align:top;padding:5px;border-right:1px #000 solid;">
        <div><strong>Shipping Details</strong></div>
<div>
	<div style="float:left;">Customer Details</div>
    <div style="float:right;">
    	<div><?php echo $order_data[$i]['shipping_company'];?></div>
		<div><?php echo $order_data[$i]['shipping_first_name'].' '.$order_data[$i]['shipping_last_name'];?></div>
	    <div><?php echo $order_data[$i]['shipping_address1'];?></div>
   	    <div><?php echo $order_data[$i]['shipping_address2'];?></div>
	    <div><?php echo $order_data[$i]['shipping_town'];?>, <?php echo $order_data[$i]['shipping_county'];?> <?php echo $order_data[$i]['shipping_postcode'];?></div>      
   	    <div><?php echo $order_data[$i]['shipping_country'];?></div>          
	</div>        
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Date Shipped</div>
    <div style="float:right;"><?php if($order_data[$i]['shipped_status']==0) echo '<span style="color:red;">Not Shipped</span>'; else echo date('jS M Y',strtotime($order_data[$i]['date_shipped']));?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Shipping Option</div>
    <div style="float:right;"><?php echo $order_data[$i]['shipping_method'];?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Shipping Time</div>
    <div style="float:right;"><?php echo $order_data[$i]['shipping_duration'];?></div>
    <div style="clear:both;"></div>
</div>
<div>
	<div style="float:left;">Shipping Cost</div>
    <div style="float:right;"><?php echo CURRENCY_ENTITY;?><?php echo $order_data[$i]['shippingtotal'];?></div>
    <div style="clear:both;"></div>
</div>
<?php if($order_data[$i]['shipped_status']==0 && $order_data[$i]['status']!=2){?>
<div style="margin-top:15px;">
Shipped Date
  <input type="text" class="shipDate" id="shipDate<?php echo $order_data[$i]['id'];?>" /><br />
<a href="javascript:shipStatus('<?php echo $order_data[$i]['id'];?>');">Set item status to Shipped</a>
</div>
<?php } ?>
        </td>
        <td style="vertical-align:top;padding:5px;border-right:1px #000 solid;" colspan="3">
                <div><strong>Order Details</strong></div>
<?php 
$product_order = $shopObj->SelectQuery("SELECT * FROM tbl_shop_orders_products WHERE order_id = '".$data[$i]['id']."'","master");
$vat_total= 0;
for($j=0;$j<count($product_order);$j++)
{
?>
<div>
	<div style="float:left;">
		<?php echo $product_order[$j]['quantity'];?> x <?php echo $product_order[$j]['product_name'];?><?php if($product_order[$j]['variation_id']>0) echo ' -  '.$product_order[$j]['variation_type'];?>
        <?php 
		if($product_order[$j]['original_price']>$product_order[$j]['final_price'])
		{
			echo '<div style="color:#C00;font-size:12px;">'.CURRENCY_ENTITY.$product_order[$j]['discount_code'].'</div>';
		}
		?>
    </div>
    <div style="float:right;">
		<?php 
		if($product_order[$j]['original_price']>$product_order[$j]['final_price'])
		{
			echo '<div style="color:#C00;text-decoration:line-through;font-size:12px;">'.CURRENCY_ENTITY.$product_order[$j]['original_price'].'</div>';
		}
        echo '<div>'.CURRENCY_ENTITY.$product_order[$j]['final_price'].'</div>';?>
	</div>
    <div style="clear:both;"></div>
</div>
<?php
	if($product_order[$j]['vat']==1)
	{
		$vat_amount = ($product_order[$j]['vat_price']*$product_order[$j]['quantity']);
		//$vat_total = $vat_amount;
		$vat_total = $vat_total + $vat_amount;
	}
	
}?>
<div style="padding-top:10px;">
	<div style="float:left;">Sub Total</div>
    <div style="float:right;"><?php echo CURRENCY_ENTITY.$order_data[$i]['subtotal'];?></div>
    <div style="clear:both;"></div>
</div>
<?php if($vat_total>0){?>
<div style="padding-top:10px;">
	<div style="float:left;">VAT Element (Included in totals)</div>
    <div style="float:right;"><?php echo CURRENCY_ENTITY.number_format($vat_total,2,'.',',');?></div>
    <div style="clear:both;"></div>
</div>
<?php } ?>
<div>
	<div style="float:left;">Shipping</div>
    <div style="float:right;"><?php echo CURRENCY_ENTITY.$order_data[$i]['shippingtotal'];?></div>
    <div style="clear:both;"></div>
</div>
<div style="border-top:1px solid #000;margin-top:10px;">
	<div style="float:left;">Total</div>
    <div style="float:right;"><?php echo CURRENCY_ENTITY;?><?php echo $order_data[$i]['total'];?></div>
    <div style="clear:both;"></div>
</div>
<?php if($order_data[$i]['status']==0){?>
<div style="margin-top:15px;">
Additional Transaction ID
  <input type="text" id="transactionId<?php echo $order_data[$i]['id'];?>" /><br />
<a href="javascript:paidStatus('<?php echo $order_data[$i]['id'];?>');">Set item status to Paid</a>
<br />
<a href="javascript:unpaidStatus('<?php echo $order_data[$i]['id'];?>');">Set item status to Unsuccessful</a>
</div>
<?php } ?>
        </td>
	</tr>               
	
	<?php    
}
?>
</table>
</form>