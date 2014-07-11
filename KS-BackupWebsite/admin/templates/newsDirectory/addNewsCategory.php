<?php
$formObj = new formCreator;
$language_array = $this->SelectQuery("SELECT * FROM tbl_languages ORDER BY default_language DESC","master");
$language_array[0]['language'] .= ' (Default)';
?>
<h1>Add News Category</h1>         
<form name="addnewscategory" action="" method="post">
<table align="center">
	<?php if($errmsg!=''){?>
    <tr>
	  <td colspan="2"><div id="errmsg"><?php echo $errmsg;?></div></td>
    </tr>
    <?php } ?>
    <?php
	$formObj->formSelectRow('Language','selected_language',$language_array,'language','id',$_POST['selected_language']);
	$formObj->formtextRow('Category Name','categoryname',$_POST['categoryname']);
	$formObj->formtextAreaRow('Description','description',$_POST['description'],8,60);
	?>  
      <td>
      
      <input type="submit" value="ADD" name = "submit" onclick="return validateOnSubmit()"/>
      </td>
    </tr>
</table>
</form>

