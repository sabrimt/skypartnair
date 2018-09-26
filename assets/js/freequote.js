$(document).ready(function(){
    // current lang
    let pathname = window.location.pathname;
    let path = pathname.split('/');
    let lang = path[2];
    // Efface attribut "name" des champs cachés datepicker (..._submit) pour les étapes
    $('.datepicker.steps ~ input[type="hidden"]').each(function(){
       $(this).attr("disabled", "disabled");
    });
    
    //----------------------
    
    // Gestion des champs au chargement
    let state = 'load';
    let addBtn = $(".fields-add-btn");
    let returnBtn = $(".return-fields-btn");
    
    // Fonction gestion des champs A/R
    let oneWayQuote = function (state) {
        let typeRadioChkd = $('[name="travel-type"]:checked');// Btn radio coché
        
        if(typeRadioChkd.attr("id") === "one-way-quote"){
            $(".arrival-infos").parent().find('input#destination').removeAttr("disabled");
            $(".arrival-infos").find('input').attr("disabled", "disabled");
            
            state !== 'change' ? $(".arrival-infos").hide() : $(".arrival-infos").fadeOut(300); 
        }else{
            state !== 'change' ? $(".arrival-infos").show() : $(".arrival-infos").fadeIn(600);
        }
    };
    // Fonction gestion des champs ALLER/RETOUR
    let returnQuote = function (state){
        let typeRadioChkd = $('[name="travel-type"]:checked');// Btn radio coché
        
        if(typeRadioChkd.attr("id") === "return-quote"){
            $(".arrival-infos").parent().find("input").each(function(){
                $(this).removeAttr("disabled");
            });
        }
    };
    // Fonction gestion des champs MULTI-DESTINATION
    let multiQuote = function (state) {
        let typeRadioChkd = $('[name="travel-type"]:checked');// Btn radio coché
        
        if(typeRadioChkd.attr("id") === "multi-quote"){
            // désactiver tous les input cachés
            let HiddenMultis = $('.multi-fields[style="display: none;"]');
            HiddenMultis.find('input').each(function(){
                $(this).attr("disabled", "disabled");
            });
            
            
            $(".arrival-infos").parent().find('input').removeAttr("disabled");
            if(!$('.return-fields-btn').hasClass('remove-btn')){
                state !== 'change' ? $(".arrival-infos").parent().hide() : $(".arrival-infos").parent().slideUp(300);
                $(".arrival-infos").parent().find('input').attr("disabled", "disabled");
            }

            let firstStep = $(".multi-fields").first();

            if (!firstStep.hasClass('visible-fields')){
                firstStep.addClass('visible-fields');
            }

            // Remplis les "name" des champs affichés
            $(".multi-fields.visible-fields").each(function(){

                $(this).find("input").each(function(){
                    $(this).removeAttr("disabled");
                });
            });

            //Retire l'heure et date de la derniere etape 
            let lastStep = $('.multi-fields.visible-fields').last();
            lastStep.find('.date-time-infos').hide();
            lastStep.find('.date-time-infos').find('input').each(function(){
                $(this).attr("disabled", "disabled");
            });
            
            // Affiche le bouton de suppression d'étape
            $('.multi-fields.visible-fields').find('.remove-step-btn').hide();
            lastStep.find('.remove-step-btn').fadeIn(800);
            
            state !== 'change' ? $('.multi-fields.visible-fields').show() : $('.multi-fields.visible-fields').delay(100).fadeIn(600);

            addBtn.delay(300).fadeIn(700);
            returnBtn.delay(300).fadeIn(700); 
            
            // Gestion Btn champs vol retour
            $('input#departure').on("change", function (){
                $('input#destination').val($(this).val());
                $('label.destination').addClass('active');
            });
            $('input#destination').on("focus", function (){
                $('input#departure').focus();
                $(this).val($('input#departure').val());
            });
            
            if(!$('.return-fields-btn').hasClass('remove-btn')){
                $('.return-fields-btn').find('i.material-icons').html('&#xE145;');// icon add
            }else{
                $('.return-fields-btn').find('i.material-icons').html('&#xE15B;');// icon remove
            }

            
            let stepNb = $('.multi-fields.visible-fields').length;// variable compteur pour ajout d'etape
        } else {
            
            state !== 'change' ? $(".multi-fields").hide() : $(".multi-fields").slideUp(300);
            $(".multi-fields input").attr("disabled", "disabled");
            state !== 'change' ? $(".arrival-infos").parent().show() : $(".arrival-infos").parent().delay(100).fadeIn(600);
            addBtn.fadeOut(200);
            returnBtn.fadeOut(200);
            
            // Retire le comportement des champs départ et destination
            $('input#departure').off("change");
            $('input#destination').off("focus");
        }
    };
    
    oneWayQuote(state);
    returnQuote(state);
    multiQuote(state);
    
    // Gestion des btns radio et champs dans devis au changement
    $('[name="travel-type"]').change(function(){
        state = 'change';
        
        oneWayQuote(state);
        returnQuote(state);
        multiQuote(state);
        
    });
    
    
    addBtn.click(function(){
        let HiddenMultis = $('.multi-fields[style="display: none;"]');
        let stepNb = $('.multi-fields.visible-fields').length;// variable compteur pour ajout d'etape
        if(HiddenMultis.length !== 0) {
            stepNb++;
            let fieldsContainer = HiddenMultis.first();
            let inputFields = fieldsContainer.find("input#step_"+stepNb).parent().parent().find("input");
            
            inputFields.each(function(){
                $(this).removeAttr("disabled");
            });

            //Retablit l'heure et date de l'avant-derniere etape 
            let lastStep = $('.multi-fields.visible-fields').last();
            lastStep.find('.date-time-infos').fadeIn(800);
            
            lastStep.find(".date-time-infos input").each(function(){
                $(this).removeAttr("disabled");
            });

            fieldsContainer.addClass("visible-fields");

            //Retire l'heure et date de la derniere etape 
            $('.multi-fields.visible-fields').last().find('.date-time-infos').hide();
            $('.multi-fields.visible-fields').last().find('.date-time-infos').find('input').each(function(){
                $(this).attr("disabled", "disabled");
            });

            fieldsContainer.fadeIn(800);
            
            // Affiche le bouton de suppression d'étape
            $('.multi-fields.visible-fields').find('.remove-step-btn').hide();
            fieldsContainer.find('.remove-step-btn').fadeIn(800);
        } else {
            $(this).css("cursor", "default");
        }
    });
    
    // Gestion Btn champs vol retour
    $('.return-fields-btn').click(function(){
        let $this = $(this);
        if(!$this.hasClass('remove-btn')){
            $this.find('i.material-icons').html('&#xE15B;'); // icon remove
            $(".arrival-infos").parent().slideDown(600);
            
            // Remplis les "name" des champs affichés
            $(".arrival-infos").parent().find("input").each(function(){
                $(this).removeAttr("disabled");
            });
            
            $this.addClass('remove-btn');
        } else {
            $this.find('i.material-icons').html('&#xE145;');// icon add
            $(".arrival-infos").parent().slideUp(300);
            $(".arrival-infos").parent().find('input').attr("disabled", "disabled");
            
            $this.removeClass('remove-btn');
        }
    });
    
    // Gestion Btn supprimer étape
    $(".remove-step-btn").click(function(){
        let $this = $(this);
        $this.parent().parent().parent().slideUp(500);
        $this.parent().parent().parent().removeClass("visible-fields");
        $this.parent().parent().parent().find('input').attr("disabled", "disabled");
        //Retire l'heure et date de la derniere etape
        let prevStep = $('.multi-fields.visible-fields').last();
        prevStep.find('.date-time-infos').hide();
        prevStep.find('.date-time-infos').find('input').each(function(){
            $(this).attr("disabled", "disabled");
        });
        
        // Affiche le bouton de suppression d'étape
        $('.multi-fields.visible-fields').find('.remove-step-btn').hide();
        prevStep.find('.remove-step-btn').fadeIn(800);
        
    });
    
    // Gestion civilité Nom / Société
    let genderTypeSwitch = function(){
        let comLbl = lang === 'fr' ? 'Société' : 'Company';
        let nameLbl = lang === 'fr' ? 'Nom' : 'Last name';
        if($('.gender-name-fields [name="gender"]').val() === 'Sté'){
            $('.gender-name-fields #first-name').parent().hide();
            $('.gender-name-fields #first-name').attr("disabled", "disabled");
            $('.gender-name-fields #name + label').text(comLbl);
        }else {
            $('.gender-name-fields #first-name').parent().show();
            $('.gender-name-fields #first-name').removeAttr("disabled");
            $('.gender-name-fields #name + label').text(nameLbl);
        }
        $('.gender-name-fields [name="gender"]').change(function(){
            if($(this).val() === 'Sté'){
                $('.gender-name-fields #first-name').parent().fadeOut(800);
                $('.gender-name-fields #first-name').attr("disabled", "disabled");
                $('.gender-name-fields #name + label').text(comLbl);
            }else {
                $('.gender-name-fields #first-name').parent().fadeIn(400);
                $('.gender-name-fields #first-name').removeAttr("disabled");
                $('.gender-name-fields #name + label').text(nameLbl);
            }
        });
    };
    genderTypeSwitch();
    
    
/***** SETS DATE PICKER'S MIN PROPERTY ON PREVIOUS DATE PICKER'S VALUE *****/
    let pickers = $('.datepicker');
   
    pickers.each(function(){
        let $this = $(this);
        let $thisPicker = $this.pickadate().pickadate('picker');
                
        $thisPicker.on('close', function(){
            let $thisPos = pickers.index($this);
            let pickersNext = $('.datepicker:gt('+ $thisPos +')');
            let pickVal = $thisPicker.get('select', 'yyyy/mm/dd');
            
            pickersNext.each(function(){
                let $this = $(this);
                if(pickVal !== ''/* && pickVal > $this.pickadate().pickadate('picker').get('min', 'yyyy/mm/dd')*/){
                    $this.pickadate().pickadate('picker').set('min', $thisPicker.get());
                }

                // Set date to minimum if min > selected
                if($this.pickadate().pickadate('picker').get('select', 'yyyy/mm/dd').length > 0){
                    let inpVal = new Date($this.pickadate().pickadate('picker')._hidden.value).getTime();
                    let minVal = $this.pickadate().pickadate('picker').get('min').pick;
                    
                    if(inpVal < minVal){
                        $this.pickadate().pickadate('picker').set('clear');
                    }
                }
            });
        });
    });
    // Set min on load
    let fullPick = $('.datepicker').filter(function() { return $(this).val() !== ""; });
    if(fullPick.length !== 0){
        let fPickPos = pickers.index(fullPick.last());
        let fPickVal = fullPick.last().pickadate().pickadate('picker').get();
        // set empty pickdates min
        $('.datepicker:gt('+ fPickPos +')').each(function(){
            $(this).pickadate().pickadate('picker').set('min', fPickVal);
        });
        // !empty pickdates min
        for(var i = 0; i < fPickPos; i++){
            let $val = fullPick.eq(i).pickadate().pickadate('picker').get();
            let $nextInp = fullPick.eq(i+1).pickadate().pickadate('picker');
            $nextInp.set('min', $val);
        }
    }
/***** date picker's MIN PROPERTY setting *****/
    
    
    // A la validation du formulaire
    $('form#free-quote-form').submit(function(){

        // Enregistre le nbre d'étapes dans le bouton submit
        $(this).find('button[type="submit"][name="save"]').val($('.multi-fields.visible-fields').length);

    });
    
     

});