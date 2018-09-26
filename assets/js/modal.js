/* 
 * MODAL FOR ARTICLE BLOG PREVIEW 
 */

//
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal;
//    var now = new Date();
//    var annee = now.getFullYear();
//    var mois = now.getMonth();
//    var jour = now.getDate();
    
    $('.previewbtn').on("click", function() {
        tinyMCE.triggerSave(true, true);
        $("#h1_modal").text($("#title_fr").val());
        $("#picture1_modal").text($("#picture_1").val());
        $("#h1_modal_en").text($("#title_en").val());
        $("#p_content_fr").html($("#content_fr").val());
        $("#p_content_en").html($("#content_en").val());
        
        // The selected value (database id)
        let selectedValue = $("#categorie").val();
        // The option tag who gets the value : selectedValue
        let selectedOption = $(".cat-option[value="+selectedValue+"]");
        // The selectedOption's "data-olive" value or default text
        let catValue = selectedOption.attr("data-olive") !== undefined ? selectedOption.attr("data-olive") : "\"catégorie\"";

        // Send the selectedOption's "data-olive" value into the modal
        $("#h4_categorie").text(catValue);
        $("#h4_categorie_en").text(catValue);
    });
    
$('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
  });
   });
  
      