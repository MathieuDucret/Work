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
html{
}
#admin_content{
	padding-right:0px;
	text-align:justify;
    overflow:visible;

	padding-left:250px;
    min-height:800px;
}

#admin_content_bg{
    background-image:url('/images/admin_menu_bg.png');
    background-repeat:repeat-y;
    margin:0;
    
}
#admin_menu{
	float:left;
	width:240px;
}

#admin_footer{
	background-image:url('/images/admin_footer.png');
    background-repeat:no-repeat;
    background-color:#4e4e4e;
    height:70px;
    }
    
#admin_header{
	background-image:url('/images/admin_logo.png');
    background-repeat:no-repeat;
    background-color:#4e4e4e;
    height:100px;
    }    
body{
	margin:0;
	border:0;
	background-color:#FFFFFF;
	font-family:Arial;
    font-size:12px;       
}
h1{
	font-size:<?php echo $cssObj->getCSS('h1_size');?>;
    font-weight:normal;
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
#label {
	color:<?php echo $cssObj->getCSS('label_color');?>;
    }
<?php if($cssObj->getCSS('curved_corners')=='Yes') {?>
#compat #wrapper{
	behavior:url(/css/border-radius.htc);
}<?php } ?>
img{ 
margin-left: <?php echo $cssObj->getCSS('image_margin_left');?>;
margin-right: <?php echo $cssObj->getCSS('image_margin_right');?>;
border:0;
}
#header{
	background-color:<?php echo $cssObj->getCSS('header_background_color');?>;
<?php if($cssObj->getCSS('curved_corners')=='Yes') {?>    
    -moz-border-radius:10px;
	-webkit-border-radius:10px;
<?php } ?>
}
#wrapper{
	background-color:#FFF;
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
    margin-top:15px;
    overflow:visible;
}
#contentright{
    margin-left:<?php echo $cssObj->getCSS('margin_left');?>;
	margin-right:<?php echo $cssObj->getCSS('margin_right');?>;
	text-align:<?php echo $cssObj->getCSS('font_alignment');?>;
    overflow:visible;
}
#menu{
	text-align:center;
    padding-bottom:50px;
}
#menu_vertical{
float:left;
}
#menuleft{
    text-align:center;
}
#footer{
	text-align:center;
}
#ic a{
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	text-decoration:none;
	font-size:8pt;
	font-weight:bold;
	color:#906;
}
#errmsg{
	font-size:14px;
	background-color:#FC9; 
	border:solid 1px #900;
    padding:5px;
}
.errmsg{
	font-size:14px;
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
#title {
	font-size: 16pt;
    color:#545454;
    text-align:left;
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
#parent_category{
font-size:18px;
}
#sub_category{
font-size:16px;
}
#category_title{
font-size:18px;
}
#category_description{
}
#category_page{
}
input
{
	font-size:12px;
}    
select
{
	font-size:12px;
}
textarea
{
	font-size:12px;
}
    
    