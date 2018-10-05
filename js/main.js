var waitForFinalEvent = (function () {
  var timers = {};
  return function (callback, ms, uniqueId) {
    if (!uniqueId) {
      uniqueId = "Don't call this twice without a uniqueId";
    }
    if (timers[uniqueId]) {
      clearTimeout (timers[uniqueId]);
    }
    timers[uniqueId] = setTimeout(callback, ms);
  };
})();

$(document).ready(function($) {
	/*add top menu class for <li>*/


	/*----------------------топ слайдер-------------------------*/


		
		/*-----------------патерн для телефонов в хедере------------------*/
		var telTest = Array.from(document.querySelectorAll('a.link_tel'));
		if (telTest !== null || telTest !== undefined) {
			telTest.map(function (elem) {
				// var href = elem.getAttribute('href');
				var text = String(elem.textContent);
				var textSort = text.replace(/[^\d]/g, '');
				if (textSort.length > 9) {
					elem.setAttribute('href', 'tel:+' + textSort);
					return elem;
				}
			});
		};
		

		/*============Прокрутка вниз на нажатию на кнопку=======*/

	  	$('.top-carousel-wrapper').on('click', '.icon_top-mouse', function(e) {
	  		e.preventDefault();
	  		let h2 = $('.top-carousel-wrapper').next().find('h2');
	  		$('html, body').animate({ scrollTop: h2.offset().top - 30 }, 500);
	  	});
	  	$('.main_bg').on('click', 'a.btn', function(e) {
	  		e.preventDefault();
	  		let href = $(this).attr('href');
	  		if(href == "#scroll_down") {
	  			let section = $('.main_bg').next();
		  		let sectionTop = section.offset();
		  		$('html, body').animate({ 'scrollTop': sectionTop.top }, 500);
	  		}
	  	});

	  /*-----------------секция product-info скролл тор---------*/
	  	$('.product-info').on('click', 'a.btn', function(e) {
	  		e.preventDefault();
	  		let href = $(this).attr('href');
	  		if(href == "#to_top") {
	  			let section = $('.product-single').offset();
		  		$('html, body').animate({ 'scrollTop': section.top }, 500);
	  		}
	  	});

	  	
	  	/*-----------------Scrool top--------------------*/
	  	let winHeight = $(document).height();

		let step = 5;

		let timeScroll = winHeight/step;

		$(window).on('scroll', function(e) {

			let scrolled = window.pageYOffset || document.documentElement.scrollTop;

			if (scrolled > document.documentElement.clientHeight) {

				$('.button_to_top').addClass('btn_show');

			}

			else if (scrolled <= document.documentElement.clientHeight) {

				$('.button_to_top').removeClass('btn_show');

			};
			
		});

		$('.button_to_top').on('click', function(){

			$('html, body').animate({

				scrollTop: 0

			}, timeScroll);

		});
			  	/*============на главной блок О КОМПАНИИ кнопка развернуть========*/
	  	
});

