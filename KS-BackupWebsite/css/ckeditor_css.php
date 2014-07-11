<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once('../includes/inc.start.php');
$cssObj = new Css;
$layoutObj = new Layout;
header('Content-type: text/css'); 
$alignment = $layoutObj->getSetting('link_alignment');
?>
#admin_content{
	width:73%;
    padding-left:0px;
	padding-right:0px;
	text-align:justify;
    overflow:visible;
    background-repeat:no-repeat;
    float:right;
    min-height:800px;
}
#admin_menu{
	float:left;
	width:25%;
}


body{
	margin:0px;
	background-color:<?php echo $cssObj->getCSS('body_background_color');?>;
	font-family:<?php echo $cssObj->getCSS('font_family');?>;
    background-image:url(<?php echo $cssObj->getCSS('body_background_image');?>);
    font-size:<?php echo $cssObj->getCSS('body_font_size');?>;
<?php if($cssObj->getCSS('body_background_image')!='') {?>    
    background-repeat:<?php echo $cssObj->getCSS('body_background_repeat');?>;
<?php } ?>
}
h1{
	font-size:<?php echo $cssObj->getCSS('h1_size');?>;
    font-family:<?php echo $cssObj->getCSS('h1_font');?>;
    color:<?php echo $cssObj->getCSS('h1_color');?>;
    padding-top:0px;
    margin-top:0px;
}
h2{
	color:<?php echo $cssObj->getCSS('h2_color');?>;
    font-size:<?php echo $cssObj->getCSS('h2_size');?>;
    font-family:<?php echo $cssObj->getCSS('h2_font');?>;
}
h3{
	color:<?php echo $cssObj->getCSS('h3_color');?>;
    font-size:<?php echo $cssObj->getCSS('h3_size');?>;
    font-family:<?php echo $cssObj->getCSS('h3_font');?>;
    }
h4{
	font-size:<?php echo $cssObj->getCSS('h4_size');?>;
    font-weight:normal;
    font-family:<?php echo $cssObj->getCSS('h4_font');?>;
    color:<?php echo $cssObj->getCSS('h4_color');?>;
    padding-top:10px;
    margin-bottom:5px;
}
h5{
	color:<?php echo $cssObj->getCSS('h5_color');?>;
    font-size:<?php echo $cssObj->getCSS('h5_size');?>;
    font-family:<?php echo $cssObj->getCSS('h5_font');?>;
}
p{
	font-size:<?php echo $cssObj->getCSS('p_size');?>;
}
li{
	font-size:<?php echo $cssObj->getCSS('p_size');?>;
}
#label {
	color:<?php echo $cssObj->getCSS('label_color');?>;
    }
<?php if($cssObj->getCSS('curved_corners')=='Yes') {?>
#compat #wrapper{
	behavior:url(/css/border-radius.htc);
}<? } ?>
img{ 
margin-left: <?php echo $cssObj->getCSS('image_margin_left');?>;
margin-right: <?php echo $cssObj->getCSS('image_margin_right');?>;
border:0;
}
#header{
	height: 70px;
    background-image: url(/images/header.png);
	background-color:<?php echo $cssObj->getCSS('header_background_color');?>;
<?php if($cssObj->getCSS('curved_corners')=='Yes') {?>    
    -moz-border-radius:10px;
	-webkit-border-radius:10px;
<?php } ?>
}
#wrapper{
	border-left: 1px solid #f4f4f4;
    border-right: 1px solid #f4f4f4;
    border: 1px solid #f4f4f4;
    padding: 0px 10px 10px 10px;
	background-color:<?php echo $cssObj->getCSS('wrapper_background_color');?>;
	width:<?php echo $cssObj->getCSS('width');?>;
	margin-left:<?php echo $cssObj->getCSS('page_alignment');?>;
	margin-right:<?php echo $cssObj->getCSS('page_alignment');?>;
	text-align:center;
<?php if($cssObj->getCSS('curved_corners')=='Yes') {?>    
    -moz-border-radius:10px;
	-webkit-border-radius:10px;
<?php } ?>
}
table{
	width:100%;
    text-align:left;
}
#content{
	margin-left:<?php echo $cssObj->getCSS('margin_left');?>;
	margin-right:<?php echo $cssObj->getCSS('margin_right');?>;
	text-align:<?php echo $cssObj->getCSS('font_alignment');?>;
    margin-top:10px;
    overflow:visible;
    min-height:200px;
    padding: 0px 0px 10px 0px;
}
#contentright{
    margin-left:<?php echo $cssObj->getCSS('margin_left');?>;
	margin-right:<?php echo $cssObj->getCSS('margin_right');?>;
	text-align:<?php echo $cssObj->getCSS('font_alignment');?>;
    overflow:visible;
}
#menu{
	text-align:center;
    border-top: 5px solid #FFF;
    background-color: #27374C;
    background-image: url(/images/menu_bg.png);
    height:40px;
    
}
#menu_vertical{
float:left;
}
#menuleft{
    text-align:center;
}
#footer{
	text-align:left;
    background-color:<?php echo $cssObj->getCSS('body_background_color');?>;
    padding: 10px 0px 0px 0px;
    border-top: 1px dotted #CCCCCC;
    background-image: url(/images/footer_bg.png);
    }
#ic a{
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	text-decoration:none;
	font-size:8pt;
	font-weight:bold;
	color:#906;
}
<?php // We have changed most items to use the errmsg class, but the id has been kept just in case?>
#errmsg{
	font-size:10pt;
	background-color:#FC9; 
	border:solid 1px #900;
    padding:5px;
}
.errmsg{
	font-size:10pt;
	background-color:#FC9; 
	border:solid 1px #900;
    padding:5px;
}
a{
	color: <?php echo $cssObj->getCSS('hyperlink_color');?>;
    font-weight: <?php echo $cssObj->getCSS('hyperlink_weight');?>;
   	text-decoration: <?php echo $cssObj->getCSS('hyperlink_decoration');?>;
}
a:hover {
	color: <?php echo $cssObj->getCSS('hyperlink_hover_color');?>;
    font-weight: <?php echo $cssObj->getCSS('hyperlink_hover_weight');?>;
   	text-decoration: <?php echo $cssObj->getCSS('hyperlink_hover_decoration');?>;
}

.searchtitle        {
    background: <?php echo $cssObj->getCSS('table_title_bg_color');?>;
    color:      <?php echo $cssObj->getCSS('table_title_font_color');?>;
    font-size:  <?php echo $cssObj->getCSS('table_title_font_size');?>;
    padding:    2px;
}
.searchResult1 {
    background: <?php echo $cssObj->getCSS('table_result_bg_color1');?>;
    color: <?php echo $cssObj->getCSS('table_result_font_color1');?>;
    font-size: <?php echo $cssObj->getCSS('table_result_font_size');?>;
    }
.searchResult2 {
    background: <?php echo $cssObj->getCSS('table_result_bg_color2');?>;
    color: <?php echo $cssObj->getCSS('table_result_font_color2');?>;
    font-size: <?php echo $cssObj->getCSS('table_result_font_size');?>;
    }
.subsearchtitle        {
    background: <?php echo $cssObj->getCSS('table_subtitle_bg_color');?>;
    color:      <?php echo $cssObj->getCSS('table_subtitle_font_color');?>;
    font-size:  <?php echo $cssObj->getCSS('table_subtitle_font_size');?>;
    padding:    2px;
}
.subsearchResult1 {
    background: <?php echo $cssObj->getCSS('table_subresult_bg_color1');?>;
    color: <?php echo $cssObj->getCSS('table_subresult_font_color1');?>;
    font-size: <?php echo $cssObj->getCSS('table_subresult_font_size');?>;
    }
.subsearchResult2 {
    background: <?php echo $cssObj->getCSS('table_subresult_bg_color2');?>;
    color: <?php echo $cssObj->getCSS('table_subresult_font_color2');?>;
    font-size: <?php echo $cssObj->getCSS('table_subresult_font_size');?>;
    }

/* 
  -- Even more rounded corners with CSS: Base stylesheet --
*/

.dialog {
 position:relative;
 margin:0px auto;
 min-width:8em;
 max-width:540px; /* based on image dimensions - not quite consistent with drip styles yet */
 color:#fff;
 z-index:1;
 margin-left:12px; /* default, width of left corner */
 margin-bottom:0.5em; /* spacing under dialog */
}

.dialog .content,
.dialog .t,
.dialog .b,
.dialog .b div {
 background:transparent url(/links/dialog-purple-800x1600.png) no-repeat top right;
 _background-image:url(/links/dialog2-blue.gif);
}

.dialog .content {
 position:relative;
 zoom:1;
 _overflow-y:hidden;
 padding:0px 15px 0px 0px;
}

.dialog .t {
 /* top+left vertical slice */
 position:absolute;
 left:0px;
 top:0px;
 width:12px; /* top slice width */
 margin-left:-12px;
 height:100%;
 _height:1600px; /* arbitrary long height, IE 6 */
 background-position:top left;
}

.dialog .b {
 /* bottom */
 position:relative;
 width:100%;
}

.dialog .b,
.dialog .b div {
 height:30px; /* height of bottom cap/shade */
 font-size:1px;
}

.dialog .b {
 background-position:bottom right;
}

.dialog .b div {
 position:relative;
 width:12px; /* bottom corner width */
 margin-left:-12px;
 background-position:bottom left;
}

.dialog .hd,
.dialog .bd,
.dialog .ft {
 position:relative;
}

.dialog .wrapper {
 /* extra content protector - preventing vertical overflow (past background) */
 position:static;
 max-height:1000px;
 overflow:auto; /* note that overflow:auto causes a rather annoying redraw "lag" in Firefox 2, and may degrade performance. Might be worth trying without if you aren't worried about height/overflow issues. */
}

.dialog h1,
.dialog p {
 margin:0px; /* margins will blow out backgrounds, leaving whitespace. */
 padding:0.5em 0px 0.5em 0px;
}

.dialog h1 {
 padding-bottom:0px;
}

#booth{
	margin-bottom:10px;
    margin-top:10px;
    background-color:#fff;
    }
#text {
	font-size: 9pt;
    margin-left:10px;
    margin-right:10px;
}
#rightimage {
	 position:absolute;
 	top:0;
 	right:0;
 	width:200px;
    }
#leftimage {
	float:left;
    }
.content a {
color:#fff;

font-weight:bold;
}

	div.expandable_note_box {
		width: 507px;
		min-height: 100px;
		background-image: url("/images/bg_top.jpg");
		background-position: top left;
		padding-top:10px;
        background-repeat: no-repeat;		
		font-size: 80%;
	}
	
	div.expandable_note_box div.middle {
		width: 507px;
		background-image: url("/images/bg_middle.jpg");
		background-position: center;
		background-repeat: repeat-y;
	}
	
	div.expandable_note_box div.inside {
		padding-left: 20px;
		width: 450px;
	}
    
    div.expandable_note_box img {
    	margin-left:0px;
        margin-right:0px;
        }
        
#clear{
	clear:both;
    height:0px;
}

div.expandable_note_box_small {
		width: 259px;
		min-height: 100px;
		background-image: url("/images/bg_small_top.jpg");
		background-position: top left;
		padding-top:10px;
        background-repeat: no-repeat;		
		font-size: 80%;
	}
	
	div.expandable_note_box_small div.middle_small {
		width: 259px;
		background-image: url("/images/middle_securityi_bg.png");
		background-position: center;
		background-repeat: repeat-y;
	}
	
	div.expandable_note_box_small div.inside_small {
		padding-left: 20px;
		width: 220px;
	}
    
    div.expandable_note_box_small img {
    	margin-left:0px;
        margin-right:0px;
        }
        
        
        div.expandable_note_box_large {
		width: 880px;
		min-height: 100px;
		background-image: url("/images/top_securityi_bg.png");
		background-position: top left;
		padding-top:10px;
        padding-right:30px;
        background-repeat: no-repeat;		
		font-size: 80%;
	}
	
	div.expandable_note_box_large div.middle_large {
		width: 880px;
		background-image: url("/images/middle_securityi_bg.png");
		background-position: center;
		background-repeat: repeat-y;
	}
	
	div.expandable_note_box_large div.inside_large {
		padding-left: 20px;
		width: 820px;
	}
    
    div.expandable_note_box_large img {
    	margin-left:0px;
        margin-right:0px;
        }
        
       div.expandable_note_box_large img{ 
margin-left: <?php echo $cssObj->getCSS('image_margin_left');?>;
margin-right: <?php echo $cssObj->getCSS('image_margin_right');?>;
border:0;
}
#feedback_container {
    padding-top:30px;
    }
#feedback_item {
	overflow:auto;
    }  

#feedback_date {
	font-size:10pt;
    font-style:italic;
    padding-top:10px;
    padding-bottom:10px;
    }
#feedback_comments {
padding-top:10px;
}

#nomargin {
margin-left:0px;
margin-right:0px;
}

#clear {
clear:both;
}
.parent_category{
font-size:18px;
}
.sub_category{
font-size:16px;
}
#category_title{
font-size:18px;
}
#category_description{
}
#category_page{
}

.searched_term
{
	font-weight:bold;
}
#clear {
	clear: both;
	height: 0px;
}
.clear {
	clear: both;
	height: 0px;
}
#date_time {
	color: #666;
}
#logo_home {
	width: 440px;
	height: 70px;
	float: left;
}
#logo_home a {
	display: block;
	height: 100%;
}
#logo_home:hover { 
	cursor: pointer;
}
#header_applynow {
	float: right;
	width: 150px;
	height: 30px;
	background-image: url(/images/header-applynow.png);
	margin-top: 5px;
}
#header_applynow a {
	display: block;
	height: 100%;
}
#header_applynow:hover {
	background-position: 0px -30px;
}
#container {
	padding: 10px 0px 10px 0px;
}
#banner {
	height: 270px;
	background-image: url(/images/banner.jpg);
	position: relative;
}
#left_content {
	min-height: 300px;
	width: 190px;
	float: left;
	padding: 0px 10px 0px 0px;
}
#center_content {
	width: 580px;
	float: left;
	padding: 0px 10px 0px 10px;
}
#center_content p a {
	color: #27374C;
	font-weight: bold;
}
#center_content p a:hover {
	color: #666;
}
#right_content {
	min-height: 300px;
	width: 190px;
	float: left;
	padding: 0px 0px 0px 10px;
}
#right_content h1 {
	font-weight: bold;
	font-size: 16px;
	color: #666;
}
#login_buttons {
	padding: 0px 0px 15px 0px;
	margin: 0px 0px 15px 0px;
	border-bottom: 1px dotted #CCC;
}
.login {
	width: 190px;
	height: 45px;
	background-image: url(/images/login_button.png);
}
.login a {
	display: block;
	height: 100%;
}
#company_login {
	background-position: 0px 0px;
	margin: 0px 0px 10px 0px;
}
#candidate_login {
	background-position: 0px -90px;
}
#company_login:hover {
	background-position: 0px -45px;
}
#candidate_login:hover {
	background-position: 0px -135px;
}
#social {
	width: 190px;
	height: 45px;
	padding: 0px 0px 15px 0px;
	margin: 0px 0px 15px 0px;
	border-bottom: 1px dotted #CCC;
}
#social .social_link {
	float: left;
	margin-right: 3px;
	width: 45px;
	height: 45px;
}
#social .social_link a {
	display: block;
	height: 100%;
}
#social .social_link:hover {
	background-position: 0px -45px;
}
#facebook {
	background-image: url(/images/facebook.png);
}
#twitter {
	background-image: url(/images/twitter.png);
}
#linkedin {
	background-image: url(/images/linkedin.png);
}
#email.social_link { 
	background-image: url(/images/email.png);
	margin-right: 0px;
}
#video {
	width: 188px;
	height: 130px;
	border: 1px solid #CCC;
	margin: 0px 0px 20px 0px;
	background-image: url(/images/video_soon.jpg);
}
#facebook_badges {
	width: 188px;
	height: auto;
	/*border: 1px solid #CCC;*/
	background-image: none;
}
#offers_soon {
	width: 188px;
	height: 130px;
	border: 1px solid #CCC;
	background-image: url(/images/offers_soon.jpg);
}
#left_figures {
	width: 178px;
	padding: 5px;
	background-color: #F4F4F4;
	border: 1px solid #CCC;
	margin: 0px 0px 10px 0px;
}
.figures {
	font-size: 11px;
	margin: 0px 0px 5px 0px;
}
.figures_detail {
	line-height: 18px;
	float: left;
	margin-right: 5px;
}
#figures_icon {
	width: 18px;
	height: 18px;
}
#figures_name {
	width: 110px;
}
#figures_total {
	width: 40px;
	margin-right: 0px;
	text-align: right;
}
#ic {
	text-align: right;
	padding: 0px 5px 0px 0px;
	float: left;
}
#ic a {
	color: #575757;
	font-size: 10px;
	font-weight: normal;
	outline: none;
	line-height: 17px;
}
#ic_logo {
	float: left;
	width: 35px;
	height: 35px;
	background-image: url(/images/ic.png);
	margin: 0px 0px 0px 0px;
}
#ic_logo:hover {
	cursor: pointer;
	background-position: 0px -35px;
}
#ic_logo a {
	display: block;
	height: 100%;
}
#credit {
	width: 1000px;
	height: 50px;
	margin: 0px auto 0px auto;
	
}
#footer_links {
	test-align: left;
	line-height: 12px;
}
#footer_links a {
	color: #999;
	line-height: 12px;
	padding: 0px 15px 0px 0px;
	margin: 0px 20px 0px 0px;
	background-image: url(/images/footer_arrow.png);
	background-repeat: no-repeat;
	background-position: top right;
}
#footer_links a:hover {
	color: #27374C;
	background-position: right -14px;
}
#footer_address p {
	padding: 10px 0px 0px 0px;
	margin: 0px;
	color: #999;
}
#footer_address p a {
	color: #999;
}
#footer_address p a:hover {
	color: #27374C;
}
.index_booth {
	float: left;
	width: 180px;
}
.booth_head {
	height: 30px;
	margin: 0px 0px 5px 0px;
}
.booth_head h3 {
	font-size: 14px;
	font-weight: normal;
	margin: 0px;
	line-height: 30px;
	padding: 0px 0px 0px 10px;
	color: #FFF;
}
.booth_head h3 a {
	color: #FFF;
}
.booth_head h3 a:hover {
	color: #F1F1F1;
}
.booth_image {
	margin: 0px 0px 5px 0px;
}
.booth_content {
	min-height: 140px;
	padding: 5px 5px 5px 5px;
	border: 1px solid #CCC;
}
.booth_content a {
	color: #27374C;
	line-height: 20px;
	font-weight: bold;
	font-size: 11px;
}
.booth_content a:hover {
	color: #27374C;
	text-decoration: underline;
}
.booth_content p {
	font-size: 10px;
	border-top: 1px dotted #CCC;
	margin: 5px 0px 0px 0px;
	padding: 5px 0px 0px 0px;
}
#solution_students {
	margin: 0px 20px 0px 20px;
}
#solution_students .booth_head {
	background-image: url(/images/solution_students_head.png);
}
#solution_companies .booth_head {
	background-image: url(/images/solution_companies_head.png);
}
#solution_school .booth_head {
	background-image: url(/images/solution_school_head.png);
}
#partners {
	height: auto;
	margin: 10px 0px 0px 0px;
}
p {
	color: #666;
}
#center_content ul {
	color: #27374C;
	background-color: #FFF;
	background-image: url(/images/ul_bg.png);
	background-repeat: repeat-x;
	padding: 20px 20px 10px 30px;
	margin: 0px;
	font-weight: bold;
	border: 1px solid #CCC;
}
#center_content ul li {
	line-height: 21px;
	margin-bottom: 10px;
}
p.highlight {
	font-size: 14px;
	color: #27374C;
	line-height: 21px;
	font-weight: bold;
}
.graduate_booth {
	float: left;
	width: 280px;
	height: auto;
	border-bottom: 1px dotted #CCC;
	margin-bottom: 20px;
	background-color: #F9F9F9;
	padding: 0px 0px 5px 0px;
}
.graduate_booth_head {
	height: 30px;
	width: 280px;
	margin-bottom: 5px;
}
.graduate_booth_head h3 {
	font-size: 14px;
	font-weight: normal;
	margin: 0px;
	line-height: 30px;
	padding: 0px 0px 0px 10px;
	color: #FFF;
}
.graduate_booth_content {
	padding: 5px 10px 0px 10px;
	float: left;
	width: 135px; 
}
.how_booth_content {
	padding: 5px 10px 0px 10px;
	float: left;
	width: 135px;
	margin: 0px; 
}
.how_booth_content p {
	margin: 0px;
	font-size: 10px;
}
.how_booth_content a {
	font-weight: bold;
	line-height: 23px;
	font-size: 12px;
}
.how_booth_content a:hover {
	color: #27374C;
	text-decoration: underline;
}
.graduate_booth_content p {
	margin: 0px;
	line-height: 14px;
	font-size: 10px;
}
#center_content .graduate_booth_content p a {
	color: #27374C;
	font-size: 14px;
	line-height: 23px;
	font-weight: normal;
}
.graduate_booth_content p a:hover {
	color: #666;
}
.graduate_booth_image {
	width: 120px;
	height: 120px;
	float: left;
	padding: 0px 5px 0px 0px
}
#graduate_booth_services {
	background-image: url(/images/graduate_booth_head_services.png);
}
#graduate_booth_positions {
	background-image: url(/images/graduate_booth_head_positions.png);
}
#graduate_booth_deals {
	background-image: url(/images/graduate_booth_head_deals.png);
}
#graduate_booth_testimonials {
	background-image: url(/images/graduate_booth_head_testimonials.png);
}
#service_booth_1 {
	background-image: url(/images/service_booth_1.png);
}
#service_booth_2 {
	background-image: url(/images/service_booth_2.png);
}
#service_booth_3 {
	background-image: url(/images/service_booth_3.png);
}
#service_booth_4 {
	background-image: url(/images/service_booth_4.png);
}
.booth_content p.alt_p_1 {
	margin-top: 0px;
	padding-top: 0px;
	border-top: none;
}
.company_booth {
	float: left;
	width: 280px;
	height: 230px;
	border-bottom: 1px dotted #CCC;
	margin-bottom: 20px;
	background-color: #F9F9F9;
	padding: 0px 0px 5px 0px;
}
.company_booth_head {
	height: 30px;
	width: 280px;
	margin-bottom: 5px;
}
.company_booth_head h3 {
	font-size: 14px;
	font-weight: normal;
	margin: 0px;
	line-height: 30px;
	padding: 0px 0px 0px 10px;
	color: #FFF;
}
.company_booth_content {
	padding: 5px 10px 0px 10px;
	float: none;
	width: 260px; 
}
.company_booth_content p {
	margin: 0px;
	line-height: 14px;
	font-size: 10px;
}
.company_booth_content p a {
	font-weight: bold;
	line-height: 23px;
	font-size: 12px;
	
}
.company_booth_content p a:hover {
	color: #27374C;
	text-decoration: underline;
}
.company_booth_image {
	width: 270px;
	height: 120px;
	float: none;
	padding: 0px 0px 0px 0px;
	margin: 0px 5px 0px 5px;
}
#company_booth_booth1 {
	background-image: url(/images/graduate_booth_head_services.png);
}
#company_booth_booth2 {
	background-image: url(/images/graduate_booth_head_positions.png);
}
#company_booth_booth3 {
	background-image: url(/images/280_booth_head_2.png);
}
#company_booth_booth4 {
	background-image: url(/images/280_booth_head_3.png);
}
#five_reasons {
	margin-bottom: 10px;
	width: 190px;
	height: 40px;
	background-image: url(/images/5reasons.png);
}
#five_reasons a {
	display: block;
	height: 100%;
}
#five_reasons:hover {
	background-position: 0px -40px;
}
.index_booth_register {
	width: 168px;
	height: 25px;
	background-image: url(/images/register_here.png);
}
.index_booth_register a {
	display: block;
	height: 100%;
}
.index_booth_register:hover {
	background-position: 0px -25px;
}
#latest_jobs_index {
	padding: 10px 0px 0px 0px;
}
#latest_jobs_index h1 {
	margin-bottom: 10px;
}
#latest_jobs_index .latest_jobs_index_job_holder {
	border: 1px solid #CCC;
	padding: 5px;
	margin: 0px 0px 5px 0px;
}
#latest_jobs_index .latest_jobs_index_job_holder h4 {
	margin: 0px 0px 5px 0px;
	padding: 0px;
	font-size: 12px;
	font-weight: bold;
}
#latest_jobs_index .latest_jobs_index_job_holder p {
	margin: 0px;
	font-size: 10px;
}
.company_index_booth {
	float: left;
	width: 280px;
	height: auto;
	border-bottom: 1px dotted #CCC;
	margin-bottom: 20px;
	background-color: #F9F9F9;
	padding: 0px 0px 5px 0px;
}
.company_index_booth_head {
	height: 30px;
	width: 280px;
	margin-bottom: 5px;
}
.company_index_booth_head h3 a {
	color: #FFF;
}
.company_index_booth_head h3 a:hover {
	color: #F1F1F1;
}
.company_index_booth_head h3 {
	font-size: 14px;
	font-weight: normal;
	margin: 0px;
	line-height: 30px;
	padding: 0px 0px 0px 10px;
	color: #FFF;
}
.company_index_booth_content {
	padding: 5px 10px 0px 10px;
	float: none;
	width: 260px; 
}
.company_index_booth_content p {
	margin: 0px;
	line-height: 14px;
	font-size: 10px;
}
.company_index_booth_content p a {
	font-weight: bold;
	line-height: 23px;
	font-size: 12px;
	
}
.company_index_booth_content p a:hover {
	color: #27374C;
	text-decoration: underline;
}
.company_index_booth_image {
	width: 270px;
	height: 120px;
	float: none;
	padding: 0px 0px 0px 0px;
	margin: 0px 5px 0px 5px;
}
#company_index_booth_booth1 {
	background-image: url(/images/280_booth_head_1.png);
}
#company_index_booth_booth2 {
	background-image: url(/images/280_booth_head_2.png);
}
#company_index_booth_booth3 {
	background-image: url(/images/280_booth_head_4.png);
}
#company_index_booth_booth4 {
	background-image: url(/images/280_booth_head_3.png);
}

.candidate_index_booth {
	float: left;
	width: 280px;
	height: auto;
	border-bottom: 1px dotted #CCC;
	margin-bottom: 20px;
	background-color: #F9F9F9;
	padding: 0px 0px 5px 0px;
}
.candidate_index_booth_head {
	height: 30px;
	width: 280px;
	margin-bottom: 5px;
}
.candidate_index_booth_head h3 a {
	color: #FFF;
}
.candidate_index_booth_head h3 a:hover {
	color: #F1F1F1;
}
.candidate_index_booth_head h3 {
	font-size: 14px;
	font-weight: normal;
	margin: 0px;
	line-height: 30px;
	padding: 0px 0px 0px 10px;
	color: #FFF;
}
.candidate_index_booth_content {
	padding: 5px 10px 0px 10px;
	float: none;
	width: 260px; 
}
.candidate_index_booth_content p {
	margin: 0px;
	line-height: 14px;
	font-size: 10px;
}
.candidate_index_booth_content p a {
	font-weight: bold;
	line-height: 23px;
	font-size: 12px;
	
}
.candidate_index_booth_content p a:hover {
	color: #27374C;
	text-decoration: underline;
}
.candidate_index_booth_image {
	width: 270px;
	height: 120px;
	float: none;
	padding: 0px 0px 0px 0px;
	margin: 0px 5px 0px 5px;
}
#candidate_index_booth_booth1 {
	background-image: url(/images/280_booth_head_1.png);
}
#candidate_index_booth_booth2 {
	background-image: url(/images/280_booth_head_2.png);
}
#candidate_index_booth_booth3 {
	background-image: url(/images/280_booth_head_4.png);
}
#candidate_index_booth_booth4 {
	background-image: url(/images/280_booth_head_3.png);
}

.how_stage {
	padding: 10px 10px 0px 10px;
	margin: 0px 0px 10px 0px;
}
.how_stage p {
	text-align: center;
	font-size: 14px;
	color: #FFF;
	line-height: 21px;
	padding: 0px 0px 40px 0px;
	margin: 0px;
}
#stage_one {
	background-image: url(/images/stage_one.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
#stage_two {
	background-image: url(/images/stage_two.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
#stage_three {
	background-image: url(/images/stage_three.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
#stage_four {
	background-image: url(/images/stage_four.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
#stage_five {
	background-image: url(/images/stage_five.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
#stage_six {
	background-image: url(/images/stage_six.png);
	background-repeat: no-repeat;
	background-position: center bottom;
}
p.stage_login a {
	text-align: center;
	padding: 10px;
	display: block;
	text-transform: uppercase;
}
.contact_detail {
	border-bottom: 1px solid #CCC;
}
#center_content ul.roundabout-holder {
	background-image: none;
	border: none;
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