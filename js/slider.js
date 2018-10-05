jQuery(document).ready(function() {


var sliderTop = document.querySelector('.top_carousel');
var flkty = new Flickity( sliderTop, {
  cellAlign: 'center',
  contain  : true
  // "autoPlay" : true,

});

var sliderBottom = document.querySelector('.carousel_bottom');
var flkty1 = new Flickity( sliderBottom, {
  contain  : true,
  pageDots : false,
  cellAlign: 'center',
  wrapAround: true
});
})