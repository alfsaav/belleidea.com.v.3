<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>

    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

    <meta http-equiv="Content-Language" content="en-us" />

    <title><?php echo $title;?></title>

    <meta name="keywords" content="<?php echo $meta_keywords;?>" />

    <meta name="description" content="<?php echo $meta_description;?>" />

    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />

    <!--Loading CSS-->

    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>

   	

    <!--[if IE]>

               <link rel="stylesheet" type="text/css" href="assets/css/ie.css">

	<![endif]-->

    

    <!--[if IE 7]>

               <link rel="stylesheet" type="text/css" href="assets/css/ie7.css">

	<![endif]-->

        

    <!--Loading JSvascript-->

    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>

	

	<?php echo $pg_scripts;?>

	

  </head>

  <?php
    //Adding a UserAgent Class to main body for CSS exceptions
           $browser = strtolower ($user_agent['browser']); 
           if(preg_match("/internet explorer/",$browser) !== 0){
            
            $ver  = $user_agent['version'][0];
            $browser = "IE IE".$ver;
            
           }
           
           $browser .= ($user_agent['mobile'])? " mobile" : "";
  ?>
  
  <body class="<?php echo $browser; ?>" >
        
     <?php echo $header;?>

     <?php echo $content;?>

     <?php echo $footer;?>

  </body>

</html>

