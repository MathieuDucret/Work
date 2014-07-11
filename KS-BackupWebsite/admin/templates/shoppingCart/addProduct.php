<h1>Shopping Cart</h1>
<h2>Add Product</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj = new formCreator;
$formObj->formNew('addProduct" enctype="multipart/form-data"','');
?>
<tr>
	<td style="width:140px;">&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php 
$category_data = $formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories WHERE parent_categoryid=0 AND (brand IS NULL OR brand='0') ORDER BY category_name ASC","master");

$formObj->formtextRow('Product Name', 'product_name',$_POST['product_name']);
$formObj->formtextRow('Product Code', 'product_code',$_POST['product_code'],0,'This field can be used to assign custom item codes to your products. This can be useful when corresponding with customers and for auditing product ranges easily.');
$formObj->formSelectRow('Product Variation','variation_id',$formObj->SelectQuery("SELECT id, variation_name FROM tbl_shop_products_variations","master"),'variation_name','id',$_POST['variation_id'],2,'If you choose a product variation, you must set the stock levels for each variation separately on the variation stock level screen');
?>
<tr>
	<td>Categories</td>
    <td><div style="height:100px;border:1px solid #000;padding:5px;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888"><?php 
	$count=0;
	for($i=0;$i<count($category_data);$i++) 
	{ 		
		echo '<div style="height:25px;">';$formObj->formTick($category_data[$i]['category_name'],$category_data[$i]['id'],'category_id['.$count.']',$_POST['category_id'][$count]);echo ' '.$category_data[$i]['category_name'];echo '</div>';
		$subcategory_data = $formObj->SelectQuery("SELECT * FROM tbl_shop_settings_categories WHERE parent_categoryid='".$category_data[$i]['id']."' AND (brand IS NULL OR brand='0') ORDER BY category_name ASC","master");		
		$count++;
		if(count($subcategory_data)>0)
		{
			for($j=0;$j<count($subcategory_data);$j++)
			{			
				echo '<div style="margin-left:15px;height:25px;">';$formObj->formTick($subcategory_data[$j]['category_name'],$subcategory_data[$j]['id'],'category_id['.$count.']',$_POST['category_id'][$count]);echo ' '.$subcategory_data[$j]['category_name'].' '.$_POST['category_id'][$count]; echo '</div>';		$count++;?>
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
		{?>
        	<div style="margin-left:15px;height:25px;">
				<?php $formObj->formTick($brand_data[$i]['category_name'],$brand_data[$i]['id'],'category_id['.$count.']',$_POST['category_id'][$count]);echo ' '.$brand_data[$i]['category_name'].' '.$_POST['category_id'][$count];?>
            </div>
			<?php
			$count++;
		}?>
    	</div>
	</td>
</tr>         
<?php
//$formObj->formSelectRowMulti('Category','category_id',$category_data,'category_name','id',$data[0]['category_id'],2,'All categories in the system can be selected. If you choose a category that has a master category, your item will appear in both categories.');
$formObj->formtextAreaRow('Description', 'description',$_POST['description'],5,40);
$formObj->formtextRow('Product Measurement Unit', 'product_measurement_unit',$_POST['product_measurement_unit'],0,'This is the product measurement unit. If you have a liquid measured in litres, please type l here. If you have a solid measured in grams, please enter g here. Any measurement units can be entered.');
$formObj->formtextRow('Product measurement', 'product_measurement',$_POST['product_measurement'],0,'Product measurement.');
$formObj->formtextRow('Product width', 'product_width',$_POST['product_width'],0,'Product width in centimetres.');
$formObj->formtextRow('Product height', 'product_height',$_POST['product_height'],0,'Product height in centimetres.');
$formObj->formtextRow('Product depth', 'product_depth',$_POST['product_depth'],0,'Product depth in centimetres.');
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
$formObj->formnumberRow('Stock Level', 'stock_level',$_POST['stock_level'],0,'If you wish to manage stock levels for this product, please set a positive number for your initial stock level. If you do not wish to manage stock levels, please leave this field blank.');
$formObj->formnumberRow('Low stock Level', 'low_stock_level',$_POST['low_stock_level'],0,'When inventory levels fall below this number, this item will be flagged as low stock.');
$formObj->formtextRow('Search tags', 'search_tags',$_POST['search_tags'],0,'Please enter comma separated search terms that you wish this product to appear in searches for. The more terms you add, the more searches this item will appear in.');
?>
<tr>
	<td>Featured</td>
    <td><?php $formObj->formTick('Featured','1','featured',$_POST['featured'],'If you wish your product to have premium placement in the site, please ensure featured is ticked');?></td>
</tr>
<tr>
	<td>Visible</td>
    <td><?php $formObj->formTick('Visible','1','visible',$_POST['visible'],'If you wish your product to appear in the shop, ensure this is ticked');?></td>
</tr>
<tr>
	<td>VAT on item</td>
    <td><?php $formObj->formTick('VAT','1','vat',$_POST['vat'],'If you wish your product to show the VAT element broken out, plase tick this. Ensure you still enter the price below as the gross price INCLUDING VAT.');?></td>
</tr>
<?php
$formObj->formtextRow('Bulk Quantity', 'bulk_quantity',$_POST['bulk_quantity'],0,'If you wish to implement bulk discounts, this is the number that must be purchased to obtain the discount. Multiples of this can also be purchased at the discounted rate.');
$formObj->formtextRow('Bulk Price', 'bulk_price',$_POST['bulk_price'],0,'This field is the price (per unit) your customers will purchase the product for if they buy bulk quantities.');
$formObj->formtextRow('Retail Price', 'retail_price',$_POST['retail_price'],0,'This field is the more expensive price a customer can find this item from other retail providers. It will be used to illustrate how your actual price is cheaper and the effective discount you are offering customers.');
$formObj->formtextRow('Price', 'price',$_POST['price'],0,'This field is the price your customers will purchase the product for, before any discounts are applied (if applicable).');
$formObj->formSubmit();

$formObj->formAddCK('description')
?>
