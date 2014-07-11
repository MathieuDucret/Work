<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
	<div id="banner">
    <div id="slideshow">
        	<img style="margin:0;" src="/images/rotate/1.jpg" alt="" class="active" />
    		<img style="margin:0;" src="/images/rotate/2.jpg" alt="" />
    		<img style="margin:0;" src="/images/rotate/3.jpg" alt="" />
    		<img style="margin:0;" src="/images/rotate/4.jpg" alt="" />
    		<img style="margin:0;" src="/images/rotate/5.jpg" alt="" />
    	</div>
    </div>
      <div id="menu">
        <?php $layoutObj->showLinks('links',$current_page,$current_module,'horizontal'); ?>
      </div>
      <div id="content">
      <?php
		if(isset($_SESSION['admin'])&&isset($_POST['page_content']))
		{
			$admin = '1';
		}
		else 
		{
			$admin = '';
		}
		echo $left_content[0]['page_content'];
		$layoutObj->showContent($current_page,$current_module,$location,$postcode, $admin);
		echo $right_content[0]['page_content'];
		?>
        <div style="clear:both;"></div>
      </div>