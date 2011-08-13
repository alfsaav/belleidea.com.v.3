<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends Controller_MasterTemplate {

	public function action_index()
	{
	    $this->template->title   = 'About';
        $this->template->styles = array('assets/css/about.css' => 'screen');
       // $this->template->scripts = array("assets/js/serv_bi.js");
    
		$this->template->content = View::factory('pages/about');
        
    }
    
} // End Welcome
?>