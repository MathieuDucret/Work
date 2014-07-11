<?php
$this->display_mode='extended';

if($_SESSION['client']['clientgroupid']=='1')
{
	$data = $this->SelectQuery("SELECT page_content FROM tbl_pages WHERE page_name='company_index' AND module_name = 'default' AND language_id='".$current_language."'","master");
	$content = $data[0]['page_content'];
}
elseif($_SESSION['client']['clientgroupid']=='3')
{
	$data = $this->SelectQuery("SELECT page_content FROM tbl_pages WHERE page_name='candidate_index' AND module_name = 'default' AND language_id='".$current_language."'","master");	
	$content = $data[0]['page_content'];
}
echo $content;


	?>
<script type="text/javascript" src="/js/jquery.roundabout.js"></script>
<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
<style>
   .roundabout-holder { padding: 0; height: 80px; list-style: none; width:568px; }
   .roundabout-moveable-item {
      height: 70px;
      /*width: 104px;*/
      cursor: pointer;
   }
   .roundabout-in-focus { cursor: auto; }
</style> 
<script>
	// <[CDATA[
			$(document).ready(function() {
				var interval;
				if($('ul#image_list').length>0)
				{
					$('ul#image_list')
						.roundabout({easing: 'easeInOutExpo', minOpacity:'0'})
						.hover(
							function() {
								// oh no, it's the cops!
								clearInterval(interval);
							},
							function() {
								// false alarm: PARTY!
								interval = startAutoPlay();
							}
						);				
					// let's get this party started
					interval = startAutoPlay();
				}
			});
			
			function startAutoPlay() {
				return setInterval(function() {
					$('ul#image_list').roundabout_animateToNextChild();
				}, 3000);
			}
	// ]]>
</script> 