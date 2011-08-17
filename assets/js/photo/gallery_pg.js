$(document).ready(function(){
		
		//Setting up image slider
		Pic_Slider.init({gall_holder:'#web_gallery',
				 gal_height:'500',
                 gal_width:'100%',
				 full_screen:true,
				 automatic:true});
		
		//Setting Function Callback when Picture changes
		Pic_Slider.PIC_Changed = function(){
			 var gall_meta =  Pic_Slider.meta_data //Gallery meta data obj
			 
			 //Updating nav menu meta data
			 $('#current_pic_bi').text(gall_meta.index);
			 
			 $.address.queryString('pic='+ gall_meta.index);
		 }
		//When site address bar is first intiatiated 
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
		
		$('#image_gallery .thumb_tip').click(function(e){
				var index = $(this).attr('href');
				index  = index.match(/(\d+)/)[1];
				
				//BI_thumbs.show_thumbs('#holder_wrap_bi');//Shows Container based on id
				
				Pic_Slider.go_to_pic(index);
				
				var pos_y = $('#holder_wrap_bi').position().top -100;
				$('html, body').animate({scrollTop:pos_y}, 1000, function(){
								
				});
				
				
				
				e.preventDefault();
		});
		
		$('#thumb_tggl a').click(function(e){
			
			var id = $(this).attr('href');
			//BI_thumbs.show_thumbs(id);//Shows Container based on id
			var pos_y = $(id).position().top -100;
			$('html, body').animate({scrollTop:pos_y}, 'slow');
			e.preventDefault();
		});
		  
        
        $("#scrollable").scrollable({'circular':'true'});  
     
		//Init Thumbs 
		//id = $('.thumb_container:first').attr('id');
		BI_thumbs.init();	
		
		
		
}); //End of Doc Ready  