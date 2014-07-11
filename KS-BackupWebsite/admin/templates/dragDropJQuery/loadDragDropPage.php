<!doctype html>
<html lang="en">
<head>
	<title>jQuery UI Sortable - Connect lists with Tabs</title>

	<style type="text/css">
	<?php 
	echo "#sortable_0 li,";
		for ($i=0; $i<count($groupList); $i++)
		{
			if ($i==count($groupList))
			{
				echo "#sortable_".$groupList[$i]['id']. " li";
			}
			else
			{
				echo "#sortable_".$groupList[$i]['id']." li".",";
			}
		}
		
		 ?> { margin: 5px 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 180px; }
	</style>
	<script type="text/javascript">

	
	
	
	
	$(function() {
	//watch changes to the following list of items
		$("<?php 
		echo "#sortable_0 ,";
		for ($i=0; $i<count($groupList); $i++)
		{
			if ($i==count($groupList)-1)
			{
				echo "#sortable_".$groupList[$i]['id'];
			}
			else
			{
				echo "#sortable_".$groupList[$i]['id'].",";
			}
		}
		
		 ?>").sortable().disableSelection();

		var $tabs = $("#tabs").tabs();
	
		var $tab_items = $("ul:first li",$tabs).droppable({
			accept: ".connectedSortable li",
			hoverClass: "ui-state-hover",
			drop: function(ev, ui) {
				var $item = $(this);
				var $list = $($item.find('a').attr('href')).find('.connectedSortable');	
				
				ui.draggable.hide('slow', function() {
					$tabs.tabs('select', $tab_items.index($item));
					$(this).appendTo($list).show('slow');
					console.log(this);
				var currentId = $(this).attr('id'); 
				var groupId = $($list).attr('id');	 
					
					console.log(groupId);
					console.log(currentId);
					var dataString = 'groupid='+groupId+'&userid='+currentId;
				
					//post the data for insert
					$.ajax({						
   						type: "POST",
						url: "/ajax/insert.php",						
						data: dataString,
					    success: function(){
   						}
 					});
				});
			}
		});
	});
	</script>
</head>
<body>
<div class="demo">
<div id="tabs">
	<ul>
    <?php $var1 =  "Group LIST COUNT = ".count($groupList); 
	$debugCodeObj = new debugMyCode();
	$debugCodeObj->debugCode($var1);
	?>
    
    <li><a href="#tabs-<?php //echo count($groupList);?>">Un-assigned</a></li>
    <?php for ($i=0; $i<count($groupList); $i++){ ?>
		<li><a href="#tabs-<?php echo $i;?>"><?php echo $groupList[$i]['group_name']; ?></a></li>
	<?php } ?>
        </ul>
        
            
    
     <div id="tabs-<?php echo count($groupList); ?>" style="width:200px; ">

            <ul id="sortable_0" class="connectedSortable ui-helper-reset">
     <?php for ($m=0; $m<count($unassignedAdminList); $m++){ ?>
     	<li class="ui-state-default" id="user_<?php echo $unassignedAdminList[$m]['id']; ?>"><?php echo $unassignedAdminList[$m]['username']; ?></li>
	 <?php }?>
							</ul>
		</div>
        
        
        <?php for ($k=0; $k<count($groupList); $k++){ 
		$currentAdmin = $this->SelectQuery("SELECT id, username from tbl_admins where admingroup='".$groupList[$k]['id']."'", "master");?>
        <div id="tabs-<?php echo $k;?>" style="width:200px; ">
			<ul id="sortable_<?php echo $groupList[$k]['id'];?>" class="connectedSortable ui-helper-reset">
			   	<?php for ($j=0; $j<count($currentAdmin); $j++)
				{							
				?>           
    	        		<li class="ui-state-default" id ="user_<?php echo $currentAdmin[$j]['id']; ?>"><?php echo $currentAdmin[$j]['username'];?></li>
				<?php 	
				} 
				?>
			</ul>
		</div>
   <?php } ?>
	
	</div>
</div>
</body>
</html>
