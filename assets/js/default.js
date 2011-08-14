//Cufon engine replacing font to selectors below
//Cufon.replace('h1,h2,h3'); // Works without a selector engine 
/*Custom Jquery Code*/
//Returns whether selector exixts or not
jQuery.fn.exists = function(){return jQuery(this).length>0;}

//Slug Generator
bi_slug = function(slug) {
    var slugcontent = slug;
	var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
	var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
	finishedslug = finishedslug.toLowerCase();
	return finishedslug;
};


$(document).ready(function() {

//Check for Safari Browser

var bname = navigator.userAgent;
if(/safari/i.test(bname) && !/chrome/i.test(bname) ){ 
$('html').addClass('is-Safari'); //Add Class to html tag to add specific CSS rules for Safari browser
};

//Control which tab is on
var my_nav_link = $('#nav_link').val();;
$("ul#navBar_hd > li > a").removeClass("nav_active");
$("ul#navBar_hd > li > a:contains('"+my_nav_link+"')").addClass("nav_active");						 

//Default Portfolio tabs hide and show engine
$("li.menu_sub_cat").each(function(i){
	
	var _myTab = this;
	$(this).hover(
		function () {
		
		if($(_myTab).find('> a').hasClass('nav_active')){
		
		$(_myTab).data('active',true);
		$(_myTab).find('> a').removeClass('nav_active');
		
		}
		
		$(_myTab).find('> a').addClass('on_hover');
		//$(_myTab).find('a span').html("&#9660;");
		$(_myTab).find('div').show();
		
		
		},
		function(){
		
		if($(_myTab).data('active'))
			{
			$(_myTab).find('> a').addClass('nav_active');	
			}
		
		$(_myTab).find('> a').removeClass('on_hover');
		$(_myTab).find('div').hide();
		//$(_myTab).find('div').stop(true,true).fadeOut();
		}
		);
   });

//end of 'Doc Ready?'
});


function close_header(){
	  $("li.menu_sub_cat a span").html("&#9650;");
	  $("li.menu_sub_cat div").hide();
	  $("#main_hd").stop(true).animate({'height':'74px'}, 300, 'linear');
}