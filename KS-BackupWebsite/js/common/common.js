$.fx.speeds._default = 1000;

var open_dialog = '';

//Onload handlers
$(function() {
	var dialog_width = 500;
	var dialog_minwidth = 450;

	if($('.dialog_window')[0]){								  
		//Attach to all divs with dialog_window class		   
		$('.dialog_window').dialog({
			draggable:false,
			resizable:false,
			modal:true,							 
			autoOpen: false,
			show: 'slide',
			hide: 'slide',
			width: 711,
			height: 429,
			minWidth: 450
		});	
		
		$('.dialog_handler').click(function(){												
			var id = $(this).attr('id');
			open_dialog = $('#'+id+'_window');
			$('#'+id+'_window').dialog('open');			  	
		});
	}
});