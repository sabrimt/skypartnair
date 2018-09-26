/*============= CUSTOM PICKADATE ===============*/

// current lang
let pathname = window.location.pathname;
let path = pathname.split('/');
let lang = path[2];

if(lang == 'fr'){
    // PickDate FR
    jQuery.extend( jQuery.fn.pickadate.defaults, {

        selectMonths: true, // Creates a dropdown to control month
        selectYears: 5, // Creates a dropdown of 15 years to control year

        monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
        monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
        weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
        weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
        weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
        today: '',
        clear: 'Effacer',
        close: 'Fermer',
        labelMonthNext:"Mois suivant",
        labelMonthPrev:"Mois précédent",
        labelMonthSelect:"Sélectionner un mois",
        labelYearSelect:"Sélectionner une année"
    });
}
$(document).ready(function() {
    $('.datepicker').pickadate({
        // Rend impossible la sélection avant today
        min:'true',

        // == Format envoyé en back
        formatSubmit: "yyyy-mm-dd",
        // == 

        // Ferme le DP après la selection
        onSet: function(action) {
            if('select' in action){
                this.close();
            }
        }
    
    });
    
    // SETS TO_DATE PICKER'S MIN PROPERTY ON FROM_DATE VALUE
    var picker1 = $('#from_date').pickadate().pickadate('picker');
    var picker2 = $('#to_date').pickadate().pickadate('picker');

    if(picker1 !== undefined){
        picker1.on('set', function() {
            picker2.set('min', picker1.get());
        });
    }
    
    
/***************  TIMEPICKER  *****************/

  $('.timepicker').pickatime({
    default: '', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: true, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
});
