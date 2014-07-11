<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* 16/11/2009 - pagination added
*  
*****************************************/
?>
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View Pages</h1>
<p>Please select an option to perform on the following pages.</p>
<table width="100%">
	<tr class="searchtitle">
		<td>Link Order</td>
        <td>Link Display Name</td>
        <td>Link Type</td>
        <td>Module Name</td>
        <td>Sublinks</td>
        <td>Menu Type</td>
        <td>Page Name</td>        
        <td>Action</td>
	</tr>        
<?php 

	for($i=0;$i<count($q);$i++){	

	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $q[$i]['link_order'];?></td>
        <td><?php echo $q[$i]['link_name'];?></td>
        <td><?php echo $q[$i]['link_type'];?></td>
        <td><?php echo $q[$i]['module_name'];?></td>
        <td><?php if($q[$i]['has_sublinks']=='1') echo 'Yes'; else  echo 'No';?></td>
        <td><?php echo $q[$i]['menu_type'];?></td>
    	<td><?php echo $q[$i]['page_name'];?></td>        
        <td><a href='/admin/actions/modules/default/editpage/<?php echo $q[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/default/deletepage/<?php echo $q[$i]['id'];?>/'>Delete</a></td>
	</tr>
    <?php if($q[$i]['has_sublinks']=='1'){
			$sublink_data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE assigned_main_id = '".$q[$i]['id']."' ORDER BY sublink_order ASC","master");
			if(count($sublink_data)==0)
			{
			?>
            <tr class="subsearchtitle">
            	<td colspan="7">None Assigned</td>
            </tr>
            <?php } else {?>
            <tr class="subsearchtitle">
            	<td>Sublink Order</td>
                <td>Sublink Name</td>
                <td>Assigned To</td>
                <td>Menu Type</td>
                <td>Action</td>
			</tr>
            <?php
			for($j=0;$j<count($sublink_data);$j++)
			{
				if($j%2){$style=' class="subsearchResult1"';} else {$style= ' class="subsearchResult2"'; }
			?>
            <tr <?php echo $style; ?>>
           	  	<td><?php echo $sublink_data[$j]['sublink_order'];?></td>
                <td><?php echo $sublink_data[$j]['page_name'];?></td>
                <td><?php echo $q[$i]['link_name'];?></td>
                <td><?php echo $sublink_data[$j]['menu_type'];?></td>
                <td><a href='/admin/actions/modules/default/editpage/<?php echo $sublink_data[$j]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/default/deletepage/<?php echo $sublink_data[$j]['id'];?>/'>Delete</a></td>
            </tr>
    <?php } } } }?>
</table>
<br /> <br /> 
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
<br /> <br /> <br /> 
<?php
$rsObj->getNumberLinks();
?>
