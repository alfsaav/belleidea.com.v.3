$(document).ready(function(){
		
		//Setting up image slider
		Pic_Slider.init({gall_holder:'#web_gallery',
				 gal_height:'500',
                 gal_width:'100%',
				 full_screen:true,
				 automatic:true,
                 timer_prd:5000
                 });
	
		//When pic_slider obj is finished loading, hide and remove hidden class
        Pic_Slider.GALL_Loaded = function(){
             var slider_holder = Pic_Slider.get_holder();
            slider_holder.hide()
                         .removeClass('hidden');
        
        }
        //Setting Function Callback when Picture changes
		Pic_Slider.PIC_Changed = function(){
			 var gall_meta =  Pic_Slider.meta_data //Gallery meta data obj
			 
			 //Updating nav menu meta data
			 $('#current_pic_bi').text(gall_meta.index);
			 
			 //$.address.queryString('pic='+ gall_meta.index);
		 }
		
        Pic_Slider.load_php_json(BI_GLOBAL.pics,1); //BI_GLOBAL coming from PHP_JS view
        //When site address bar is first intiatiated 
		/*
        $.address.init(function(e) {
		
			if(window.location.hash == '' || typeof e.parameters.pic == 'undefined' ){
		 	
			Pic_Slider.load_php_json(BI_GLOBAL.pics,1); //BI_GLOBAL coming from PHP_JS view	
		 
		 }else{ 

			if( typeof e.parameters.pic !== 'undefined')
			  {
				  var pic_index = e.parameters.pic
				  Pic_Slider.load_php_json(BI_GLOBAL.pics,pic_index); //BI_GLOBAL coming from PHP_JS view	
				 // Pic_Slider.go_to_pic(pic_index);
			  }
		 }
		
		}); //End of Int listener
		*/
		//Thumbnails Listeners - When thumb is clicked Slider will open on the selected pic
        $('#image_gallery .thumb_tip').click(function(e){
				var index = $(this).attr('href');
				index  = index.match(/(\d+)/)[1];
			    $('#gall_nav .slider').trigger('click');
                
                Pic_Slider.go_to_pic(index);
		      
              e.preventDefault();
		});
        
        //Navigation Listeners
        //Gallery Views
        $('#gall_nav .slider,#gall_nav .thumbs').click(function(e){
          
          e.preventDefault();
          if(!$(this).hasClass('active')){  //Check that is not active    
                
                if($(this).hasClass('slider')){
                    
                    BI_thumbs.show_thumbs('#holder_wrap_bi');//Shows Container based on id
                
                }else{
                    BI_thumbs.show_thumbs('#image_gallery');
                    
                }
                if($(this).attr('class') === 'slider'){
                  $('#gall_nav .sl-mode').fadeIn('1000');  
                }else{
                  $('#gall_nav .sl-mode').fadeOut('300');
                }
                
                $('#gall_nav .slider,#gall_nav .thumbs').toggleClass('active');
          }      
                
                
        });
        //Automatic Play Listeners
        $('#gall_nav .play,#gall_nav .pause').click(function(e){
          e.preventDefault();
          if(!$(this).hasClass('active')){  //Check that is not active   
                
                if($(this).hasClass('play')){
                  Pic_Slider.timer(true);  
                }else{
                  Pic_Slider.timer(false);
                }
                $('#gall_nav .play,#gall_nav .pause').toggleClass('active');
         }       
        });
        
        //Full Screen Button
         $('#gall_nav .full_screen').click(function(e){
             Pic_Slider.full_screen();
        })

             
     //Init Thumbs >> Initializes thumb tooltips; 
	   	BI_thumbs.init();
       /* $('#image_gallery .image_cont').hover(
                                                function(){
                                                   $(this).stop(true,true).effect("scale", { percent: 150}, 500);
                                                          },
                                                function(){
                                                   $(this).stop(true,true).effect("scale", { percent: 100}, 500); 
                                                });
       */
        $('#gall_nav .thumbs').addClass('active');
        $('#gall_nav .play').addClass('active');	
  
		
}); //End of Doc Ready  