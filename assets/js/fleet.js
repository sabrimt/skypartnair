$(document).ready(function(){
    
    /******** FILTER FORM ********/
    $('.filter-btn h4 span').click(function(){
        $('#fleet-filter-form').toggleClass('visible');
    });
    
    $('.input-change-elt').change(function(){
        $('#fleet-filter-form').submit();
    });
    /******** END filter form ********/

    /****  AJAX  ****/
    $("#fleet-filter-form").submit(function(event) {
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: window.location.pathname,
            data: $(this).serialize(),
            success: function(msg) {
                $("#fleet-list-ajax").html(msg).fadeIn(300);
            }
        });
        return false;
    });
    /****  END ajax  ****/

    /*** Aircraft Details Lightbox ***/
    var $imgLinks = $('.custom-tabs .tab a'),
        $photos = $('.photo-card');

    $imgLinks.click(function(e) {
        e.preventDefault();
        var $target = $($(e.currentTarget).attr('href'));
        $photos.hide(0);

        $('.custom-tabs .tab').removeClass('active');
        $(e.currentTarget).parent().addClass('active');
        $target.fadeIn(500);
    });
    /**** END Aircraft Details Lightbox ****/
});