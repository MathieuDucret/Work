<script type="text/javascript">
function sendByPost(photo_id)
{
	var photoField = document.getElementById('photo_id');
	photoField.value = photo_id;
	var answer = confirm ("Are you sure you wish to delete this image?")
	if(answer)
	document.delphoto.submit();
}
function sendByPostTag(tag_id)
{
	var tagField = document.getElementById('tag_id');
	tagField.value = tag_id;
	var answer = confirm  ("Are you sure you wish to delete this search tag?")
	if(answer)
	document.deltag.submit();
}
function increaseOrder(inc_id)
{
	var incField = document.getElementById('inc_id');
	incField.value = inc_id;
	document.incphoto.submit();
}
function decreaseOrder(dec_id)
{
	var decField = document.getElementById('dec_id');
	decField.value = dec_id;
	document.decphoto.submit();
}
</script>
<form id='delphoto' name='delphoto' method="post">
<input type='hidden' id='photo_id' name='photo_id' value='' />
</form>
<form id='deltag' name='deltag' method="post">
<input type='hidden' id='tag_id' name='tag_id' value='' />
</form>
<form id='incphoto' name='incphoto' method="post">
<input type='hidden' id='inc_id' name='inc_id' value='' />
</form>
<form id='decphoto' name='decphoto' method="post">
<input type='hidden' id='dec_id' name='dec_id' value='' />
</form>
<h2>Edit Product</h2>
<?php 
if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';
$formObj = new formCreator;
$formObj->formNew('editProduct" enctype="multipart/form-data"','');
?>
<?php
$category_data = $formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories WHERE parent_categoryid=0 AND (brand IS NULL OR brand='0') ORDER BY category_name ASC","master");
$formObj->formtextRow('Product Name', 'product_name',$data[0]['product_name']);
$formObj->formtextRow('Product Code', 'product_code',$data[0]['product_code'],0,'This field can be used to assign custom item codes to your products. This can be useful when corresponding with customers and for auditing product ranges easily.');
$formObj->formSelectRow('Product Variation','variation_id',$formObj->SelectQuery("SELECT id, variation_name FROM tbl_shop_products_variations","master"),'variation_name','id',$data[0]['variation_id'],2,'If you choose a product variation, you must set the stock levels for each variation separately on the variation stock level screen');
?>
<tr>
	<td>Categories</td>
    <td><div style="height:100px;border:1px solid #000;padding:5px;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888"><?php 
	$count=0;	
	for($i=0;$i<count($category_data);$i++) 
	{ 
		for($k=0;$k<count($currentcategory_data);$k++)
		{
			//Check if each of the categories assigned to this product are the same as the current tickbox, when we find one that is, $current_category gets its value
			if($currentcategory_data[$k]['category_id']==$category_data[$i]['id']) $current_category = $currentcategory_data[$k]['category_id'];
		}
	
		echo '<div style="height:25px;">';$formObj->formTick($category_data[$i]['category_name'],$category_data[$i]['id'],'category_id['.$count.']',$current_category);echo ' '.$category_data[$i]['category_name'];echo '</div>';
		$subcategory_data = $formObj->SelectQuery("SELECT * FROM tbl_shop_settings_categories WHERE parent_categoryid='".$category_data[$i]['id']."' AND (brand IS NULL OR brand='0') ORDER BY category_name ASC","master");
		$count++;
		if(count($subcategory_data)>0)
		{
			for($j=0;$j<count($subcategory_data);$j++)
			{	
				for($k=0;$k<count($currentcategory_data);$k++)
				{
					//Check if each of the categories assigned to this product are the same as the current tickbox, when we find one that is, $current_category gets its value
					if($currentcategory_data[$k]['category_id']==$subcategory_data[$j]['id']) $current_category = $currentcategory_data[$k]['category_id'];
				}
				echo '<div style="margin-left:15px;height:25px;">';
				$formObj->formTick($subcategory_data[$j]['category_name'],$subcategory_data[$j]['id'],'category_id['.$count.']',$current_category);
				echo ' '.$subcategory_data[$j]['category_name'].' '.$data[0]['category_id'][$count]; echo '</div>';		
				$count++;?>
<?php		}
		}
	} ?></div></td>
    </tr>
    <tr>
	<td>Brands</td>
    <td>
    	<div style="height:100px;border:1px solid #000;padding:5px;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
        <?php
		$brand_data = $formObj->SelectQuery("SELECT * FROM tbl_shop_settings_categories WHERE brand='1' ORDER BY category_name ASC","master");
		for($i=0;$i<count($brand_data);$i++)
		{
			for($k=0;$k<count($currentcategory_data);$k++)
			{
				//Check if each of the categories assigned to this product are the same as the current tickbox, when we find one that is, $current_category gets its value
				if($currentcategory_data[$k]['category_id']==$brand_data[$i]['id']) $current_category = $currentcategory_data[$k]['category_id'];
			}
			?>
        	<div style="margin-left:15px;height:25px;">
				<?php 
				$formObj->formTick($brand_data[$i]['category_name'],$brand_data[$i]['id'],'category_id['.$count.']',$current_category);
				echo ' '.$brand_data[$i]['category_name'].' '.$data[0]['category_id'][$count];?>
            </div>
			<?php
			$count++;
		}?>
    	</div>
	</td>
</tr>   
<?php
//$formObj->formSelectRow('Category','category_id',$formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories ORDER BY category_name ASC","master"),'category_name','id',$data[0]['category_id'],2,'All categories in the system can be selected. If you choose a category that has a master category, your item will appear in both categories.');
$formObj->formtextAreaRow('Description', 'description',$data[0]['description'],5,40);
$formObj->formtextRow('Product Measurement Unit', 'product_measurement_unit',$data[0]['product_measurement_unit'],0,'This is the product measurement unit. If you have a liquid measured in litres, please type l here. If you have a solid measured in grams, please enter g here. Any measurement units can be entered.');
$formObj->formtextRow('Product measurement', 'product_measurement',$data[0]['product_measurement'],0,'Product measurement.');
$formObj->formtextRow('Product width', 'product_width',$data[0]['product_width'],0,'Product width in centimetres.');
$formObj->formtextRow('Product height', 'product_height',$data[0]['product_height'],0,'Product height in centimetres.');
$formObj->formtextRow('Product depth', 'product_depth',$data[0]['product_depth'],0,'Product depth in centimetres.');
?>
	<tr>
    	<td>Product Image 1</td>
        <td><input type="file" name="photo[]"  /></td>
	</tr>
	<tr>
    	<td>Product Image 2</td>
        <td><input type="file" name="photo[]"  /></td>
	</tr>
	<tr>
    	<td>Product Image 3</td>
        <td><input type="file" name="photo[]"  /></td>
	</tr>
	<tr>
    	<td>Product Image 4</td>
        <td><input type="file" name="photo[]"  /></td>
	</tr>
	<tr>
    	<td>Product Image 5</td>
        <td><input type="file" name="photo[]"  /></td>
	</tr> 
<?php 
if(count($image_data)>0) { echo '<tr><td>Current Images</td><td>&nbsp;</td></tr>'; } 
for($i=0;$i<count($image_data);$i++)
	{
		$increaseOrder = '';
		$decreaseOrder = '';
			if($image_data[$i]['image_order']!=1) $increaseOrder = '<a href="javascript:increaseOrder('.$image_data[$i]['id'].');"/><img src="/images/sortup.gif" /></a>';
			if($image_data[$i]['image_order']!=count($image_data)) $decreaseOrder = '<a href="javascript:decreaseOrder('.$image_data[$i]['id'].');"/><img src="/images/sortdown.gif" /></a>';
		echo '
		<tr>
			<td style="text-align:right;">'.$increaseOrder.'<br />'.$decreaseOrder.'</td>
			<td><img height="100px" src="/shop_images/medium/'.$image_data[$i]['file_location'].'" /><a href ="javascript:sendByPost('.$image_data[$i]['id'].');"/><img src="/images/cross.gif" /></a></td>
		</tr>';
	}
if(count($tag_data)>0) { echo '<tr><td>Current Search Tags</td><td>&nbsp;</td></tr>'; } 	
for($i=0;$i<count($tag_data);$i++)
	{
		echo '
		<tr>
			<td>&nbsp;</td>
		<td><strong><a href ="javascript:sendByPostTag('.$tag_data[$i]['id'].');"/><img src="/images/cross.gif" /></a>'.($i+1).'. <em>'.$tag_data[$i]['tag'].'</em></strong></td>
		</tr>';
	}
	?>                           
<?php   
$formObj->formnumberRow('Stock Level', 'stock_level',$data[0]['stock_level'],0,'If you wish to manage stock levels for this product, please set a positive number for your initial stock level. If you do not wish to manage stock levels, please leave this field blank.');
$formObj->formnumberRow('Low stock Level', 'low_stock_level',$data[0]['low_stock_level'],0,'When inventory levels fall below this number, this item will be flagged as low stock.');
$formObj->formtextRow('Search tags', 'search_tags',$data[0]['search_tags'],0,'Please enter comma separated search terms that you wish this product to appear in searches for. The more terms you add, the more searches this item will appear in.');
?>
<input type="hidden" name="featured" value="0"  />
<input type="hidden" name="visible" value="0"  />
<input type="hidden" name="vat" value="0"  />
<tr>
	<td>Featured</td>
    <td><?php $formObj->formTick('Featured','1','featured',$data[0]['featured'],'If you wish your product to have premium placement in the site, please ensure featured is ticked');?></td>
</tr>
<tr>
	<td>Visible</td>
    <td><?php $formObj->formTick('Visible','1','visible',$data[0]['visible'],'If you wish your product to appear in the shop, ensure this is ticked');?></td>
</tr>
<tr>
	<td>VAT on item</td>
    <td><?php $formObj->formTick('VAT','1','vat',$data[0]['vat'],'If you wish your product to show the VAT element broken out, plase tick this. Ensure you still enter the price below as the gross price INCLUDING VAT.');?></td>
</tr>
<?php
$formObj->formtextRow('Bulk Quantity', 'bulk_quantity',$data[0]['bulk_quantity'],0,'If you wish to implement bulk discounts, this is the number that must be purchased to obtain the discount. Multiples of this can also be purchased at the discounted rate.');
$formObj->formtextRow('Bulk Price', 'bulk_price',$data[0]['bulk_price'],0,'This field is the price (per unit) your customers will purchase the product for if they buy bulk quantities.');
$formObj->formtextRow('Retail Price', 'retail_price',$data[0]['retail_price'],0,'This field is the more expensive price a customer can find this item from other retail providers. It will be used to illustrate how your actual price is cheaper and the effective discount you are offering customers.');
$formObj->formtextRow('Price', 'price',$data[0]['price'],0,'This field is the price your customers will purchase the product for, before any discounts are applied (if applicable).');
$formObj->formSubmit();

$formObj->formAddCK('description');
?>
