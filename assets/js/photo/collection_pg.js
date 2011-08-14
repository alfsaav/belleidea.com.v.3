$(document).ready(function(){
	//Center Image thumbnails
	BI_thumbs.center_thumb_img(); 	
	//Event that listens for Externnal changes in the url address bar
		$.address.externalChange(function(e) {
		var id; 
		if(e.path === '/'){
			id = $('.thumb_container:first').attr('id'); //collection_fashion-and-beauty
			$.address.path(id.replace('collection_','')); //Sets the hash value of the url 
			BI_thumbs.init(id); 
		}else{
			id = e.path.replace('/','#collection_'); //    /abstract   #collection_abstract
			console.log(id);	
			if( $(id).length > 0 ){ //If Element exists
				BI_thumbs.init(id);//Shows Container based on id
				$('#photo_nav a.port_its_on').removeClass('port_its_on');
				id = e.path.replace('/','');
				$('#photo_nav  a[href*='+id+']').addClass('port_its_on');					
			}else{
				id = $('.thumb_container:first').attr('id');
				BI_thumbs.init(id);	
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