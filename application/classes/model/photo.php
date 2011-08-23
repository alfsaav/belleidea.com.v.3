<?php
defined('SYSPATH') or die('No direct script access.');
class Model_Photo extends Model_Database	
 {
 	 ##Get ALL Collection in an array
	public function getAllCollections()
	{
	//Fetch all Collections with a given coll_id
    $sql = "SELECT * FROM `collection` ORDER by `index`";
     
	return $this->_db->query(Database::SELECT, $sql, FALSE)->as_array();
	}//End of Method
	
  
    ##Get ONE Collection in an array
	public function getCollection($coll_id){
    
	//Fetch all Collections with a given coll_id
    $sql = "SELECT `p`.`photoset_id` as id,`p`.`slug_id`, `p`.`title`,`p`.`n_pics`,`i`.`url_m`,`i`.`height_m`,`i`.`width_m`,`s_c`.`index`
              FROM `photoset` `p` NATURAL JOIN `set-has-col` `s_c` LEFT JOIN `images` `i`
              ON `p`.`gall_pic` = `i`.`pic_id`
              WHERE `s_c`.`collection_id` = '$coll_id'
              ORDER BY `index` DESC";

	$coll_v = $this->_db->query(Database::SELECT, $sql, FALSE)->as_array();
       
     return array('id' => $coll_id,
                  'collection' =>  $coll_v 
                  );
       
	}//End of Method
    
    
    ##Get ONE Collection in an array
	public function getPhotos($id){
	
	//$fire = Fire::instance();  
    //Get Gallery Information
	
    $sql = "  SELECT `set`.`photoset_id` as `id`, `set`.`title` as `title`, `set`.`n_pics`,`coll`.`title` as `parent_title`
              FROM `photoset`as `set` 
              NATURAL JOIN `set-has-col` as `s_c`
              JOIN `collection` as `coll`
              ON `coll`.`collection_id` = `s_c`.`collection_id`
              WHERE `set`.`slug_id` = '$id'
              LIMIT 1";
 					  
	$gall_info = $this->_db->query(Database::SELECT, $sql,FALSE)->as_array();
	$gall_info = $gall_info[0];
	
	//Get Pictures from Gallery
	$sql = "SELECT `i`.`pic_id` as `id`, 
				   `i`.`url_l`, `i`.`url_m`,`i`.`url_s`,
				   `i`.`width_l`, `i`.`width_m`, `i`.`width_s`,
				   `i`.`height_l`, `i`.`height_m`, `i`.`height_s`,`is`.`index`
			  FROM `images` as 	`i` NATURAL JOIN `img-has-set` as `is`
			  WHERE `is`.`photoset_id` = '{$gall_info['id']}'";

	$pics = $this->_db->query(Database::SELECT, $sql, FALSE)->as_array();;
	
	
	$gall_info['pics'] =  $pics;
	
	return $gall_info;

   
	}//End of Method
    
    
}