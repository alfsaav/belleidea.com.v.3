<!-- Photography Collections -->
<div class="wrapper liquid body_content"> 
<?php
//Debugger
$fire = Fire::instance(); 
//Loop throughout all the Collections    
foreach($collections as $key => $coll){
    //Params
	$id_alias = $coll['slug_id'];
	$id = $coll['id'];
	$thumbs = $coll['collection'];
	$base_url = '/photo/gallery/';
	$dim_1 = 300; //Setting image scale
    
    
    $fire->log($thumbs);
    
    //Loop throughout all the Colleciton Thumbs    
    $myThumbs= ''; //Thumbs string container
    foreach($thumbs as $key => $thumb){
        
    	//scale thumbs to a fixed dimension ratio
		$ratio = $thumb['height_m']/$thumb['width_m'];
		if($ratio > 1){
			//Thumb Pic
			 $width_th= $dim_1;
			 $height_th = $width_th*$ratio;
			
		}else{
			//Thumb Pic
			$height_th = $dim_1;
			$width_th = $height_th/$ratio;
		}

     $img_in_row = 3;
        $last = '';   
            if ($key%$img_in_row === $img_in_row-1 ){
                $last='last';    
            }
        //Set link url
        $url = $base_url.$thumb['slug_id'];
        //Data params for html
        $thumb_data = array($thumb['id'],      //1 
                            $width_th,         //2
                            $height_th,        //3
                            $thumb['url_m'],   //4 
                            $thumb['title'],   //5 
                            $thumb['n_pics'],  //6
                            $last,             //7
                            $url               //8   
                            );
    	
        $myThumbs .= vsprintf('<a id="img_%1$s" class="bi-collection thumb %7$s" href="%8$s">
                                   <img id="img_%1$s" width="%2$d" height="%3$d" src="%4$s" alt="%5$s"/>
                                    <div class="caption">
                                        <h2>%5$s</h2>
                                        <div class="meta">
                                            <span class="n_pics">%6$s</span>
                                            <span class="date">06.20.2011</span>
                                        </div>
                                    </div>
                                </a>',$thumb_data);
   
    }
    //Outputting Data
    printf('<div id="collection_%1$s" 
			class="thumb_container photo_elem bi_collection" 
			style="display:block">'.$myThumbs
           	.'</div>',$id_alias, $id); //Add Id and display mode. 
    //$fire->log($thumbs);
}
?>
</div>  