<?php
if(stristr(PHP_SAPI,'cli'))
{
	$cli=true;
}
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/ 
require_once('../includes/inc.start.php');
if($_SESSION['admin']['user']==''&&!$cli){
	require_once('templates/home/login_page.php');
	exit(0);
}
//print_r($_GET);
$adminObj = new Admin;
$adminlayoutObj = new AdminLayout;
//$adminObj->fnAdminLogin($_POST);
$current_page = mysql_real_escape_string($_GET['page']);
$module = mysql_real_escape_string($_GET['module']);
if($current_page == '') $current_page = 'index';
$layoutObj = new Layout;
$metaObj = new MetaData;
$homeObj = new home;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<title>Admin Panel</title>

<link rel="stylesheet" type="text/css" href="/css/admin_css.php" />

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jGrowl/jquery.jgrowl.css" />
<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="/admin/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/admin/js/functions.js"></script>
<script type="text/javascript" src="/admin/js/jscolor/jscolor.js"></script>
<link rel="stylesheet" type="text/css" href="/js/superfish-1.4.8/css/superfish_admin.css" media="screen">
<link rel="stylesheet" type="text/css" href="/js/superfish-1.4.8/css/superfish-vertical.css" media="screen">
<script type="text/javascript" src="/js/superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="/js/superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="/js/validate.js"></script>
<script type='text/javascript' src='/js/jGrowl/jquery.jgrowl_compressed.js'></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/jsTree/jquery.jstree.js"></script>  
<script type="text/javascript" src="/uploader/swfobject.js"></script>
<script type="text/javascript" src="/js/flash_player/jquery.flash.js"></script>


    
<script type="text/javascript">
// initialise plugins
    $(document).ready(function(){ 
        $("ul.sf-menu").superfish({ 
            pathClass:  'current' 
        }); 
		
		$("img.help_hover_me").hover(
		  function () {
			 $(this).next().fadeIn("fast");			
		  },
		  function () {
			 $(this).next().fadeOut("fast");
		  }
	   );
    }); 
</script>
<!--[if lte IE 7]>
<style>
#admin_content 
{
	padding-left:0px;
}
</style>
<![endif]-->
</head>
<body <?php if(isset($cli)){ echo 'style="background-color:#fff;"';}?>>  
	<div id="container">  
		<div id="wrapper"> 
		<?php if(!isset($cli)){?>
			<div id="admin_header">  
				<div style="text-align:right;"></div>
			</div>     
		<?php } ?>   
        <?php if(!isset($cli)){?>             		
            <div id="admin_content_bg"> 
        <?php } ?>    
                <?php if(!isset($cli)){?>        	
                <div id="admin_menu">
                    <ul class="sf-menu sf-vertical"> 
                        <?php
                        $conMenuObj = new controlledMenu;
                        $menu = $conMenuObj->createMenu();
                        echo $menu;
                        ?>
                    </ul>
                </div>
                <?php } ?>
                <div id="admin_content" <?php if(isset($cli)){ echo 'style="padding-left:0px;"'; }?>>
                    <?php 
                    if($current_page=="index"){
                        $homeObj->showAdminHome();
                    }
                    else{
                        $adminlayoutObj->showAdminContent($current_page, $module, $_REQUEST);
                    }
                    ?>     
                </div>
       		<?php if(!isset($cli)){?>
            </div>         
			<div id="clear">
			</div>
			<div id="admin_footer">
			</div>
    		<?php } ?>       
		</div>
		<div id="clear">
		</div>
	</div>
</body>
</html>