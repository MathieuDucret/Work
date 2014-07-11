
<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once('includes/inc.start.php');

if(isset($_GET['page'])) $page = $_GET['page']; else $page ='';
if(isset($_GET['module'])) $module = $_GET['module']; else $module = '';
$layoutObj = new Layout;
$metaObj = new MetaData;
$handlerObj = new Handler;
$langObj = new languageManagement;

$subdomain = $handlerObj->currentSubdomain($_SERVER['HTTP_HOST']); //Get current subdomain
$location = $handlerObj->cleanSubdomain($subdomain); //Get cleaned location of subdomain
$postcode = $handlerObj->getPostcode($location); //Get postcode
$current_page = $handlerObj->getCurrentpage($page); //Get current page
$current_module = $handlerObj->getCurrentmodule($module);
if($location=='' || $location=='Www')
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
<link href="/images/favicon.ico" type="image/ico" rel="shortcut icon">
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
<script type='text/javascript' src='/js/jqszoom_ev1.0.1/js/jqzoom.pack.1.0.1.js'></script>
<script type='text/javascript' src='/js/jGrowl/jquery.jgrowl.js'></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/s3slider.js"></script> 
<script type="text/javascript" src="/uploader/swfobject.js"></script>
<script type="text/javascript" src="/uploader/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="/js/flash_player/jquery.flash.js"></script>





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
<script type="text/javascript">

function slideSwitch() {

    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    // use this to pull the images in the order they appear in the markup

    var $next =  $active.next().length ? $active.next()

        : $('#slideshow IMG:first');

    // uncomment the 3 lines below to pull the images in random order

    

    // var $sibs  = $active.siblings();

    // var rndNum = Math.floor(Math.random() * $sibs.length );

    // var $next  = $( $sibs[ rndNum ] );

    $active.addClass('last-active');

    $next.css({opacity: 0.0})

        .addClass('active')

        .animate({opacity: 1.0}, 2000, function() {

            $active.removeClass('active last-active');

        });

}



$(function() {

    setInterval( "slideSwitch()", 7000 );

});

</script>
<style type="text/css">
#interMsgsW {
    margin: 0 auto;
    text-align: center;
    width: 100%;
    background-color: #3b85c1;
    position: relative;
    z-index: 1;
}
#interMsgsPar {
    width: 966px;
    height: 60px;
    padding: 0px 14px;
    margin: 0 auto;
    position: relative;
    background-color: #3b85c1;
}
.interMsg {
    text-align: left;
    width: 966px;
    height: 53px;
    position: absolute;
    top:7px;
    left:14px;
    background-color: #3b85c1;
}
#interMsgsW .closeMsg {
    float: right;
    cursor: pointer;
    padding: 3px 25px 0 0;
	position: relative;
}
#interMsgsW .closeMsgBtn {
	display: block;
	position: absolute;
	top: 0;
	right: 0;
	width: 17px;
	height: 17px;
	background-image: url('/images/cross.png');
	background-repeat: no-repeat;
}
.interMsg h4.fnt9 {
    margin-bottom: 0;
}
.fnt0 a, .fnt0 u
{
	color:#fff !important;
}
.fnt1 {
    font-size: 11px; 
    font-weight: normal;
    color: #333333;
    cursor: default;
}
.fnt1 a, a.fnt1 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt1 a:visited, a.fnt1:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt1 a:hover, a.fnt1:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt2 {
    font-size: 11px; 
    font-weight: normal;
    color: #ffffff;
    cursor: default;
}
.fnt2 a, a.fnt2 {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt2 a:visited, a.fnt2:visited {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt2 a:hover, a.fnt2:hover {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt3 {
    font-size: 11px; 
    font-weight: normal;
    color: #9574b3;
    cursor: default;
}
.fnt3 a , a.fnt3 {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt3 a:visited, a.fnt3:visited {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt3 a:hover, a.fnt3:hover {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt4 {
    font-size: 13px; 
    font-weight: normal;
    color: #333333;
    line-height: 17px;
    cursor: default;
}
.fnt4 a , a.fnt4 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt4 a:visited, a.fnt4:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt4 a:hover, a.fnt4:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt5 {
    font-size: 13px; 
    font-weight: bold;
    color: #333333;
    cursor: default;
    margin-bottom: 7px;
}
.fnt5 a , a.fnt5 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt5 a:visited, a.fnt5:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt5 a:hover, a.fnt5:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt6 {
    font-size: 13px; 
    font-weight: bold;
    color: #333333;
    cursor: default;
    margin-bottom: 14px;
}
.fnt6 a , a.fnt6 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt6 a:visited, a.fnt6:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt6 a:hover, a.fnt6:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt7 {
    font-size: 13px; 
    font-weight: bold;
    color: #ffffff;
    cursor: default;
}
.fnt7 a , a.fnt7 {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt7 a:visited, a.fnt7:visited {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt7 a:hover, a.fnt7:hover {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt8 {
    font-family: inherit; /* fix FF buttons */
    font-size: 13px; 
    font-weight: bold;
    color: #673695;
    text-transform: uppercase;
    cursor: pointer;
}
.fnt9 {
    font-size: 16px; 
    font-weight: bold;
    color: #333333;
    cursor: default;
    margin-bottom: 7px;
}
.fnt9 a , a.fnt9 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt9 a:visited, a.fnt9:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt9 a:hover, a.fnt9:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt10 {
    font-family: inherit; /* fix FF buttons */
    font-size: 16px; 
    font-weight: bold;
    color: #673695;
    text-transform: uppercase;
    cursor: pointer;
}
.fnt11 {
    font-size: 16px; 
    font-weight: normal;
    color: #333333;
    cursor: default;
}
.fnt11 a , a.fnt11 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt11 a:visited, a.fnt11:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt11 a:hover, a.fnt11:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt12 {
    font-size: 16px; 
    font-weight: bold;
    color: #ffffff;
    cursor: default;
}
.fnt12 a , a.fnt12 {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt12 a:visited, a.fnt12:visited {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
.fnt12 a:hover, a.fnt12:hover {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt13 {
    font-size: 13px; 
    font-weight: normal;
    color: #999;
    cursor: default;
}
.fnt13 a , a.fnt13 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt13 a:visited, a.fnt13:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt13 a:hover, a.fnt13:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt14 {
    font-size: 11px; 
    font-weight: normal;
    color: #0e774a;
    cursor: default;
}
.fnt14 a , a.fnt14 {
    color: #0e774a; 
    text-decoration: none;
    cursor: pointer;
}
.fnt14 a:visited, a.fnt14:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt14 a:hover, a.fnt14:hover {
    color: #0e774a; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt15 {
    font-size: 13px; 
    font-weight: normal;
    color: #ca0002;
    cursor: default;
}
.fnt16 {
    font-size: 13px; 
    font-weight: normal;
    color: #0e774a;
    cursor: default;
}
.fnt16 a , a.fnt16 {
    color: #0e774a; 
    text-decoration: none;
    cursor: pointer;
}
.fnt16 a:visited, a.fnt16:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt16 a:hover, a.fnt16:hover {
    color: #0e774a; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt17 {
    font-size: 16px; 
    font-weight: bold;
    color: #cccccc;
    cursor: default;
}
.fnt17 a , a.fnt17 {
    color: #0d51ab; 
    text-decoration: none;
    cursor: pointer;
}
.fnt17 a:visited, a.fnt17:visited {
    color: #ae7cdd; 
    text-decoration: none;
    cursor: pointer;
}
.fnt17 a:hover, a.fnt17:hover {
    color: #0d51ab; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt18 {
    font-size: 16px; 
    font-weight: bold;
    color: #ffffff;
    cursor: default;
}
.fnt18 a , a.fnt18 {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt18 a:visited, a.fnt18:visited {
    color: #ffffff; 
    text-decoration: underline;
    cursor: pointer;
}
.fnt18 a:hover, a.fnt18:hover {
    color: #ffffff; 
    text-decoration: none;
    cursor: pointer;
}
</style>
<script type="text/javascript">
	$(function(){
		var show = $.cookie('dontshow');
		if(show!='true')
		{//If this cookie hasnt been set show the top
			$('#interMsgsW').slideDown('slow');
		}
		
	});
	
	function dontshow()
	{
		$.cookie('dontshow','true');
		$('#interMsgsW').slideUp('slow');
	}
</script>
</head>
<body>
<div id="interMsgsW" style="display:none">
	<div id="interMsgsPar">
    	<div id="intMsgEmpl" class="interMsg" style="z-index:2;">
        	<div class="fnt1"><a class="closeMsg" href="javascript:void(0)" name="closeIMEmployer" onclick="return dontshow();">Click here to close<span class="counter"></span><span class="closeMsgBtn"></span></a>
            </div>
            <?php 
			$dbObj = new DataBase;
			$content_data = $dbObj->SelectQuery("SELECT * FROM tbl_pages WHERE module_name = 'templates' AND page_name = 'top_message'","master");
			
			echo $content_data[0]['page_content'];
			?>			
		</div>
	</div>
</div>            
<!--[if lte IE 6]>
          <div class="errmsg">We have detected that you are using an older, outdated version of Microsoft Internet Explorer.
          The Internet Concepts website is not certified to work correctly on this browser. For the best browsing experience we suggest you upgrade to
          a modern, standards-compliant web browser. Internet Concepts recommends <a href="http://www.mozilla.com/" target="_blank">Mozilla Firefox</a>.
          Continued use of this website with an outdated browser is at your own risk.</div>
<![endif]-->

<a id="top"></a>
<div id="container">

<!--[if lte IE 7]>
<div id="compat">
<![endif]-->
  <div id="wrapper">
  
      <div id="header">
      <div id="logo_home"><a href="/index">&nbsp;</a></div>
      <div style="width: 300px; float: right;">
      	<div id="header_applynow"><a href="/candidates/register">&nbsp;</a></div>
        <div style="clear:both;"></div>
      	<div id="date_time" style="float:none;margin-top:5px;margin-right:0px; text-align: right;"><?php echo date('l d F Y');?></div>
      </div>
      <div style="clear:both;"></div>
        <?php $layoutObj->showHeader(); ?>
      </div>
      <?php 
	  $left_content = $layoutObj->SelectQuery("SELECT * FROM tbl_pages WHERE module_name='templates' AND page_name='left_content'","master");
	  $right_content = $layoutObj->SelectQuery("SELECT * FROM tbl_pages WHERE module_name='templates' AND page_name='right_content'","master");
	 
    require_once('templates/links_horizontal.php');    
	
    ?>
    
    <div style="clear:both; height: 10px;"></div>
	<div id="footer">
        <?php $layoutObj->showFooter(); ?>
      
     </div>
      
</div>
  <!--[if lte IE 7]>
</div>
<![endif]-->
</div>
	<div id="credit">
    	<div style="float: right;">
    		<div id="ic"><a href="http://www.internet-concepts.co.uk" target="_blank">Designed and developed by Internet Concepts<br /> </a><a href="http://www.graphicdesignice.co.uk" target="_blank">Powered by ICE</a></div>
        	<div id="ic_logo"><a href="http://www.internet-concepts.co.uk" target="_blank">&nbsp;</a></div>
        </div>
    </div>
    <div id="clear"></div>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25495016-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
<?php 
require_once(COMMON_ROOT.'includes/inc.cleanup.php');
?>