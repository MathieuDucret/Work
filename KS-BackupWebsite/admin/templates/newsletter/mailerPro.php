<script type="text/javascript">
// initialise plugins
function updateQueue(passedObject)
{
	if($('#userListQueue').is(":visible"))
	{
		$.ajax({
			url: '/admin/ajax/newsletter/mailQueue.ajax.php',
			type: 'POST',
			data: 'test=test',
			success: function(data) {
				$(passedObject).empty();
				$(passedObject).append(data);
				$(passedObject).show();;	
			}
		});
	}
}
    $(document).ready(function(){ 	
							   
		$('#mailQueue').dialog({
				modal:true,							 
				autoOpen: false,
				show: 'slide',
				hide: 'slide',
				width: 500,
				minWidth: 450
		});
		
        function recepientCount(type)
		{ //Shows number of recipients to receive the current bulkmail
			$('#resultCount').hide('slow');
			$('#resultCount').empty();
			$.ajax({
				url: '/admin/ajax/newsletter/mailCount.ajax.php',
				type: 'POST',
				data: 'type='+type,
				success: function(data) {		
					returnCount = data;
					$('#resultCount').append(returnCount);
					$('#resultCount').show('slow');
					$('#showUsers').click(function(){									   
						$('#userList').toggle('slow');
				   });
				}
			});
		}			
		
		
		function viewQueue()
		{			
			$.ajax({
				url: '/admin/ajax/newsletter/mailQueue.ajax.php',
				type: 'POST',
				data: 'test=test',
				success: function(data) {
					$('#outputQueue').empty();
					$('#outputQueue').append(data);					
					$('#outputQueue').toggle('slow');
					$('#userListQueue').hide();
					$('#showListQueue').click(function(){						
						$('#userListQueue').toggle('slow');
						if($('#userListQueue').is(":visible"))
						{
							setInterval( "updateQueue($('#outputQueue'))", 5000 );
						}
					});					
				}
			});
		}
		
		
		
		$('#recepient_list').change(function(){
			recepientCount($(this).val());
		});
		
		$('#viewQueue').click(function(){
			viewQueue();	
		});
   	}); 
</script>
<style type="text/css">
	#resultCount{
		border:1px solid #ccc;
		text-align:center;
		display:none;
		height:100%;
	}
	.clickMe{
		margin-top:5px;
		margin-bottom:5px;
		font-weight:bold;
		cursor:pointer;
	}
</style>	
<h1>Send Mail</h1>
<?php
if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }
$formObj = new formCreator;
$formObj->formNew('bulkmailQueue','');
$formObj->formSelectRow('Mail Template','mail_template',$formObj->SelectQuery("SELECT id, subject FROM tbl_module_newsletter_templates","master"),'subject','id',$_POST['mail_template']);
$formObj->formSelectRow('Recepient List','recepient_list',array(array('display'=>'Newsletter Users','value'=>'newsletter'),array('display'=>'Client Users','value'=>'client'),array('display'=>'Both','value'=>'both')),'display','value',$_POST['recepient_list']);
$formObj->formSubmit();
?>
<div id="viewQueue" class="clickMe">Click to toggle mail queue</div>
<div id="outputQueue" style="display:none;"></div>
<div id="resultCount"></div>
