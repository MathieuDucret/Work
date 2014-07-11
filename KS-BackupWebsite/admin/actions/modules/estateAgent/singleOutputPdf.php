<script type="text/javascript">
function initialize() {
	var myLatlng = new google.maps.LatLng(<?php echo $data[0]['latitude'];?>,<?php echo $data[0]['longitude'];?>);
    var myOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
	//Initialise the map
    var map = new google.maps.Map(document.getElementById("propertyMapCanvas"), myOptions);  	
		
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"<?php echo $data[0]['address_1'];?>"
    });	
}
$(document).ready(function(){ 
	initialize();
});
</script>
<div id="propertyProfile" style="border:1px solid #000;">
	<div id="topLine" style="padding:10px;border-bottom:1px solid #000;margin-bottom:10px;height:20px;">
    	<div style="float:left;"><?php echo $data[0]['address_1'].', '.$data[0]['town'].', '.$data[0]['postcode'];?></div>
        <div style="float:right;"><?php echo $this->id2text('statuses',$data[0]['property_status']);?></div>
        <div style="clear:both;"></div>
	</div>
    <div id="leftPanel" style="float:left;width:725px;">
    	<div id="imagePanel" style="margin-bottom:10px;">
        	<div id="primaryImage" style="float:left;width:310px;height:230px;text-align:center;border:1px solid #000;margin-left:10px;margin-right:10px;">
            	<?php $this->getPrimaryImage($data[0]['id'],'normal');?>
            </div>
            <div id="otherImages" style="float:right;width:390px;height:230px;overflow:auto;">
            	<?php $this->getOtherImages($data[0]['id'],'thumbnail');?>
            </div>
            <div style="clear:both;"></div>
		</div>
        <div id="featuresPanel" style="margin-bottom:10px;padding:10px;">
        	<?php echo $this->getFeatures($data[0]['id']);?>
        </div>
        <div id="descriptionPanel" style="padding:10px;">
        	<?php echo $data[0]['description'];?>
        </div>            
    </div>
    <div id="rightPanel" style="float:right;width:230px;margin-right:10px;">
    	<div id="propertyInfo" style="border:1px solid #000;padding:5px;margin-bottom:15px;">
        	<div style="margin-bottom:10px;">Property Information</div>
            <div style="margin-bottom:5px;">
            	<div style="float:left;width:60%;"><?php echo $data[0]['bedrooms'];?> Beds</div>
                <div style="float:right;width:40%;"><?php echo $data[0]['bathrooms'];?> Baths</div>
				<div style="clear:both;"></div>
			</div>
            <div>
            	<div style="float:left;width:60%;">&pound;<?php if($data[0]['ownership']=='Let') echo $data[0]['price'].' PCM'; else echo $data[0]['price'];?></div>
                <div style="float:right;width:40%;"><?php echo $data[0]['tenure'];?></div>
				<div style="clear:both;"></div>
			</div>   
		</div>                                         
        <div id="propertyMap" style="border:1px solid #000;">
        	<div style="margin-bottom:10px;padding:5px;margin-bottom:5px;">Location</div>
            <div style="height:250px;width:100%;" id="propertyMapCanvas"></div>
		</div>     
            
    </div>    
    <div style="clear:both;"></div>
</div>    
