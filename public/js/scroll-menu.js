!(function($){
	$(document).ready(function(){
		// browser window scroll (in pixels) after which the "back to top" link is shown
		var offset = 50,
			//grab the "back to top" link
			$back_cv = $('#header');
			$back_ch = $('#slider');

		//hide or show the "back to top" link
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_cv.addClass('fixed') : $back_cv.removeClass('fixed');
			( $(this).scrollTop() > offset ) ? $back_ch.addClass('fixed') : $back_ch.removeClass('fixed');
		});
		$('.images-roduct .thum-img').click(function() {
    		var urli = $(this).attr('rel')
    		$('.images-roduct .image_thum').css('background-image','url('+ urli +')');
    	});
		$('.list-link').bxSlider({
	    			minSlides: 1,
	    			maxSlides: 8,
	    			slideWidth: 172.5,
	    			slideHeight: 100,
	    			slideMargin: 10,
	    			auto: false
	   	});
		$('#new-product').bxSlider({
	    			minSlides: 1,
	    			maxSlides: 5,
	    			slideWidth: 235,
	    			slideHeight: 100,
	    			slideMargin: 45,
	    			auto: false
	   	});
	   	$('#much-interest').bxSlider({
	    			minSlides: 1,
	    			maxSlides: 5,
	    			slideWidth: 235,
	    			slideHeight: 100,
	    			slideMargin: 45,
	    			auto: false
	   	});

	});
})(jQuery);