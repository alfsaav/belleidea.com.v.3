<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_MasterTemplate {

	public function action_index()
	{
	    $this->template->title   = 'Welcome to Belleidea';
        $this->template->styles = array('assets/css/illu_folio.css' => 'screen');
        $this->template->scripts = array("assets/js/home_bi.js",
                                         "assets/js/pic_gallery_bi.js");
        
        
        $this->template->content = View::factory('blocks/image_slider');
    }
    
} // End Welcome
?>