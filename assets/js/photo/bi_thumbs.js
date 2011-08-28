var BI_thumbs = {       
	/*
		Thumbnails handler
		*/
init:function(id){
		
		var that = this;
		
		//Initialize first container of thumbs
		if(typeof id !== 'undefined')
		that.show_thumbs(id,true);
		
		//Thumb Preloaders
        $.each($('.thumb .image_cont > img'),function(i, img){
            
            var width = $(img).width(),
                height= $(img).height(),
                img_par = $(img).parent(); //img parent
            
            $(img).load(function(){
                $(this).parent().find('.pre_img').remove();
                $(this).fadeIn();
            })             
                
            //Preload Image
            var pre_img = $('<div></div>');
			
			pre_img.css({
			             'width':width,
                         'height':height,
			            })
                          .addClass('pre_img')
                          .appendTo(img_par);    
         });
        
		//Thumbnails Hover Handler
		$('.thumb').hover(function() {
			
            if($(this).find('.image_cont .pre_img').length > 0)
            return false;
            
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
			.stop(true,true);
            
            if( $('body').hasClass('firefox') || $('body').hasClass('IE7')){ //Check for Firefox
                
              thumb.show();
                
            }else{
            
              thumb.effect("size", 
                        {
                             origin:['middle','center'],
                             from:{'width': w_ini,'height': h_ini}, 
                             to: {'width': w_fin,'height': h_fin},
                             scale:'content' 
                        }, 200);      
		    }      
            
			
		}, function() {
			
            var thumb = $(this).find('.thumb_tip');
            
            thumb
    			//.removeAttr("style")
                .stop(true,true)
                .hide();
            
            thumb
                 .find('img')
                 //.removeAttr("style")
                 .stop(true,true);
         	
		});
	},//End of init func 
	/*
		Show Thumnails (based on container id)
	*/
	switch_panel:function(id,anim_type,callback){
		
		var _self = this;
        
        //sanitazing entry var
		if(id.search(/#/) == -1){
			id = '#'+id;            
		}
        ////
        //Hide Active Panel
	    var old_panel = $('.photo_elem.active');
            
        switch(anim_type){
            
            case "fade out":
                _self.fade_up(old_panel);
                break;
            default:
                old_panel.hide();
        }
          
        old_panel.removeClass('active');
        
        //Add Selected Panel
        $(id).show()
             .addClass('active');
		
        //Run Callback if any
        $.isFunction(callback) && callback();
        
		
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
    },
    
////		
//Transition animations
////
    
    fade_up:function(obj, callback){
        
        var obj_pos = $(obj).position();
        
        $(obj).css({ 'position':'absolute', 
                     'top':obj_pos.top,
                     'left':obj_pos.left,
                     'z-index':10000
                    }).animate({'opacity':0,
                                'top':-150},750,function(){                    
    
                                        $(this).removeAttr("style")
                                               .hide();
                                 });

        
        
    }


    
}//End of BI_thumbs 
