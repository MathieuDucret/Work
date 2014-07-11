<?php
$_POST['date_from']=$getPostArgs['date_from'];
$_POST['date_to']=$getPostArgs['date_to'];
?>
<h1>Detailed Report</h1>
<h2>Period of Report</h2>
<p><strong>From</strong><br /><?php if($getPostArgs['date_from']!='') echo date('d-m-Y', strtotime($getPostArgs['date_from'])); else echo 'Live Date'; ?><br />
<strong>To</strong><br /> <?php if($getPostArgs['date_to']!='') echo date('d-m-Y', strtotime($getPostArgs['date_to'])); else echo 'Now'; ?></p>
<table style="width:700px;">
<?php 
if($_POST['type']=='product')
{
	$product_data = $this->SelectQuery("SELECT product_name FROM tbl_shop_products WHERE id = '".$item_id."'","master");
	?>
    <?php if($product_data[0]['product_name']!= '') echo '<h2>'.$product_data[0]['product_name'].'</h2>'; else echo '<h2 style="color:red;">Product no longer available</h2>';?>
    <?php	
	for($i=0;$i<count($data);$i++)
	{		
		$user_data = $this->SelectQuery("SELECT username FROM tbl_clients WHERE id = '".$data[$i]['customer_id']."'","master");?>
		<tr>
			<td><?php echo $i+1;?>.</td>
			<td><?php echo date('d-m-Y H:i:s',strtotime($data[$i]['date_time']));?></td>
			<td><?php echo $data[$i]['ip_address'];?></td>
			<td><?php if($user_data[0]!='') echo $user_data[0]['username']; else echo '<span style="color:red;font-size:10px;">No username found for this IP</span>';?></td>
		</tr>            
    <?php
	}
}
elseif($_POST['type']=='category')
{
	$category_data = $this->SelectQuery("SELECT category_name FROM tbl_shop_settings_categories WHERE id = '".$item_id."'","master");
	?>
    <?php if($category_data[0]['category_name']!= '') echo '<h2>'.$category_data[0]['category_name'].'</h2>'; else echo '<h2 style="color:red;">Category no longer available</h2>';?>
    <?php
	for($i=0;$i<count($data);$i++)
	{
		$user_data = $this->SelectQuery("SELECT username FROM tbl_clients WHERE id = '".$data[$i]['customer_id']."'","master");?>
		<tr>
			<td><?php echo $i+1;?>.</td>
			<td><?php echo date('d-m-Y H:i:s',strtotime($data[$i]['date_time']));?></td>
			<td><?php echo $data[$i]['ip_address'];?></td>
			<td><?php if($user_data[0]!='') echo $user_data[0]['username']; else echo '<span style="color:red;font-size:10px;">No username found for this IP</span>';?></td>
		</tr>            
    <?php
	}
}
elseif($_POST['type']=='ip')
{
	for($i=0;$i<count($data);$i++)
	{
		$user_data = $this->SelectQuery("SELECT username FROM tbl_clients WHERE id = '".$data[$i]['customer_id']."'","master");
		if($data[$i]['type']=='product')
		{
			$item_data = $this->SelectQuery("SELECT product_name as name FROM tbl_shop_products WHERE id = '".$data[$i]['item_id']."'","master");
		}
		elseif($data[$i]['type']=='category')
		{
			$item_data = $this->SelectQuery("SELECT category_name as name FROM tbl_shop_settings_categories WHERE id = '".$data[$i]['item_id']."'","master");
		}
		if(count($item_data)==0)
		{
			$item_data[0]['name'] = '<span style="color:red;font-size:10px;">Item no longer available</span>';
		}?>
		<tr>
			<td><?php echo $i+1;?>.</td>
			<td><?php echo date('d-m-Y H:i:s',strtotime($data[$i]['date_time']));?></td>
			<td><?php echo $data[$i]['ip_address'];?></td>
            <td><span style="color:green;"><?php echo $item_data[0]['name'];?></span></td>
            <td><?php echo $data[$i]['type'];?></td>
			<td><?php if($user_data[0]!='') echo $user_data[0]['username']; else echo '<span style="color:red;font-size:10px;">No username found for this IP</span>';?></td>
		</tr>            
    <?php
	}
}
elseif($_POST['type']=='search')
{
	?>
    <h2><?php echo $item_id.' - '.$data[0]['number_results'].' Results';?></h2>
    <?php
	for($i=0;$i<count($data);$i++)
	{		
		$user_data = $this->SelectQuery("SELECT username FROM tbl_clients WHERE id = '".$data[$i]['customer_id']."'","master");?>
		<tr>
			<td><?php echo $i+1;?>.</td>
			<td><?php echo date('d-m-Y H:i:s',strtotime($data[$i]['date_time']));?></td>
			<td><?php echo $data[$i]['ip_address'];?></td>
			<td><?php if($user_data[0]!='') echo $user_data[0]['username']; else echo '<span style="color:red;font-size:10px;">No username found for this IP</span>';?></td>
		</tr>            
    <?php
	}
}
?>
</table>
