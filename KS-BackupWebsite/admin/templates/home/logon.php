<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
if (isset($_SESSION['admin']['user']) && isset($_SESSION['admin']['pass'])){?>
<script type="text/javascript">
<!--
window.location = "<?php echo SITE_URL;?>/admin/home/index"
//-->
</script>
<?php } else echo "Access Denied"; ?>

