var BI_thumbs = {       
	/*
		Thumbnails handler
		*/
init:function(id){
		
		var that = this;
		
		//Initialize first container of thumbs
		if(typeof id !== 'undefined')
		that.show_thumbs(id,true);
		
		
		//Thumbnails Hover Handler
		$('.thumb').hover(function() {
			
			var thumb = $(this).find('.thumb_tip'), //Thumbnail container
			thumb_pic = $(this).find('.thumb_tip img'), //Thumbnail pic
			pic = $(this).find('.image_cont > img'), //Original pic 
			pos_x = 0,
			pos_y = 0,    
			init_pos = pic.position(); //current size position obj
			
			//Getting initial and final widths 
			var w_ini = pic.width(),
			w_fin = thumb_pic.attr('width')
			
			var h_ini = pic.height(),
			h_fin = thumb_pic.attr('height')
			
			//Padding offset
			var padd_y = parseFloat(thumb.css('padding-top'))/2; 
			var padd_x = parseFloat(thumb.css('padding-left'))/2; 
			
			//Final thumb position
		
            pos_x = init_pos.left - (w_fin - w_ini)/2 - padd_x; 
			pos_y = init_pos.top - (h_fin - h_ini)/2 - padd_y; 
            
			//Updating position 
			thumb
			.css({'z-index' : '10',
				'position':'absolute',
				'width':w_fin,
				'left': pos_x, 
				'top': pos_y
			}) 
			.stop(true,true).show().effect("size", {origin:['middle','center'],from:{'width': w_ini,'height': h_ini}, to: {'width': w_fin,'height': h_fin} }, 200);      
			
			
		}, function() {
			$(this).find('.thumb_tip')
			.stop(true,true)
			.hide();
			
		});
	},//End of init func 
	/*
		Show Thumnails (based on container id)
	*/
	show_thumbs:function(id,animate){
		
		//sanitazing entry var
		if(id.search(/#/) == -1){
			id = '#'+id;            
		}

		
		//Hide all containers
        if($('.photo_elem.active').attr('id') === 'holder_wrap_bi'){
             
             $('#holder_wrap_bi').css({'position':'absolute'}).animate({'opacity':0,'top':-150},750,function(){                    
                    $(this).hide();
                    $(this).css({'position':'relative'})
             })
            
        }else{
            $('.photo_elem.active').hide();
        }
        
        $('.photo_elem.active').removeClass('active');
        		
		if(animate){
			
			//Get thumbnails of this collection
			var my_thumbs = $(id).find('.thumb');
			
			//Make their content invisible (keep dimensions)
			my_thumbs.css({'visibility': 'hidden'});
			
			$.each(my_thumbs, function(i,thumb){
				
				var show_thumb = function(){
					$(thumb).css({'visibility': 'visible','opacity':'0'}).animate({'opacity':'1'},500);
				}
                var my_random = Math.floor(Math.random() * 1000) + 500;
				//Delaying animation               
				setTimeout(show_thumb,my_random);    
				
			});
			//Show Given Container
			$(id).show('slow');  
		}
		else{
			
            //Just show the darn elem
	   if(id === "#holder_wrap_bi"){
             
                /*$(id).css({'visibility': 'visible','top':-150,'opacity':0,'display':'block'})
                .animate({'opacity':1,'top':0},500);
                */
                $(id).css({'visibility': 'visible','top':0,'opacity':1})
                .show();                       
                
            }else{
            
            $(id).show();
            
            } 
	    }
        
        $(id).addClass('active');
		
		
	},//End of show_thumbs func 	 	
    ////		
    //Centering Thumbnail images with its frame	
    ////
	center_thumb_img:function(){
    
    var my_thumbs = $('.thumb');
    
    $.each(my_thumbs, function(i,thumb){
        
        var my_img = $(thumb).find('img'),
        	img_w = my_img.width(),
            img_h = my_img.height(),
			f_img_w,
            f_img_h,			
            thumb_d = 300; 									
        
        //Center Thumbnails with respect to its frame			
         
         f_img_w = Math.round((thumb_d - img_w)/2); //Horizontal			
         f_img_h = Math.round((thumb_d - img_h)/2); //Vertical			
         my_img.css({
                    'left':f_img_w+'px',				
                    'top':f_img_h+'px'			
                    })		
         });//End of each			
    }
}//End of BI_thumbs 
