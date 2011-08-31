$(document).ready(function(){
	
    //Center Image thumbnails
	BI_thumbs.center_thumb_img();
    BI_thumbs.img_preload('.thumb > img'); 	
    
    //$('.photo_elem:first').addClass('active');
    BI_thumbs.switch_panel('#collection_fashion-and-beauty');
    
    
    //Event that listens for Externnal changes in the url address bar
		$.address.externalChange(function(e) {
		var id; 
		if(e.path === '/'){
			id = $('.thumb_container:first').attr('id'); //collection_fashion-and-beauty
			$.address.path(id.replace('collection_','')); //Sets the hash value of the url 
			BI_thumbs.switch_panel(id) 
		}else{
			id = e.path.replace('/','#collection_'); //    /abstract   #collection_abstract
			if( $(id).length > 0 ){ //If Element exists
				BI_thumbs.switch_panel(id);//Shows Container based on id
				$('#collec_nav a.port_its_on').removeClass('port_its_on');
				id = e.path.replace('/','');
				$('#collec_nav  a[href*='+id+']').addClass('port_its_on');					
			}else{
				id = $('.thumb_container:first').attr('id');
				BI_thumbs.switch_panel(id);	
			}
		}
	});
	/*
	//Navigation link handler Internal Address Changes
	$('#photo_nav a.bi_coll').address(function(){
		if(!$(this).hasClass('port_its_on')){
			$('#photo_nav a.port_its_on').removeClass('port_its_on');
			$(this).addClass('port_its_on');

			id = $(this).attr('href').replace('#','#collection_');
			BI_thumbs.show_thumbs(id);//Shows Container based on id
			return $(this).attr('href').replace(/^#/,'');
		}
	});
	*/

}); //End of Doc Ready  