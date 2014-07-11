
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
</style>
	
<?php $formObj = new formCreator;?>
<h1>View Products</h1>
<?php if($errmsg!='') { ?><div class="errmsg"><?php echo $errmsg;?></div><?php } ?>
<p>Please select an option to perform on the following products</p>
<form id="searchProducts" name="searchProducts" action="" method="post" >
<input type="hidden" name="last_where" value="<?php echo $last_where;?>"  />
<table style="margin-left:auto;margin-right:auto;width:300px;">
	<tr>
		<td colspan="2"><input type="text" name="search" value="<?php echo $_POST['search'];?>"  /><input id="searchnow" value="search" border="0" type="image" src="/images/searchicon.gif" style="padding-left: 10px; vertical-align: top;" name="searchnow"/></td>
	</tr>
</table>  
<br /> 
<table class="shop">
	<tr>
    	<td><a href="javascript:orderLetter('0-9');">#</a></td>
        <td><a href="javascript:orderLetter('a');">A</a></td>
        <td><a href="javascript:orderLetter('b');">B</a></td>
        <td><a href="javascript:orderLetter('c');">C</a></td>                
        <td><a href="javascript:orderLetter('d');">D</a></td>
        <td><a href="javascript:orderLetter('e');">E</a></td>
        <td><a href="javascript:orderLetter('f');">F</a></td>
        <td><a href="javascript:orderLetter('g');">G</a></td>
        <td><a href="javascript:orderLetter('h');">H</a></td>
        <td><a href="javascript:orderLetter('i');">I</a></td>
        <td><a href="javascript:orderLetter('j');">J</a></td>
        <td><a href="javascript:orderLetter('k');">K</a></td>     
        <td><a href="javascript:orderLetter('l');">L</a></td>    
        <td><a href="javascript:orderLetter('m');">M</a></td>    
        <td><a href="javascript:orderLetter('n');">N</a></td>    
        <td><a href="javascript:orderLetter('o');">O</a></td>    
        <td><a href="javascript:orderLetter('p');">P</a></td>                                                                                                       
        <td><a href="javascript:orderLetter('q');">Q</a></td>    
        <td><a href="javascript:orderLetter('r');">R</a></td>    
        <td><a href="javascript:orderLetter('s');">S</a></td>
        <td><a href="javascript:orderLetter('t');">T</a></td>                    
        <td><a href="javascript:orderLetter('u');">U</a></td>
        <td><a href="javascript:orderLetter('v');">V</a></td>    
        <td><a href="javascript:orderLetter('w');">W</a></td>    
        <td><a href="javascript:orderLetter('x');">X</a></td>    
        <td><a href="javascript:orderLetter('y');">Y</a></td>
        <td><a href="javascript:orderLetter('z');">Z</a></td>   
        <td><a href="javascript:orderLetter('');">Clear</a></td>   
</tr>
</table> 
<br />                                                                        
<table class="shop">
	<tr style="background-image:url(/images/table_bg.gif);font-size:11px;font-weight:700;">
    	<td>&nbsp;</td>
        <td>Image</td>
        <td>Product Name<a href="javascript:orderField('name','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('name','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Code<a href="javascript:orderField('pc','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('pc','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Stock Level<a href="javascript:orderField('stock','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('stock','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Price<a href="javascript:orderField('price','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('price','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Visible<a href="javascript:orderField('visible','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('visible','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Featured<a href="javascript:orderField('featured','asc');"><img src="/images/sortup.gif" /></a><a href="javascript:orderField('featured','desc');"><img src="/images/sortdown.gif" /></a></td>
        <td>Action</td>
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
	if($data[$i]['variation_id']>0)
	{
		$stock_level = '<div '.$desc.' style="color:grey;"><em>Variations Control Stock</em></div>';
	}
	elseif($data[$i]['stock_level']==NULL) 
	{ 
		//$desc = $formObj->Helper('Stock level','stock_level_indicator','Stock levels are not managed for this item'); 
		$stock_level = '<div '.$desc.' style="color:grey;"><em>Not managed</em></div>';
	}
	elseif($data[$i]['stock_level']>$data[$i]['low_stock_level']) 
	{
		//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: No');
		$stock_level = '<div '.$desc.' style="color:green;">Good</div>';
	}
	elseif($data[$i]['stock_level']==0) 
	{
		//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: Yes');
		$stock_level = '<div '.$desc.' style="color:red;">Out of stock</div>';
	}	
	elseif($data[$i]['stock_level']<=$data[$i]['low_stock_level'])
	{
		//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: Yes');
		$stock_level = '<div '.$desc.' style="color:brown;">Running low</div>';	
	}	

	if($i%2) $class = 'searchResult1';else $class = 'searchResult2';
	$imageData = $formObj->SelectQuery("SELECT * FROM tbl_shop_products_images WHERE product_id = '".$data[$i]['id']."' ORDER BY image_order ASC LIMIT 0,1","master");
	?>
    <tr style="height:60px;">
    	<td><?php $formObj->formTick('',$data[$i]['id'],'item_selected','');?></td>
    	<td><img src="/shop_images/small/<?php echo $imageData[0]['file_location'];?>" /></td>
    	<td><?php echo $data[$i]['product_name'];?></td>
        <td><?php echo $data[$i]['product_code'];?></td>   
        <td><?php echo $stock_level;?></td>     
        <td><?php echo CURRENCY_ENTITY;?><?php echo $data[$i]['price'];?></td>   
        <td><img src="/images/<?php if($data[$i]['visible']==1) echo 'tick.gif'; else echo 'cross.gif';?>" /></td>        
		<td><img src="/images/<?php if($data[$i]['featured']==1) echo 'tick.gif'; else echo 'cross.gif';?>" /></td>        
        <td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
	if($data[$i]['variation_id']>0)
	{
		$get_variations = $formObj->SelectQuery("SELECT * FROM tbl_shop_products_variations_stock WHERE product_id = '".$data[$i]['id']."'","master");
		$variation_name = $formObj->SelectQuery("SELECT variation_name FROM tbl_shop_products_variations WHERE id = '".$data[$i]['variation_id']."'","master");
		?>
        <tr style="background-image:url(/images/table_bg.gif);font-size:10px;font-weight:500;">          
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Variation Group</td>
            <td>Variation Name</td>        
            <td>Stock Level</td>             
            <td>&nbsp;</td>
            <td>&nbsp;</td>              
            <td>&nbsp;</td>     
            <td>Action</td>              
		</tr>
        <?php
		for($j=0;$j<count($get_variations);$j++)
		{
			if($get_variations[$j]['stock_level']==NULL) 
			{ 
				//$desc = $formObj->Helper('Stock level','stock_level_indicator','Stock levels are not managed for this item'); 
				$variationstock_level = '<div '.$desc.' style="color:grey;"><em>Not managed</em></div>';
			}
			elseif($get_variations[$j]['stock_level']>$get_variations[$j]['low_stock_level']) 
			{
				//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: No');
				$variationstock_level = '<div '.$desc.' style="color:green;">Good</div>';
			}
			elseif($get_variations[$j]['stock_level']==0) 
			{
				//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: Yes');
				$variationstock_level = '<div '.$desc.' style="color:red;">Out of stock</div>';
			}
			elseif($get_variations[$j]['stock_level']<=$get_variations[$j]['low_stock_level'])
			{
				//$desc = $formObj->Helper('Stock level','stock_level_indicator','Current stock level: '.$data[$i]['stock_level'].'<br />Low stock level: '.$data[$i]['low_stock_level'].'<br />Order more: Yes');
				$variationstock_level = '<div '.$desc.' style="color:brown;">Running low</div>';	
			}
			$variation_option_name = $this->SelectQuery("SELECT name FROM tbl_shop_products_variations_options WHERE id = '".$get_variations[$j]['variation_option_id']."'","master");
			?>
        <tr style="font-size:9px;height:50px;">         
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $variation_name[0]['variation_name'];?></td>
            <td><?php echo $variation_option_name[0]['name'];?></td>        
            <td><?php echo $variationstock_level;?></td>            
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>        
            <td><a href="/admin/actions/modules/shoppingCart/editProductVariation/<?php echo $get_variations[$j]['id'];?>/">Edit</a></td>               
		</tr>
		<?php
		}
	}
}
?>
</table>
</form>
