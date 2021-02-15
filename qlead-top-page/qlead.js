


var mySwiper = new Swiper('.swiper-container', {

  autoplay: {
  delay: 1000,
  },
  

  // Optional parameters
  loop: true,
  speed:6000,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  effect:'fade',

  // Navigation arrows
  navigation: {
    nexEl: '.swiper-button-next',
    prevtEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },


});




function hamburger() {
  document.getElementById('line1').classList.toggle('line_1');
  document.getElementById('line2').classList.toggle('line_2');
  document.getElementById('line3').classList.toggle('line_3');
  document.getElementById('navigation').classList.toggle('in');
}
document.getElementById('hamburger').addEventListener('click' , function () {
  hamburger();
} );



//一文字ずつ表示させる

const animationTargetElements = document.querySelectorAll(".textAnimation");
  for(let i = 0; i< animationTargetElements.length; i ++){
    const targetElement = animationTargetElements[i],
    texts = targetElement.textContent;
    textsArray = [];

    targetElement.textContent = "";


    //文字列をいったん配列に入れるため
    //splitは中で指定した文字列でくぎって配列にする→今回は間に何もないのですべて取得

    for(let j = 0 ; j < texts.split("").length; j++){
      const t = texts.split("")[j]
      if (t === " "){
        textsArray.push(" ");
      } else {
        textsArray.push('<span><span style="animation-delay:' + (j * 0.3 + 1) + 's;">' + t + '</span></span>')
      }
    }
    for(let k = 0 ; k < textsArray.length; k++){
      targetElement.innerHTML += textsArray[k];
    }
  }




/*******Jquery**********/


jQuery(function($){

  $('#navigation a[href]').on('click', function(event){
    $('#hamburger').trigger('click');
  });



  $('#top-button').click(function(){
    $('html,body').animate({
      'scrollTop':0
    },500);
  });

  $('header a').click(function(){
    var position = $($(this).attr('href')).offset().top;
    $('html,body').animate({
    'scrollTop':position
    },500); 

  });


  /***ふわっと実装
  $(window).scroll(function(){
    var main1Top = $('.main1').offset().top + 500; 
    var scroll = $(this).scrollTop();

    if( scroll > main1Top)
    $('.main1').fadeIn(800);
  });  *///

////////////////////////関数定義////////////////////////

  function scroll_effect(){
    $('.effect-fade').each(function(){

      var windowScroll = $(window).scrollTop();
      var effectTop = $(this).offset().top;
      var windowHeight = $(window).height();

      if( windowScroll > effectTop - windowHeight/1.5 ){
        $(this).addClass('effect-scroll');
      }else if(windowScroll <= effectTop - windowHeight/1.5 ){
        $(this).removeClass('effect-scroll');
      }
   
    });
  }




////////////////////////ロード時////////////////////////

  window.onload = function(){

    $('#first-view').addClass('hirogaru');
    $('#first-view').addClass('fadeOut');
  }

////////////////////////スクロール時////////////////////////

  $(window).scroll(function(){
      scroll_effect();

      $('.activity').each(function(){

        var actTop = $(this).offset().top;
        var windowScroll = $(window).scrollTop();
        var windowHeight = $(window).height();

        if(windowScroll > actTop - windowHeight/1.2){
          $(this).addClass('open');
        }else if (windowScroll <= actTop - windowHeight/1.2){
          $(this).removeClass('open');
        }

      });
  });
  $('#navigation > li').click(function(){

    var $navL = $(this).find('ul >li');
    var $navU = $(this).find('ul');

    if($navL.hasClass('open-submenu')){
      $navL.removeClass('open-submenu');
    }else{
      $navL.addClass('open-submenu');
    }
    if($navU.hasClass('r-45deg')){
      $navU.removeClass('r-45deg');
    }else{
      $navU.addClass('r-45deg');
    }
    


  });

  
  



});







