jQuery(document).ready(function($) {

	jQuery('.main-carousel').flickity({
		cellAlign: 'center',
		contain: true,
		wrapAround: true,
		pageDots: false
	  });
	  jQuery('.clients-carousel').flickity({
		  // options
		  cellAlign: 'center',
		  contain: true,
		  wrapAround: true,
		  pageDots: false
		});

		// jQuery('li ul.sub-menu').each(function(i){
		// 	$(this).css('display', 'block');
		// 	$(this).addClass('drop');

		// 	if(i==0) {
		// 		$(this).addClass('first');
		// 	} else if(i==1) {
		// 		$(this).addClass('second');
		// 	} else if(i==2) {
		// 		$(this).addClass('three');
		// 	}

		// });

});

/*------------------- файле catalog.html more_info устанавливаем высоту блока*/
let infoRow = Array.from(document.querySelectorAll('.more_info .row'));
infoRow.map(function(elem) {
	let col7 = elem.querySelector('.col-xs-7').getBoundingClientRect();
	let col4 = elem.querySelector('.col-xs-4');
	col4.style.height = col7.height + 'px';
})
/*------------файл pnevmogun.html настраиваем tabs---------------------*/
let tabs = Array.from(document.querySelectorAll('.product__cart-info .menu li'));
let targetTabs = Array.from(document.querySelectorAll('.product__cart-info .product_info'));
tabs.map(function(elem, index){
elem.addEventListener('click', function(e) {
	targetTabs.map(function(elem){
		if(elem.classList.contains('show')) {
			elem.classList.remove('show')
		}
	})
	targetTabs[index].classList.toggle('show');
})
});

let stock_images = Array.from(document.querySelectorAll('.stock_image .img_box'));

function setHeight(mass) {
let max = 1;
mass.map(function(elem) {
let heightEl = elem.getBoundingClientRect().height;
if(max < heightEl) {
	max = heightEl;
}
elem.style.height = max + "px";
return elem;
})
};

/*---------------кнопка наверх-------------------*/
jQuery(document).ready(function($) {
let winHeight = $(document).height();
let step = 5;
let timeScroll = winHeight/step;
$(window).on('scroll', function(e) {
	let scrolled = window.pageYOffset || document.documentElement.scrollTop;
	if (scrolled > document.documentElement.clientHeight) {
		$('.button_top').addClass('btn_show');
	}
	else if (scrolled <= document.documentElement.clientHeight) {
		$('.button_top').removeClass('btn_show');
	};
});
$('.button_top').on('click', function(){
	$('html, body').animate({
		scrollTop: 0
	}, timeScroll);
});
/*----------кнопка "показать еще" на странице stock.html потестил---------*/
$('#stock_block-1').on('click', function(e) {
	$('.wrapper.hidden-block').toggleClass('visible-block');
});
/*----------------------index.html тоже действие кнопка развернуть---*/
// $('button.more').on('click', function(e) {
// 	$('.container.hidden-block').toggleClass('visible-block');
// 	$(this).children('span').toggleClass('rotate');
// });

/*-------------Всем кнопкам .more вставляю спан <span> со стрелкой вниз*/
// $('button.more').append('<span></span>');
/*-------------Всем кнопкам отменил дейтвие по умолчанию-------------*/
// $('button').on('click', function(e) {
// 	e.preventDefault();
// })
});
