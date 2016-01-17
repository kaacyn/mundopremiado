jQuery(document).ready(function($){

  $(window).scroll(function () {
     var scrollTop = $(window).scrollTop();

     if(scrollTop > 210){
        $("header .menu").addClass('flutuante');
     }else{
        $("header .menu").removeClass('flutuante');
     }

   });

});
