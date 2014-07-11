<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
* 18/11/09
*****************************************/?>

<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View News articles for <?php echo $_GET['catname']; ?> category</h1>
<p>Please select an option to perform on the following categories.</p>
<table width="100%">
	<tr class="searchtitle">
    <td>ID</td>
    <td>Author</td>
    <td>Title</td>
    <td>Publisher</td>
    <td>Published On</td>
    <td>Date Added</td>
    <td>Content</td>
    <td>Action</td>
    </tr>
<?php   
   //show data
   for ($i=0;$i<count($q);$i++)
	   {
	   if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
	  
<tr <?php echo $style?>>
        <td><b><?php echo $q[$i]['id'];?></b></td>
        <td><?php echo $q[$i]['author'];?></td>
        <td><?php echo $q[$i]['title'];?></td>
        <td><?php echo $q[$i]['publisher'];?></td>
        <td><?php echo date('d-m-Y', strtotime($q[$i]['date_published']));?></td>
		<td><?php echo date('d-m-Y', strtotime($q[$i]['date_added']));?></td>        
        <td><?php echo $q[$i]['content'];?></td>
        <td><a href='/admin/actions/modules/news_directory/editnewsarticle/<?php echo $q[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/news_directory/deletenewsarticle/<?php echo $q[$i]['id'];?>/'>Delete</a></td>

<?php 
}
?>
</table>



<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
<br /> <br /> <br /> 
<?php
$rsObj->getNumberLinks();
?>