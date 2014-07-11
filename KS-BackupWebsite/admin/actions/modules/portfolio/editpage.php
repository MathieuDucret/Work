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
$count = count($portObj->getRecords());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<title>Admin Panel</title>
<link rel="stylesheet" type="text/css" href="/css/css.php" />
<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/js/functions.js"></script>
<script type="text/javascript" src="/js/validate.js"></script>

<SCRIPT TYPE="text/javascript">

  function validateOnSubmit() {
		var errcount = 0;
		var message = "";
	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(1);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="title";
			form_Field_name[0][1]="0";
	
		
			var retVal = validate(form_Field_name);
			return retVal;
}
	
</SCRIPT>
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
<h1>Edit Item</h1>
<form name="editpage" action="/admin/addportfolio" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />
<input type="hidden" name="editpage" value="true" />
<table align="center">
  <tr>
    <td colspan="2"><?php echo $errmsg;?></td>
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
    <td>Order Number</td>
    <td>
    

   <select name = "order_no">
	<?php for ($i=0; $i<($count+2); $i++) {?>
	        <option value="<?php echo $i?>" <?php if ($i==$data[0]['order_no']) {echo "selected";}?>><?php echo $i?></option>
    <?php } ?>
   </select>
   </td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="submit" type="submit" value="Update" onclick="return validateOnSubmit()"/></td>
  </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'page_content',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>        
</div>
      <div id="footer">
        <?php $layoutObj->showFooter(); ?>
      </div>
  </div>
</div>
</body>
</html>