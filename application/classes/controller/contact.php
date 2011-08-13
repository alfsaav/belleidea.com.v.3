<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contact extends Controller_MasterTemplate {

	public function action_index()
	{
	    $this->template->title   = 'Contact';
        $this->template->styles = array('assets/css/contact.css' => 'screen');
        $this->template->scripts = array( 'assets/js/validator.min.js',
                                          'assets/js/val.custom_contact.js');
    
		$this->template->content = View::factory('pages/contact');
        
    }
    
} // End Welcome
?>