$(document).ready(function() {

    (function($){

        $(function(){

          $('.button-collapse').sideNav();

          $('.parallax').parallax();

        }); // end of document ready

    })(jQuery); // end of jQuery name space



    /*** Sliding hidden Elements on ready (e.g Mini-form) ***/

    $('.onready-anim').addClass('show-slide-anim');

    /***** END Sliding hidden Elements on ready *****/

    


    /*** Show the scroll to main content button ***/

    if ($('#focus-content').length > 0) {
        $('#scroll-back2top').css({display: 'block'});
    }

    /***** END Show the scroll to main content button *****/





    // Effects on scroll

    var options = [
        {
            selector: '.move-list',
            offset: 200,
            callback: function(el) {
                Materialize.showStaggeredList($(el));
            }
        }
    ];

    Materialize.scrollFire(options);

    



// Activates Materialize select
    $('select').material_select();

    $('#mail-form-content textarea').characterCounter();


    
    

/****    SMOOTH SCROLL   ****/

    function smoothScrollTo(target, speed = 1000, easing = 'easeInOutQuad') {
        $('html, body').animate( { scrollTop: $(target).offset().top - 70}, speed, easing );
    }

    $('.js-scrollTo').on('click', function(e) { // Au clic sur un élément
        let page = $(this).attr('href'); // Page cible

        smoothScrollTo(page);

        return false;

    });

    $('.js-scrollTo-focus').on('click', function(e) { // Au clic sur un élément
        let page = $(this).attr('href'); // Page cible

        smoothScrollTo(page, 500);

        return false;

    });

    // Go to error messages on load
    var errorToTarget = $('#error-scroll-target');
    if (errorToTarget.length) {
        smoothScrollTo(errorToTarget);
    }

/****    END smooth scroll   ****/

    

/******* HOME FORM ********/

    let asBtn = $("#home-form .vol.btn-as");// Btn Aller simple

    let arBtn = $("#home-form .vol.btn-ar");// Btn Aller retour

    let desDateInput = $("#home-form .des-date");// Form Input des-date

    if (asBtn.hasClass("vol-active")){

        desDateInput.hide();

    }

    asBtn.click(function(){// Select AS button & Hide Input elements

        $(this).addClass("vol-active");

        arBtn.removeClass("vol-active");

        

        desDateInput.slideUp();

        

        $("#home-form button[name=envoidevis]").val("as");

    });

    arBtn.click(function(){// Select AR button & Show Input elements

        $(this).addClass("vol-active");

        asBtn.removeClass("vol-active");

        

        desDateInput.slideDown();

        

        $("#home-form button[name=envoidevis]").val("ar");

    });

    

    // Apparition aide pour format tel

    let phoneInp = $("#home-form input[name=phone]");

    let phoneInfo = $("#home-form .phone-info");

    

    phoneInp.focus(function(){

        $("#home-form .inmarg").addClass("input-nomarg");

        phoneInfo.slideDown(600);

    });

    phoneInp.blur(function(){

        phoneInfo.slideUp(600);

        $("#home-form .inmarg").removeClass("input-nomarg");

    });

/******* END home form ********/

    

    

/******* FLASH COLLAPSIBLE HEADER ********/

    let mailForm = $("#mail-form-content"); // mail form

    let mailSubmit = mailForm.find($("button.btn[name=send]"));// form submit button

    let saleInfos = $(".sale-infos-form");// sale id container

    let prevVal = mailSubmit.val();// sale id submitted

    

    // Expand submitted collapsible item

    if(prevVal !== "") {

        let prevSale = $(".sale-infos-form[data-sale="+prevVal+"]"); // submitted sale container

        let $prevCollapsible = $(".move-item").has(prevSale); // submitted collapsible item 

    

        $prevCollapsible.attr("id", "active-item");

        $prevCollapsible.addClass("active");

        $prevCollapsible.children(".collapsible-header").addClass("active");

        

    }

    

    $('.collapsible').collapsible({

        onOpen: function(el) { // Callback for Collapsible open

            let collapsBody = el.children(".collapsible-body");

            let collapsHeader = el.children(".collapsible-header");
            let aircraftDetailPageLink = $('#aircraft-details-page');

             



            if(collapsBody.hasClass("minheight")){

               collapsBody.removeClass("minheight");

               collapsBody.height(mailForm.height());

            }

            

            // puts the form into active collapsible body

            mailForm.appendTo(collapsBody);

            

            // put sale id into submit btn value
            mailSubmit.val(collapsHeader.find(saleInfos).attr('data-sale'));
            

            // put aircraft id into complete details link
            aircraftDetailPageLink.attr('href', aircraftDetailPageLink.attr('data-fleet-url') + collapsHeader.find(saleInfos).attr('data-aircraft'));


            

            // Retire la bande interest block des éléments fermés

            $(".interest-block").css("display", "none");

            // Garde la bande affichée pour l'élément ouvert

            collapsHeader.children(".interest-container").children(".interest-block").css("display", "");

        },

        onClose: function(el) { // Callback for Collapsible close

             let collapsBody = el.children(".collapsible-body");

             let collapsHead = el.children(".collapsible-header");

             

            // Règle "collapsible body" à la hauteur du form

            collapsBody.addClass("minheight");

            

            

            collapsHead.find(".header-aircraft-details").slideUp();

        }

     });

  

    $(".collapsible-header").hover(function(){

        if(!$(this).hasClass("active")){

            $(".interest-block", this).slideToggle("fast");

        }

    }).delay(2000);

    

/****** DETAILS MODAL ******/

    $("#mail-form-content .show-btn").click(function(e){

        e.stopPropagation();

        

        let detailsContent = $(e.target).parents(".move-item").find(".header-aircraft-details");

        

        detailsContent.slideToggle(200);

        

        detailsContent.find(".details-close-ban").click(function(e){

            e.stopPropagation();

            detailsContent.slideUp(300);

        });

        detailsContent.find(".header-aircraft-details-content").click(function(e){

            e.stopPropagation();

            detailsContent.slideUp(300);

        });

        

        

//        detailsContent.children(".header-aircraft-details-content").click(function(){

//            e.stopPropagation();

//            e.preventDefault(); 

//        });

//        detailsContent.click(function(){

//            e.stopPropagation();

//            e.preventDefault(); 

//           

//            console.log("coucou");

//        });

      

    });

  

/******* end flash collapsible header ********/

    

/******* FLASH MAIL FORM ********/

    // input focus on label click

    $('.input-field > label').click(function(){

        let parent = $(this).parent('.input-field');

        parent.children('input').focus();

    });

    

    /** phone input placeholder **/

    // current lang

    let pathname = window.location.pathname;

    let path = pathname.split('/');

    let lang = path[2];

    

    let placeholder = "Préciser l\'indicatif du pays (ex pour France +33)";

    if(lang == "en"){

       placeholder = "specify the country code (eg +33 for France)"; 

    }

    

    $('.placeholder-input').focus(function(){

        $(this).attr('placeholder', placeholder);

         $( this ).blur(function(){

            $(this).removeAttr('placeholder');

            if($(this).val() == ''){

                $(this).next().removeClass('active');

            }

         });

    });

    

    // Gender/Name/other prefix icon behaviour
    let $inputsContainer = $(".gender-name-fields");
    let $inputs = $inputsContainer.find('input');
    let $prefixIcon = $inputsContainer.children(".input-field").children('i.prefix');

    // Input "name" focus
    $inputs.focus(function(){
        $prefixIcon.addClass("active");

        $(this).blur( function(){
            $prefixIcon.removeClass("active");
        });
    });

/******* end flash mail form ********/
});

