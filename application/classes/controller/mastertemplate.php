<?php

 defined('SYSPATH') or die('No direct script access.');



 class Controller_MasterTemplate extends Controller_Template

  {

     public $template = 'templates/master';



     /**

      * Initialize properties before running the controller methods (actions),

      * so they are available to our action.

      */

     public function before()

      {

         // Run anything that need ot run before this.

         parent::before();



         if($this->auto_render)

          {

            // Initialize empty values

            $this->template->title            = '';

            $this->template->meta_keywords    = '';

            $this->template->meta_description = '';

            $this->template->meta_copywrite   = '';

            $this->template->header           = '';

            $this->template->content          = '';

            $this->template->footer           = '';

            $this->template->styles           = array();

            $this->template->scripts          = array();
            
            $this->template->user_agent       = '';
            
			$this->template->pg_scripts       = '';

          }

      }



     /**

      * Fill in default values for our properties before rendering the output.

      */

     public function after()

      {

         if($this->auto_render)

          {

             // Define defaults

             $styles                  = array('assets/css/bi_img_slider.css' => 'screen',

                                              'assets/css/photo_folio.css' => 'screen',

                                              'assets/css/screen.css' => 'screen'

                                             );

             $scripts                 = array('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
                                              'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js', 
                                              'assets/js/jquery.tweet.js',
                                              'assets/js/default.js',
                                              'assets/js/default_last.js' 
                                             );



             // Add defaults to template variables.

              //Detecting User Agent 
              
              $this->template->user_agent  =  Request::user_agent(array('browser', 'version',  'mobile'));
                 
              if (empty($this->template->header))
              {
               $this->template->header  = View::factory('templates/header'); 
              }
              if (empty($this->template->footer))
              {
               $this->template->footer  = View::factory('templates/footer'); 
              }  
             $this->template->styles  = array_reverse(array_merge($this->template->styles, $styles));
             $this->template->scripts = array_reverse(array_merge($this->template->scripts, array_reverse($scripts)));

           }



         // Run anything that needs to run after this.

         parent::after();

      }

 }

