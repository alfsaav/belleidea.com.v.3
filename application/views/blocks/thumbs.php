


<?php
##
#Thumbnail Generator
##
function thumbs_factory($options){
	
	//Default Settings
	$defaults = array(  'id_alias' => 'collection',
						'id' => 'my_thumbs',
						'thumbs' => '',
						'thumb_size' => 172,
						't_tip_size' => 230,
						'show' => 'true'
	);
	//Merging Settings
	$params = array_merge($defaults, $options );
	
	$id_alias = $params['id_alias'];
	$id = $params['id'];
	$show = $params['show'];
	$thumbs = $params['thumbs'];
	//Setting dimension scale   
	$dim_1 = $params['thumb_size'];
	$dim_2 = $params['t_tip_size']; 
	
	//Hide or show container
	if ($show){
		$display = 'block';
	}else{
		$display = 'none';
	}
	//Init return Thumbs HTML
	$myThumbs = ''; 
	
	//Loop throughout all the thumbnails    
	foreach($thumbs as $set){
		
		global $console;    
		//scale thumbs to a fixed dimension ratio
		$ratio = $set['height_s']/$set['width_s'];
		if($ratio > 1){
			//Thumb Pic
			$height_th = $dim_1;
			$width_th = $height_th/$ratio;
			//Tooltip Pic
			$height_tip = $dim_2;
			$width_tip = $height_tip/$ratio;
		}else{
			//Thumb Pic
			$width_th = $dim_1;
			$height_th = $width_th*$ratio;
			//Tooltip Pic
			$width_tip = $dim_2;
			$height_tip = $width_tip*$ratio;
		}
		
		//Thumbnail Pattern
		$myThumbs .= sprintf('<div class="thumb">%1$s %2$s </div>',
		sprintf('<div class="image_cont" id="div_%1$s">
						<img id="img_%1$s" width="%2$d" height="%3$d" src="%4$s"/>
					</div>',
		$set['id'],$width_th,$height_th,$set['url_s']),
		
		sprintf('<a class="thumb_tip" id="ctip_%1$s">
						<img   width="%2$d" height="%3$d" src="%4$s"/>
						<p>%5$s</p>
						<span>%6$s pics</span>
					</a>',
		$set['id'],$width_tip,$height_tip,$set['url_s'],$set['title'],$set['n_pics'])
		);    
		
	} //End of Foreach

	//Wrapp thumbs witn div container
	$myThumbs = sprintf('<div id="%1$s_%2$s" 
												class="thumb_container" 
												style="display:%3$s">'.$myThumbs
	.'</div>',$id_alias, $id,$display); //Add Id and display mode. 
	
	
	return  $myThumbs;    
}
?>
<!--End of thumb_container-->
