$(function(){
  $updatecart=$(".updatecart");
  $updatecart.click(function(e){
    e.preventDefault();
    $quantity=$(this).parents('tr').find('.quantity').val();
    $key=$(this).attr("data-key");
    $.ajax({
      url:'capnhatgiohang.php',
      type:'GET',
      data:{'quantity':$quantity,'key':$key},
      success:function(data){
        if(data==1){
          alert("Cập nhật giỏ hàng thành công");
          location.href='cart.php';
        }else{
          alert("Số lượng quá mức cho phép");
          location.href='cart.php';
        }
      }
    });
  })
})



const nav = document.querySelector('#nav-menu');
let topOfNav = nav.offsetTop;
function fixNav() {
  if(window.scrollY >= topOfNav) {
    document.body.style.paddingTop = nav.offsetHeight + 'px';
    document.body.classList.add('fixed-nav');
  } else {
    document.body.classList.remove('fixed-nav');
    document.body.style.paddingTop = 0;
  }
}
window.addEventListener('scroll', fixNav);
jQuery(function($){
 jQuery(".cartbox").hover(function(){
  jQuery(this).find(".cartbox-summary").fadeIn(500);
}
  ,function(){
      jQuery(this).find(".cartbox-summary").fadeOut(500);
  }
 );
});
slideshowContainer
var slideIndex = 0;
showSlides();
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("img-box");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  slides[slideIndex-1].style = "block";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
}
