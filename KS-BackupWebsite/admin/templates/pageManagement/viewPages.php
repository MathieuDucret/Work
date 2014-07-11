<script type="text/javascript">
function submitMe(val)
{
	document.pages.submit()
}	

$(function(){
	/*$('#pageManagement .expandable').click(function(){	
		$(this).next().toggle();					 
	});*/
	$("#page_tree")
	.jstree(
	{
		"plugins" : [ "themes", "html_data"]
		
	});

});
</script>
<style type="text/css">
.expandable {
	cursor:pointer;
}
.subsearchtitle {
	display:none;
}
</style>
<h1>View Pages</h1>
<form id="pages" name="pages" action="" method="post">
<?php
$formObj = new formCreator;
$language_array[0]['language'] .= ' (Default)';
$formObj->formSelectRowN('Language','selected_language" onchange="submitMe(this.options[this.selectedIndex].value);',$language_array,'language','id',$current_language);
?>
</form>
<p>Please select an option to perform on the following pages.</p>

<div id="page_tree">
    <ul>        
            <?php
            for($i=0;$i<count($data);$i++)
            {
				$display_module = '/';
				if($data[$i]['module_name']=='default') $display_module .= '';
				else $display_module .= $data[$i]['module_name'];
				?>
			<li>
                <a style="font-size:16px;font-weight:bold;"><?php echo $display_module;?></a>                
                <ul>
                    <?php 
                    $sub_data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE language_id='".$current_language."' AND module_name = '".$data[$i]['module_name']."' ORDER BY page_name ASC","master");					
                    for($j=0;$j<count($sub_data);$j++)
                    {
						$exists = '';
						$type = '';
						$sublinks = '';
						if($sub_data[$j]['file_exists']==1) $exists = ' / Physical File Included';
						if($sub_data[$j]['link_type']=='Sub') $type = ' / Is a Sublink';
						if($sub_data[$j]['has_sublinks']==1) $sublinks = ' / Has Sublinks';
                        ?>
                        <li>
                            <a><?php echo $sub_data[$j]['page_name'].' - ('.$sub_data[$j]['link_name'].') '.$exists.$type.$sublinks;?></a>
                            <a href='/admin/actions/modules/pageManagement/editPage/<?php echo $sub_data[$j]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/pageManagement/deletePage/<?php echo $sub_data[$j]['id'];?>/'>Delete</a>                                                                                               
                        </li>                    
                        <?php
                    }?>
                </ul>
            </li>
            <?php
			}?>               
    </ul>
</div>











<?php
/*
<div style="text-align:right;">
<div id="resultCount"><?php echo $rsObj->total_items;?> results found for your search</div>
<?php
$rsObj->getPreviousNextMenu();
?>
<br />
<?php
$rsObj->getNumberLinks();
?>
</div>
<?php



<table width="100%" id="pageManagement">
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
	for($i=0;$i<count($q);$i++)
	{	
		$sub_class = '';
		$prefix = '';
		
		if($q[$i]['has_sublinks']==1)
		{
			$sub_class = ' expandable';
			$prefix = '+';
		}
		if($i%2)
		{			
			$style=' class="searchResult1'.$sub_class.'"';
		} 
		else 
		{
			$style= ' class="searchResult2'.$sub_class.'"'; 
		}?>	
        <tr <?php echo $style;?>>
            <td><?php echo $prefix;?><?php echo $q[$i]['link_order'];?></td>
            <td><?php echo $q[$i]['link_name'];?></td>
            <td><?php echo $q[$i]['link_type'];?></td>
            <td><?php echo $q[$i]['module_name'];?></td>
            <td><?php if($q[$i]['has_sublinks']=='1') echo 'Yes'; else  echo 'No';?></td>
            <td><?php echo $q[$i]['menu_type'];?></td>
            <td><?php echo $q[$i]['page_name'];?></td>        
            <td><a href='/admin/actions/modules/pageManagement/editPage/<?php echo $q[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/pageManagement/deletePage/<?php echo $q[$i]['id'];?>/'>Delete</a></td>
        </tr>
		<?php 
        if($q[$i]['has_sublinks']=='1')
        {
            $sublink_data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE assigned_main_id = '".$q[$i]['id']."' ORDER BY sublink_order ASC","master");
            if(count($sublink_data)==0)
            {
            ?>
            	<tr class="subsearchtitle">
            		<td colspan="7">None Assigned</td>
            	</tr>
            <?php 
            } 
            else 
            {?>
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
                    if($j%2)
                    {
                        $style=' class="subsearchResult1"';
                    } 
                    else 
                    {
                        $style= ' class="subsearchResult2"'; 
                    }
                    ?>
                    <tr <?php echo $style; ?>>
                        <td><?php echo $sublink_data[$j]['sublink_order'];?></td>
                        <td><?php echo $sublink_data[$j]['page_name'];?></td>
                        <td><?php echo $q[$i]['link_name'];?></td>
                        <td><?php echo $sublink_data[$j]['menu_type'];?></td>
                        <td><a href='/admin/actions/modules/pageManagement/editPage/<?php echo $sublink_data[$j]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/pageManagement/deletepage/<?php echo $sublink_data[$j]['id'];?>/'>Delete</a></td>
                    </tr>
                <?php
				}
			}
		}
	}?>
</table>
*/?>