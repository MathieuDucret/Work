<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<div id="subdomain_footer" style="padding:15px;text-align:left;">
<?php
for($i=0;$i<$count_areas;$i++)
{
	if($i%21==0)
	{
		$j=$i;
		?>
	<div style="float:left;margin-left:26px;">
   		<?php
	}
		$area = $get_areas[$i]['Area'];
		$postcode = $get_areas[$i]['PostCode'];
		$encode_area = str_replace('&','and',$area);
		$display_area = $encode_area;
		$encode_area = str_replace(' ','_',$area);	
?>
<a style="font-size:9px;color:#fff;letter-spacing:1px;" href="http://<?php echo $encode_area.'.'.SITE_TLD;?>"><?php echo $display_area;?></a><br />
<?php
    if(($i-20)==$j)
	{		
	?>
	</div>
    <?php
	}	
}
?>
</div>
<div style="clear:both;"></div>
</div>