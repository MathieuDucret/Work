<style>
tr#bold td {
	font-weight:bold;
}
.table_data
{
	font-size:12px;
}
</style>
<script type="text/javascript" src="/js/common/common.js" ></script>
<h1>CV Search</h1>
<div>
	<div style="width:250px;border:1px solid #000;padding:10px;">
        <?php		
		$formObj = new formCreator;
		$formObj->formNew('cvSearch','/client/cv_search');
		$formObj->formtextRow('Search for', 'search_field', $_POST['search_field']);
		$formObj->formSubmit('Search');
		?>
	</div>        
	<div style="text-align:right;">
		<div id="resultCount"><strong><?php echo $rsObj->total_items;?></strong> matches found for your search</div>
		<div>
			<?php
            $rsObj->getPreviousNextMenu();
            ?>
            <br />
            <?php
            $rsObj->getNumberLinks();
            ?>
        </div>
	</div>
    <table>
        <tr>
            <td>Ref ID</td>
            <td>DOB</td>    
            <td>Gender</td>
            <td>View</td>
        </tr>            
       <?php  
    for($i=0;$i<count($data);$i++)
    {
        $client_data = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$data[$i]['candidate_id']."'","master");
        if($i%2) $class = 'searchResult1';
        else $class = 'searchResult2';
        ?>
        <tr class="<?php echo $class;?>">
            <td><?php echo $data[$i]['candidate_id'];?></td>
            <td><?php if($client_data[0]['dob']=='0000-00-00') echo 'Not Available'; else echo date('d-m-Y',strtotime($client_data[0]['dob']));?></td>
            <td><?php echo $client_data[0]['gender'];?></td>
            <td><a class="dialog_handler" style="cursor:pointer;" id="dialog_<?php echo md5($client_data[0]['client_id'].'jhcvyusgdf');?>">View CV</a></td>        
        </tr>
        <?php
    }    
    ?>
    </table>
    <div style="display:none;">
        <?php
        for($i=0;$i<count($data);$i++)
        {	
            ?>
            <div id="dialog_<?php echo md5($data[$i]['candidate_id'].'jhcvyusgdf');?>_window" class="dialog_window" title="CV Data"><?php include(COMMON_ROOT.'client/cv_profile.php');?></div>
            <?php
        }
        ?>
    </div>
</div>    