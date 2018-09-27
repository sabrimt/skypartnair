(function () {
  /******    On scroll animations     *******/ 
  
    /* Hidden Elements show animation on scroll  functions*/
    function slideElementBack(element, index) {
      setTimeout(function() {
        element.addClass('show-slide-anim');
      }, 300 * (index+1));
    }
  
    function showHiddenElements(parentSection, movableSelector) {
      if (parentSection) {
          if ($(window).scrollTop() > parentSection.offset().top-300){
                var $hiddenAnimElts = parentSection.find($(movableSelector));
                
                $hiddenAnimElts.each(function(index) {
                    slideElementBack($(this), index);
                });
            
          }
      }
    }


    var $numAnimElt = $('#index-banner2'); // Elément cible contenant les Nombres
    var $animEltsContainer = $('#blog-section'); // Elément cible contenant les Element à montrer en slide
    var $blogEltsContainer = $('#index-banner1'); // Elément cible Blog contenant les élements à montrer en slide

  
    $(window).scroll(function(){
        /* Numbers animation on scroll */
        if (document.getElementById('index-banner2')){
            if ($(window).scrollTop() > $numAnimElt.offset().top-400){

                $('.count').each(function () {
                    $(this).prop('Counter',$(this).text()).animate({
                        Counter: $(this).attr('data-anim-num')
                    }, {
    //                  delay: 3000,
                        duration: 2500,
                        easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
            }
        }

        showHiddenElements($animEltsContainer, '.left-slide-anim');
        showHiddenElements($blogEltsContainer, '.left-slide-anim');
        
    });
})();