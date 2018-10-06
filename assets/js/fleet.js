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
});