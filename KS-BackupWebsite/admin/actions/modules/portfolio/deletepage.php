<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once('../../../../includes/inc.start.php');
$current_item = $_GET['item'];
$portObj = new Portfolio;
$layoutObj = new Layout;
$data = $portObj->getRecord($current_item);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<title>Delete</title>
<link rel="stylesheet" type="text/css" href="/css/css.php" />
<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/js/functions.js"></script>
</head>
<body>
<div id="container">
  <div id="wrapper">
      <div id="header">
        <?php $layoutObj->showHeader(); ?>
      </div>
      <div id="links">
      <a href="/admin/index">Home</a> | 
      <a href="/admin/addpage">Add Page</a> | 
      <a href="/admin/viewpages">View Pages</a>    
      </div>
      <div id="content">
<h1>Delete Item</h1>
<p>Please review the page you are about to delete. If you are sure you wish to delete this portfolio item, please click the Delete button at the bottom of this page.</p>
<form name="editpage" action="/admin/deleteportfolio" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>" />
<table align="center">
	<tr>
    	<td></td>
        <td><?php echo stripslashes($data[0]['page_name']);?></td>
    </tr>
	<tr>
	  <td>Title</td>
	  <td><input type="text" name="title" value="<?php echo $data[0]['title'];?>" /></td>
	  </tr>
	<tr>
	  <td>Image Location</td>
	  <td><input type="text" name="image_location" value="<?php echo $data[0]['image_location'];?>" /></td>
	  </tr>
	<tr>
	  <td>Link URL</td>
	  <td><input type="text" name="link_url" value="<?php echo $data[0]['link_url'];?>" /></td>
	  </tr>
	<tr>
	  <td>Description</td>
	  <td><input type="text" name="description" value="<?php echo $data[0]['description'];?>" /></td>
	  </tr>
    <tr>
      <td align="center" colspan="2"><input name="submit" type="submit" value="Delete" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace('page_content');
</script>        
</div>
      <div id="footer">
        <?php $layoutObj->showFooter(); ?>
      </div>
  </div>
</div>
</body>
</html>