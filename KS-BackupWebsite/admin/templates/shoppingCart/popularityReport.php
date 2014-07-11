<script type="text/javascript">
	$(function() {
		$("#date_from").datepicker( { dateFormat: 'yy-mm-dd' } );	
		$("#date_to").datepicker( { dateFormat: 'yy-mm-dd' } );
	});
	
	function detailedReport(type,date_from,date_to,no_results,item_id)
	{
		document.detailedReport.type.value = type;
		document.detailedReport.date_from.value = date_from;
		document.detailedReport.date_to.value = date_to;
		document.detailedReport.no_results.value = no_results;
		document.detailedReport.item_id.value = item_id;
		document.detailedReport.submit();
	}
		
</script>
<form name="detailedReport" id="detailedReport" action="/admin/shoppingCart/detailedPopularityReport" method="post">
<input type="hidden" name="type">
<input type="hidden" name="date_from">
<input type="hidden" name="date_to">
<input type="hidden" name="item_id">
<input type="hidden" name="no_results">
</form>
<h1>Popularity Reports</h1>
<?php
$formObj = new formCreator;
$formObj->formNew('popularity','');
$formObj->formtextRow('Date from', 'date_from',$_POST['date_from']);
$formObj->formtextRow('Date to', 'date_to',$_POST['date_to']);
$formObj->formnumberRow('No. Top Results', 'number_top',$_POST['number_top']);
$formObj->formSubmit();
?>
<h1>Product Report</h1>
<?php
$count_products = count($product_data);
$count_categories = count($category_data);
$count_ips = count($ip_data);
$count_searches = count($search_data);
if($count_products>0)
{
?>
	<h2><?php echo $getPostArgs['number_top'];?> Most popular products</h2>
    <table style="width:600px;">
    <?php
	for($i=0;$i<$count_products;$i++)
	{
		?>
		<?php
		$product_info = $this->SelectQuery("SELECT product_name, product_code FROM tbl_shop_products WHERE id = '".$product_data[$i]['item_id']."'","master");
		if(count($product_info)==0)
		{
			$product_info[0]['product_name'] = '<span style="color:red;font-size:10px;">Product no longer available</span>';
			$product_info[0]['product_code'] = '';
		}
		
		echo '<tr><td>'.($i+1).'.</td><td><span style="color:green;">'.$product_info[0]['product_name'].'</span></td><td>'.$product_info[0]['product_code'].'</td><td>';?>
        <a href="javascript:detailedReport('product','<?php echo $getPostArgs['date_from'];?>','<?php echo $getPostArgs['date_to'];?>','<?php echo $getPostArgs['number_top'];?>','<?php echo $product_data[$i]['item_id'];?>')"><?php echo $product_data[$i]['cnt'];?> Views</td></tr>
        <?php
	}
	?>
    </table>
<?php
}
if($count_categories>0)
{
?>
	<h2><?php echo $getPostArgs['number_top'];?> Most popular categories</h2>
    <table style="width:600px;">
    <?php
	for($i=0;$i<$count_categories;$i++)
	{
		$category_info = $this->SelectQuery("SELECT category_name FROM tbl_shop_settings_categories WHERE id = '".$category_data[$i]['item_id']."'","master");
		if(count($category_info)==0)
		{
			$category_info[0]['category_name'] = '<span style="color:red;font-size:10px;">Category no longer available</span>';
		}
		
		echo '<tr><td>'.($i+1).'.</td><td><span style="color:green;">'.$category_info[0]['category_name'].'</span></td><td>';?>
        <a href="javascript:detailedReport('category','<?php echo $getPostArgs['date_from'];?>','<?php echo $getPostArgs['date_to'];?>','<?php echo $getPostArgs['number_top'];?>','<?php echo $category_data[$i]['item_id'];?>')"><?php echo $category_data[$i]['cnt'];?> Views</td></tr>
    <?php
	}?>
    </table> 
    <?php
}?>
<?php
if($count_ips>0)
{
?>
	<h2><?php echo $getPostArgs['number_top'];?> Most views per IP</h2>
    <table style="width:600px;">
    <?php
	for($i=0;$i<$count_ips;$i++)
	{
		$ip_info = $this->SelectQuery("SELECT username FROM tbl_clients WHERE id = '".$ip_data[$i]['customer_id']."'","master");
		if(count($ip_info)==0)
		{
			$ip_info[0]['username'] = '<span style="color:red;font-size:10px;">User does not have a client account</span>';
		}
		
		echo '<tr><td>'.($i+1).'.</td><td>'.$ip_data[$i]['ip_address'].'</td><td><span style="color:green;">'.$ip_info[0]['username'].'</span></td><td>';?>
        <a href="javascript:detailedReport('ip','<?php echo $getPostArgs['date_from'];?>','<?php echo $getPostArgs['date_to'];?>','<?php echo $getPostArgs['number_top'];?>','<?php echo $ip_data[$i]['ip_address'];?>')"><?php echo $ip_data[$i]['cnt'];?> Views</td></tr>
        <?php
	}
	?>
    </table> 
    <?php
}?>
<?php
if($count_searches>0)
{
?>
	<h2><?php echo $getPostArgs['number_top'];?> Most searched terms</h2>
    <table style="width:600px;">
    <?php
	for($i=0;$i<$count_searches;$i++)
	{	
		?>
        <tr>
        	<td><?php echo ($i+1);?></td>
            <td><span style="color:green;"><?php echo $search_data[$i]['search_term'];?></span></td>
            <td><?php echo $search_data[$i]['number_results'];?> Results</td>
            <td><a href="javascript:detailedReport('search','<?php echo $getPostArgs['date_from'];?>','<?php echo $getPostArgs['date_to'];?>','<?php echo $getPostArgs['number_top'];?>','<?php echo $search_data[$i]['search_term'];?>')"><?php echo $search_data[$i]['cnt'];?> Views</a></td>
		</tr>
        <?php
	}
	?>
    </table> 
    <?php
}?>

   
