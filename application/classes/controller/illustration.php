<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Illustration extends Controller_MasterTemplate {

	public function action_index()
	{
	    $this->template->title   = 'Illustration';
        $this->template->styles = array('assets/css/illu_folio.css' => 'screen');
        $this->template->scripts = array("assets/js/photo/pic_gallery_bi.js",
						                 "assets/js/illu_bi.js");
    
		$this->template->content = View::factory('pages/illustration');
        
    }
    
} // End Welcome
?>