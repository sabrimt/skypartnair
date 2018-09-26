/*******    JS BACK-OFFICE    ********/

$(document).ready(function() {

    // SIDE NAVBAR SETTINGS
    // Définition de la variable cOc en fonction de la taille d'écran

    if(document.body.clientWidth < 992){
        var cOc = true;
    }else{
        var cOc = false;
    }

    $('.button-collapse').sideNav({
        menuWidth: 300, // Default is 300
        edge: 'left', // Choose the horizontal origin
        closeOnClick: cOc, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true, // Choose whether you can drag to open on touch screens
    });


    // EFFECTS ON SCROLLFIRE => form fadeIn

    var options = [
        {
            selector: 'form.appear-form',
            offset: 200,
            callback: function(el) {
                Materialize.fadeInImage($(el));
            }
        }
    ];

    Materialize.scrollFire(options);


    /**** FOTOS COLLAPSE IN FLEET FORM/BLOG FORM ****/
    $(".photos-collapse").click(function(e){
        e.preventDefault();
        if($(".photos-formbloc").css("display") === "block"){
            $(".photos-formbloc").slideUp(300);

            $(".photos-collapse").html('Photos <i class="material-icons">&#xE5C5;</i>');

        } else {
            $(".photos-formbloc").slideDown(500);

            $(".photos-collapse").html('Photos <i class="material-icons">&#xE5C7;</i>');
        }
    });
    
    
    /******** USER SUBMIT INPUT ON CHANGE ********/
    
    let $checkBtn = $(".role-check-btn");
    $checkBtn.change(function(){
        
        let $modBtns = $('button.check-submit.modified');
        let $chck = $modBtns.parents('form.role-switch').find('.role-check-btn');
        
        let $currentCheck = $(this);
        let $currentSubmit = $currentCheck.parents('form.role-switch').find('button.check-submit');
        
        $chck.trigger("click");
         
        $currentSubmit.toggleClass("modified");
    });
});