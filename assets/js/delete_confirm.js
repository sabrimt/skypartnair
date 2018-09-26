/*
****************************************************
**********   CONFIRM DELETE DIALOG BOX   ***********
****************************************************
*/
$(document).ready(function() {
    
    $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: 0.3, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '17%', // Ending top style attribute
    });
  
    let btn = $(".confirm-delete-btn");
//    let confirmBox = $(".cd-popup");
    btn.on("click", function(event){
        
        event.preventDefault();
        currentBtn = $(this);
        
        $('#confirm-modal').modal('open');
        let modalDel = $("#del-confirm-btn");
        modalDel.attr('href', currentBtn.attr("data-link"));

        let modalCan = $("#del-cancel-btn");
        modalCan.on("click", function(e){
            e.preventDefault();
            
            $('#confirm-modal').modal('close');
        });
    });
    
    
    /******* ACTION BUTTONS DISPLAY *******/
    $(".list-elt").hover(function(){
       $(".action-btn", this).removeClass("btn-display");
    }, function(){
        $(".action-btn", this).addClass("btn-display");
    });
    /******* Action buttons display *******/
    
});