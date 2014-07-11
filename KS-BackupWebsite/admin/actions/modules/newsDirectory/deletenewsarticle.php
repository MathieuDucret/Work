<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<h1>Delete News Article</h1>
<form name="deletenewsarticle" action="" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center" width = "50%">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Username
        </td>
        <td>
        	<input readonly type="author" name="name" value= "<?php echo $data[0]['author'];?>"/>
        </td>
    </tr>
     <tr>
    	<td>
        	Title
        </td>
        <td>
        	<input readonly type="author" name="name" value= "<?php echo $data[0]['title'];?>"/>
        </td>        
     </tr>    
     <tr>
    	<td>
        	Publisher
        </td>
        <td>
        	<input readonly type="author" name="name" value= "<?php echo $data[0]['publisher'];?>"/>
        </td>
    </tr>
    <tr>
    	<td colspan="2"><?php echo $data[0]['content'];?></td>
    </tr>
    <tr>
    	<td>
    		Are you sure you wish to delete the above news article
    	</td>
    </tr>
    <tr>
	<td>
      <input type="submit" value="Yes" name = "submit" />
      <INPUT TYPE="button"  value="Cancel" name = "cancel" onClick="parent.location='/admin/index'">
      
      </td>
    </tr>
</table>
</form>
       
</div>
      <div id="footer">
        <?php $layoutObj->showFooter(); ?>
      </div>
  </div>
</div>
