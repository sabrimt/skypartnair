(function () {
  /******    On scroll animations     *******/ 

    var $numAnimElt = $('#index-banner2'); // Elément cible contenant les Nombres
  
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
    });
})();



/******    On scroll animations     *******/    
/* Hidden Elements appear with animation on scroll */
/**
 * 
 * @param {object} parentSections Element/Elements jQuery ou tableau d'élements jQuery: La/Les section conteneur du/des éléments à animer 
 * @param {string} direction La direction de l'animation: Permet de construire les selecters: ".direction-slide-anim" prepare l'element pour l'anim
 */
var showHiddenElements = function (parentSections, direction = 'left', delay = 300) {
    var movableSelector = '.'+direction+'-slide-anim',
        parents = [],
        parentSection;
    if (parentSections instanceof jQuery) {
        parentSections.each(function() {
            parents.push($(this));
        });
    } else {
        parents = parentSections;
    } 
    

    $(window).scroll(function(){
        for(var i = 0, len = parents.length; i < len; i++) {
            parentSection = parents[i];
            
            if (parentSection) {
                var $hiddenAnimElts = parentSection.find($(movableSelector)),
                    showFromTopOn = parentSection.offset().top - ($(window).height() - $hiddenAnimElts.first().height()),
                    showFromBottomOn = parentSection.offset().top + 300,
                    hideFromTopOn = parentSection.offset().top - $(window).height() - 100,
                    hideFromBottomOn = parentSection.offset().top + parentSection.height();
                
                if ($(window).scrollTop() > showFromTopOn && $(window).scrollTop() < showFromBottomOn) {
                    
                    $hiddenAnimElts.each(function(index) {
                        if (!$(this).hasClass('show-slide-anim')) {
                            $(this).addClass('show-slide-anim');
                            $(this).css('transition-delay', (delay * (index)) + 'ms');
                        }
                    });
                    
                } else if ($(window).scrollTop() < hideFromTopOn || $(window).scrollTop() > hideFromBottomOn ) {
                    $hiddenAnimElts.each(function() {$(this).removeClass('show-slide-anim');});
                }
            }
        }
    });
};

var $animEltsContainer = $('.animated-blocks'); // Eléments cibles contenant les Elements à montrer en slide
//var $blogEltsContainer = $('#blog-section'); // Elément cible Blog contenant les élements à montrer en slide
var $titlesEltsContainer = $('.animated-title'); // Eléments cibles contenant les titres à animer

showHiddenElements($animEltsContainer);
showHiddenElements($animEltsContainer, 'bottom');
showHiddenElements($titlesEltsContainer, 'top');
showHiddenElements($titlesEltsContainer);
