$(document).ready(function(){

sY = 24; /* height of li.sub */
fY = 185; /* height of maximum sub lines * sub line height */

animate (fY)
$("#slide .sub").click(function() {
if (this.className.indexOf('clicked') != -1 ) {
animate(sY)
$(this) .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
}
else {
animate(sY)
$('.clicked') .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
$(this) .addClass('clicked');
animate(fY)
}
});

animate (fY)
$("#slide .subBrands").click(function() {
if (this.className.indexOf('clicked') != -1 ) {
animate(sY)
$(this) .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
}
else {
animate(sY)
$('.clicked') .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
$(this) .addClass('clicked');
animate(785)
}
});

animate (fY)
$("#slide .subCategories").click(function() {
if (this.className.indexOf('clicked') != -1 ) {
animate(sY)
$(this) .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
}
else {
animate(sY)
$('.clicked') .removeClass('clicked')
.css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
$(this) .addClass('clicked');
animate(345)
}
});



function animate(pY) {
$('.clicked').animate({"height": pY + "px"}, 500);
}
$("#slide .subBrands,.sub,.subCategories") .hover(function(){
$(this) .css("background", "#ffffff url(io_images/arrows/down.gif) no-repeat 5px 8px")
.css("color", "#9e0000");
},function(){
if (this.className.indexOf('clicked') == -1) {
$(this) .css("background", "#3f6f9f url(io_images/arrows/out.gif) no-repeat 5px 8px")
.css("color", "#fff");
}
});
});

