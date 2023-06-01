jQuery(document).ready(function($){

  var CalcRaise, CalcVal, rtl;
  
  /** Donation Plugin percent calc **/
  $('.give-goal-progress .raised .give-percentage').each(function(){
    CalcRaise = $(this).text();
    CalcVal = CalcRaise.replace('%', '');
    if( CalcVal > 100 ){
      CalcRaise = '100%';
    }
    $(this).parent().css('margin-left','calc('+CalcRaise+' - 21px)');
  });

  if( revive_charity_data.rtl == '1' ){
      rtl = true;
  }else{
      rtl = false;
  }
    
    /** Give Slider */
    $('.give-slider').owlCarousel({
      items : 3,
      loop:true,
      margin : 30,
      nav: true,
      dots : false,
      rtl: rtl,
      responsiveClass:true,
      responsive:{
          0:{
              items:1,
          },
          600:{
              items:2,
          },
          1000:{
              items:3,
          }
      }
  });


  
  $(".main-navigation ul li a").on( 'focus', function(){
     $(this).parents("li").addClass("focus");
  }).on( 'blur', function(){
     $(this).parents("li").removeClass("focus");
  });

});
