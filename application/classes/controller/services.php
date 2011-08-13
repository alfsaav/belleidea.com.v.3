<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Services extends Controller_MasterTemplate {

	public function action_index()
	{
	    $this->template->title   = 'Services';
        $this->template->styles = array('assets/css/services.css' => 'screen');
        $this->template->scripts = array("assets/js/serv_bi.js");
    
		$this->template->content = View::factory('pages/services');
        
    }
    
} // End Welcome
?>