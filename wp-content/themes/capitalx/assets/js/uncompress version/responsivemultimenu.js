/*

Responsive Mobile Menu v1.1
Plugin URI: responsivemultimenu.com

Author: Adam Wysocki
Author URI: http://oncebuilder.com

License: http://opensource.org/licenses/MIT

*/

function adaptMenu() {
	/* 	toggle menu on resize */
	$('.c-main_nav').each(function() {
		// initialize vars
		var maxWidth = 0;
		var width = 0;

		// width of menu list (non-toggled)
		$('.c-main_nav-menu').children("li").each(function() {
			if($(this).parent().hasClass('c-main_nav-menu')){
				width = $(this).outerWidth();//outerWidth();
				if(width>0){
					maxWidth += width;
				}
			}
		});

		// compare width
		var width = $('.c-main_nav').css('width');
		width = width.replace('px', ''); 
		//console.log(width);
		if ( $(this).parent().width() > width ) {
			$('.c-main_nav-menu').removeClass("c-main_nav-mobile");
			
			//remove all classes from mobile verion
			$(".c-main_nav-menu ul").removeClass("c-main_nav-subview");
			$(".c-main_nav-menu li").removeClass("c-main_nav-subover-hidden");
			$(".c-main_nav-menu li").removeClass("c-main_nav-subover-visible");
			$(".c-main_nav-menu a").removeClass("c-main_nav-subover-header");

			$(".c-main_nav-toggled").removeClass("c-main_nav-closed");
			$('.c-main_nav-toggled').hide();
			
			//$('.c-main_nav-toggled').removeClass("c-main_nav-view");
			//$('.c-main_nav-toggled').addClass("c-main_nav-closed");
		}else {
			$('.c-main_nav-menu').addClass("c-main_nav-mobile");
			$('.c-main_nav-toggled').show();
			$('.c-main_nav-toggled').addClass("c-main_nav-closed");
			
			//$('.c-main_nav-toggled').removeClass("c-main_nav-closed");
		}
	});
}

function responsiveMultiMenu() {
	$('.c-main_nav').each(function() {
		// create mobile menu classes here to light up HTML
		$(this).find("ul").addClass("c-main_nav-submenu");
		$(this).find("ul:first").addClass("c-main_nav-menu");
		$(this).find("ul:first").removeClass("c-main_nav-submenu");
		$(this).find('.c-main_nav-submenu').prepend( '<li class="c-main_nav-back"><a href="#">back</a></li>' );
		$(this).find("ul").prev().addClass("c-main_nav-dropdown");
	
		// initialize vars
		var maxWidth = 0;
		var width = 0;

		// width of menu list (non-toggled)
		$('.c-main_nav-menu').children("li").each(function() {
			if($(this).parent().hasClass('c-main_nav-menu')){
				width = $(this).outerWidth();//outerWidth();
				if(width>0){
					maxWidth += width;
				}
				//console.log(width)
			}
		});

		if ($.support.leadingWhitespace) {
			$(this).css('max-width' , (maxWidth+5)+'px');
		}else{
			$(this).css('width' , (maxWidth+5)+'px');
		}
		
		// create dropdown button
		var str=''
		str+='<div class="c-main_nav-toggled c-main_nav-view c-main_nav-closed">'
		 
				 
				str+='<div class="c-main_nav-toggled-button"><span class="fa fc-navicon"></span></div>';
			 
		str+='</div>';
		
		$(this).prepend(str);
	});
	
	// click interacts in mobile wersion
	$('.c-main_nav-dropdown').on('click',function (e) {
		if($(this).parents(".c-main_nav-menu").hasClass('c-main_nav-mobile')){
			e.preventDefault();
			e.stopPropagation();
			
			$(this).next().addClass("c-main_nav-subview");

			var index=$(this).parent().index();
			
			var i=0;
			$(this).parent().parent().children("li").each(function() {
				if(index==$(this).index()){
					$(this).removeClass("c-main_nav-subover-hidden");
					$(this).addClass("c-main_nav-subover-visible");
				}else{
					$(this).removeClass("c-main_nav-subover-visible");
					$(this).addClass("c-main_nav-subover-hidden");
				}
			});
			$(this).addClass("c-main_nav-subover-header");
		}
	});
	
	// click back interacts in mobile version
	$('.c-main_nav-back a').on('click',function () {
		$(this).parent().parent().prev().removeClass("c-main_nav-subover-header");
		$(this).parent().parent().removeClass("c-main_nav-subview");
		$(this).parent().parent().parent().parent().find("li").removeClass("c-main_nav-subover-hidden");
	});
	
	// click toggler interacts in mobile version
	$('.c-main_nav-toggled, .c-main_nav-toggled .c-main_nav-button').on('click',function(){
		if ($(this).is(".c-main_nav-closed")) {
			$(this).removeClass("c-main_nav-closed");
		}else {
			$(this).addClass("c-main_nav-closed");
		}
	});	
}

jQuery(window).load(function() {
    responsiveMultiMenu();
	adaptMenu();
});


$(window).resize(function() {
 	adaptMenu();
});
