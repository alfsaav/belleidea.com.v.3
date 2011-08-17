<?php

###

##HTML Header Template 

###

?>
<!-- HEADER -->
     
<div id="header"> 
     <div id="main_hd"> 
	 
		<div class="wrapper">

              <a id="logo_hd" href="/"><img src="/assets/img/main_logo.png" alt="Belle Idea" ></a>                                        



                   <ul id="navBar_hd">

                       

                       <input id="nav_link" type="hidden" value=" " />

                       <li class="menu_sub_cat"><a href="#">portfolio</a>

                       <div>

                              <ul>

                                 <li><a href="/web">WebDesign/Development</a></li>

                                 <li><a href="/photo" >Photography</a></li>

                                 <li class="nav_last"><a href="/illustration">Illustration</a></li>

                               </ul>

                        </div>

                        

                     </li>   
                        <li class="menu_sub_cat"><a href="/blog/" >blog</a>

                          <div>

                              <ul>

                                 <li><a href="/blog/">Most Recent Posts</a></li>

                                 <li><a href="/blog/category/journal/" >Journal</a></li>

                                 <li><a href="/blog/category/photography/" >Photography</a></li>

                                 <li class="nav_last"><a href="/blog/category/webdesign/">WebDesign</a></li>

                               </ul>

                        </div>

                        </li>



                       <li  class="menu_sub_cat"><a href="/services/" >services</a>

                          <!--<div>

                              <ul>

                                 <li><a href="#">WebDesign</a></li>

                                 <li><a href="#" >Photography</a></li>

                              </ul>

                          </div>-->

                       

                       </li>

                        <li><a href="/about/" >about</a></li>

                        <li class="nav_last"><a href="/contact/" >contact</a></li>  

                   </ul>
     
	         </div>
	 </div>
     
     <!-- Page Header comes here -->
     <?php 
     //Sub Page nav header
     if(isset($page_hd)){ 
        echo '<div id=\'page_hd\'>'.$page_hd.'</div>';
     }
     ?>
     <!-- Fade Bar, is a png gradient span across the page, to simulate a fading effect as users scroll -->
     <div class="fade_bar"></div>
     
</div>     
     

<!--End of Header headerBanner wrapper-->