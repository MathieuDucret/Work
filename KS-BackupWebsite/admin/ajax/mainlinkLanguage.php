<?php
include('../../includes/inc.start.php');
$dbObj = new DataBase;
$getmainsublinks = $dbObj->SelectQuery("SELECT * FROM tbl_pages WHERE link_type = 'main' AND has_sublinks = '1' AND language_id = '".mysql_real_escape_string($_GET['language_id'])."' ORDER BY link_order ASC","master");
?>
<tr id="assigned_main_id_row" class="advanced" style="display:none;">
  	<td>Assigned Main ID</td>
  	<td><select id="assigned_main_id" name="assigned_main_id">
  	<option <?php if($getPostArgs['assigned_main_id']=='0') echo 'selected';?> value="0">None</option>
  	<?php for($i=0;$i<count($getmainsublinks);$i++){?>
	<option <?php if($getPostArgs['assigned_main_id']==$getmainsublinks[$i]['id']) echo 'selected';?> value="<?php echo $getmainsublinks[$i]['id'];?>"><?php echo $getmainsublinks[$i]['page_name'];?></option>
	<?php } ?>
	</select><span style="font-size:11px;margin-left:10px;color:#c00;">Note - If no links appear here and you have added main links that can have sublinks, select a language from the top of the page</span>
</tr>