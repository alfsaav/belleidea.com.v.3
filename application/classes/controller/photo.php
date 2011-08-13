<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Photo extends Controller_MasterTemplate {
	
	public $gallery;
	
	public function action_index()
	{
	    
        //Debugger
        $fire = Fire::instance();    
    	//Initial setup
        $this->template->title   = 'Photography';
        $this->template->styles = array('assets/css/photo-cont-thumbs.css' => 'screen');
        
        $this->template->scripts = array_reverse(array("assets/js/address.js",
													   "assets/js/photo/bi_thumbs.js",
                                                       "assets/js/photo/collection_pg.js"));
		 //setting collection parameters     
		$coll_param = $this->request->param();
        
				
        //Getting All Collection Data from database
		$this->gallery = new Model_Photo;
		$colls =$this->gallery->getAllCollections();
		
        //Getting Sets and formating data for rendering 
		$colls_html_v = array(); 
		foreach($colls as $key => $coll){

			$show = ($key == 0) ? true : false;  
			
            //Get info from collection   
            $coll_id = $coll['collection_id'];
            $collection = $this->gallery->getCollection($coll_id); //e.g Fashion
            $collection['title'] = $coll['title'];
            $collection['slug_id'] = $coll['slug_id'];
            //get a collection from database  and stack in array
            $colls_html_v[] = $collection;
 			
		}
		unset ($key,$coll); 
        //
        //Rendering Page content
        //            
		//----<HEADER>-----
        //Photo Header Content
		
        $photo_header['title'] = 'Photography'; //Title of page
		//Rendering HTML block
        $page_hd['page_hd'] = View::factory('blocks/collection_header',$photo_header)->render(); //Add Header
        $this->template->header  = View::factory('templates/header',$page_hd); //Loading vars for header
		
        //----<MAIN CONTENT>---
        //Main Content
        $photo['collections']   = $colls_html_v;
		//Render Content in template
		$this->template->content = View::factory('pages/collections', $photo); //Loading vars for content
       
		
    }//End of index
	
    public function action_index_1()

	{

	    $this->template->title   = 'Gallery';

        $this->template->styles = array('assets/css/photo-cont-thumbs.css' => 'screen');

       // $this->template->scripts = array("assets/js/serv_bi.js");

        $this->template->content = View::factory('pages/collection_1');

        

    }

    
    
	public function action_gallery()
	{
		$fire = Fire::instance();    
    			
	    $this->template->title   = 'Gallery';
        $this->template->styles = array('assets/css/photo-cont-thumbs.css' => 'screen',
                                        'assets/css/scrolling.css' => 'screen'
                                        );
        $this->template->scripts = array_reverse(array("assets/js/address.js",
                                                       "assets/js/jquery.tools.min.js",
													   "assets/js/light_box.js",
													   "assets/js/photo/bi_img_slider.js",
													   "assets/js/photo/bi_thumbs.js",
													   "assets/js/photo/gallery_pg.js"));
		
		$set_id = $this->request->param('id');
	     
		//Getting All Colleciton Data from database
		$gallery = new Model_Photo;
		$gall = $gallery->getPhotos($set_id);
		
		//Get Thumbs HTML
		$th_params = array (  'id_alias' => 'image',
							  'id' => 'gallery',
							  'thumbs' => $gall['pics'],
							  'link_root' => '#pic=',
							  'thumb_size' => 172,
							  't_tip_size' => 230,
							  'show' => true,
							  'type' => 'image'
							  );
		
		$gall_html = $this->thumbs_factory($th_params); //Get Thumbs HTML
		
		 
		//Gallery Header Content
		$gallery_header['title'] = $gall['title']; //Title of page
		$gallery_header['n_pics'] = $gall['n_pics']; //Title of page
		
		//Photo Slider Content
		$slider['json'] = json_encode($gall); //JSON Object for javascript
		
		//Photo Content	
        $photo['header'] = View::factory('blocks/gallery_header',$gallery_header)->render(); //Add Header
        $photo['content']   = $gall_html;
		
		
		//Render Content in template
		$this->template->pg_scripts = View::factory('scripts/php_json', $slider)->render(); //Add Slider	JSON variable
		$this->template->content = View::factory('pages/gallery', $photo);
	
	}//End of gallery
	
	public function action_image()
	{
	}//End of image
	
##Helper Gallery Methods
	
	##
	#Collection Processor
	##
	public function process_colls($coll, $show)
	{
	//Get info from collection   
    $coll_id = $coll['collection_id'];
    $coll_slug = $coll['slug_id'];  
     //get collcetion from database  
    $coll_v = $this->gallery->getCollection($coll_id); //Fashion
 
    //Get Thumbs HTML
	$params = array ( 'id_alias' => 'collection',
					  'id' => $coll_slug,
					  'thumbs' => $coll_v['collection'],
					  'link_root' => '/photo/gallery/',
					  'thumb_size' => 172,
					  't_tip_size' => 230,
					  'show' => $show,
					  'type' => 'gallery'
					  );
	
	return $this->thumbs_factory($params); //Get Thumbs HTML
	
	}//End of Method

	##
	#Thumbnail Generator
	##
	public function thumbs_factory($options)
	{
		
        $fire = Fire::instance(); 
        
		//Default Settings
		$defaults = array(  'id_alias' => 'my_images',
							'id' => 'my_thumbs',
							'thumbs' => '',
							'link_root' => '',
							'thumb_size' => 172,
							't_tip_size' => 230,
							'show' => 'true',
							'type' => 'gallery' //gallery of IMAGEs, or collection of GALLERYs
		);
		//Merging Settings
		$params = array_merge($defaults, $options );
		
		$id_alias = $params['id_alias'];
		$id = $params['id'];
		$show = $params['show'];
		$thumbs = $params['thumbs'];
		$link = $params['link_root'];
		//Setting dimension scale   
		$dim_1 = $params['thumb_size'];
		$dim_2 = $params['t_tip_size'];
		$type = $params['type'];		
		
		//Hide or show container
		if ($show){
			$display = 'block';
		}else{
			$display = 'none';
		}
		//Init return Thumbs HTML
		
        $myThumbs = ''; 

        
        //Loop throughout all the thumbnails    
		foreach($thumbs as $key => $set){
			
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
			
			if ($type === 'gallery'){
			$child_link = $link.$set['slug_id'].'/';
			$thumb_data_1 = array($set['slug_id'],$width_th,$height_th,$set['url_s']);
			$thumb_data_2 = array(
								  $set['slug_id'], $child_link, $width_tip, $height_tip, 
								  $set['url_s'],"<p>{$set['title']}</p>","<span>{$set['n_pics']} Pics</span>"
								  );
			
			}else{ //image
			
            $child_link = $link.($key+1);
			$thumb_data_1 = array($set['id'],$width_th,$height_th,$set['url_s']);
			$thumb_data_2 = array(
								  $set['id'], $child_link, $width_tip, $height_tip, 
								  $set['url_s'],'',''
								  );
            }
            
            $img_in_row = 10;
            
            if ($type === 'image' AND $key%$img_in_row === 0 )
            $myThumbs .= '<div>';
            
			$myThumbs .= sprintf('<div class="thumb">%1$s %2$s </div>',
			vsprintf('<div class="image_cont" id="div_%1$s">
							<img id="img_%1$s" width="%2$d" height="%3$d" src="%4$s"/>
						</div>',
			$thumb_data_1),
			
			vsprintf('<a class="thumb_tip" id="ctip_%1$s" href="%2$s">
							<img   width="%3$d" height="%4$d" src="%5$s"/>
							%6$s %7$s
						</a>',
			$thumb_data_2)
			);
            
            $fire->log(sprintf('key: %1$s , mod:%2$s',$key,$key%6));
            
           	if ($type === 'image' AND $key%$img_in_row === $img_in_row-1 )
            $myThumbs .= '</div>';
			
		} //End of Foreach

		//Wrapp thumbs witn div container
		$myThumbs = sprintf('<div id="%1$s_%2$s" 
							class="thumb_container photo_elem items" 
							style="display:%3$s">'.$myThumbs
	                       	.'</div>',$id_alias, $id,$display); //Add Id and display mode. 
		
		
		return  $myThumbs;    
	}//End of Method

} 