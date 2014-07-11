<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once('../../includes/inc.start.php');
if(!isset($_SESSION['admin'])){
	require_once('../templates/home/login_page.php');
	exit(0);
}
if(isset($_GET['page'])) $page = $_GET['page']; else $page ='';
if(isset($_GET['module'])) $module = $_GET['module']; else $module = '';
$layoutObj = new Layout;
$metaObj = new MetaData;
$handlerObj = new Handler;
$langObj = new languageManagement;
$accessObj = new accessibility;
$accessObj->setFontSize($_POST['font_size']);
$subdomain = $handlerObj->currentSubdomain($_SERVER['HTTP_HOST']); //Get current subdomain
$location = $handlerObj->cleanSubdomain($subdomain); //Get cleaned location of subdomain
$postcode = $handlerObj->getPostcode($location); //Get postcode
$current_page = $handlerObj->getCurrentpage($page); //Get current page
$current_module = $handlerObj->getCurrentmodule($module);
if($location=='' || $location=='Www' || $location=='Internet-concepts')
{
	$location = '';
	$postcode = '';
}
if($layoutObj->getSetting('subdomains')==1) // If subdomains enabled, location and postcode are taken from GET vars
{
	$metaObj->location = $location;
	$metaObj->postcode = $postcode;
}
$current_page = mysql_real_escape_string($current_page);
$current_module = mysql_real_escape_string($current_module);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<meta name="keywords" content="<?php $metaObj->getKeywords($current_page,$current_module,$_GET);?>" />
<meta name="description" content="<?php $metaObj->getDescription($current_page,$current_module,$_GET);?>" />
<title><?php $metaObj->getTitle($current_page,$current_module,$_GET);?></title>
<link rel="stylesheet" type="text/css" href="/css/css.php" />
<link rel="stylesheet" type="text/css" href="/css/client.css" />

<?php /*<link rel="stylesheet" type="text/css" href="/js/calendar.css" />*/ // This is for the calendar?>
<script type="text/javascript" src="/js/functions.js"></script>
<script type="text/javascript" src="/js/contact.js"></script>
<?php /*<script type="text/javascript" src="/js/calendar.js"></script>*/ // This is for the calendar?>
<link rel="stylesheet" type="text/css" href="/js/superfish-1.4.8/css/superfish.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/js/superfish-1.4.8/css/superfish-navbar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/js/jqzoom_ev1.0.1/css/jqzoom.css" />
<link rel="stylesheet" type="text/css" href="/js/adgallery/jquery.ad-gallery.css" />
<link rel="stylesheet" href="/js/jqueryui-1.8.4/themes/css/custom-theme/jquery-ui-1.8.4.custom.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="/js/jGrowl/jquery.jgrowl.css" />
<link rel="stylesheet" type="text/css" href="/css/estateagent_style.css" />

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
<script type='text/javascript' src='/js/jqueryui-1.8.4/js/jquery-ui-1.8.4.custom.min.js'></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery.columnhover.js"></script>
<script type="text/javascript" src="/js/superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="/js/superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="/js/validate.js"></script>
<script type="text/javascript" src="/js/easySlider1.5.js"></script>
<script type="text/javascript" src="/js/adgallery/jquery.ad-gallery.js"></script>
<script type='text/javascript' src='/js/jqzoom_ev1.0.1/js/jquery.jqzoom1.0.1.js'></script>
<script type='text/javascript' src='/js/jqzoom_ev1.0.1/js/jqzoom.pack.1.0.1.js'></script>
<script type='text/javascript' src='/js/jGrowl/jquery.jgrowl.js'></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/galleria/galleria.js"></script>
<script type="text/javascript" src="/js/galleria/themes/classic/galleria.classic.js"></script>





<!--[if lte IE 6]>
<script type="text/javascript" src="/js/supersleight-min.js"></script>
<![endif]-->
<script type="text/javascript">
// initialise plugins
    $(document).ready(function(){ 
        $("ul.sf-menu").superfish({ 
            pathClass:  'current' 
        }); 
    }); 
</script>
</head>
<body>
<a id="top"></a>
<div id="container">
<!--[if lte IE 7]>
<div id="compat">
<![endif]-->
  <div id="wrapper">
      <div id="header">
      	<?php 		
		$langObj->showLanguages();
		$accessObj->showSizes();
		?>
        <?php $layoutObj->showHeader(); ?>
      </div>
<?php 
if($layoutObj->getSetting('link_alignment') == 'vertical')
{
	require_once(COMMON_ROOT.'templates/links_vertical.php');
}
elseif($layoutObj->getSetting('link_alignment') == 'horizontal')
{
	require_once(COMMON_ROOT.'templates/links_horizontal.php');
}
else
{
	require_once(COMMON_ROOT.'templates/links_both.php');
}
?>
<div id="footer">
        <?php $layoutObj->showFooter(); ?>
        <!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=internetconcepts"><img style="padding-bottom: 10px;" src="http://www.internet-concepts.co.uk/images/share.png" width="125" height="20" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=internetconcepts"></script>
<!-- AddThis Button END -->
      </div>
  </div>
  <!--[if lte IE 7]>
</div>
<![endif]-->
</div>
</body>
</html>
<?php 
/*$logObj = new logging;
$logObj->updateViews($_GET['page'],$_GET['id']); */
require_once(COMMON_ROOT.'includes/inc.cleanup.php');
?>