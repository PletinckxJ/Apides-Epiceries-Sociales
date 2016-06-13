/**
 * Created by JulienTour on 13/06/2016.
 */
$(function () {
    $("#tabs").tabs();
});
$.datepicker.setDefaults(
    {
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Pr�c�dent',
        firstDay : 1,
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'F�vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao�t', 'Septembre', 'Octobre', 'Novembre', 'D�cembre'],
        monthNamesShort: ['Janv.', 'F�vr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Ao�t', 'Sept.', 'Oct.', 'Nov.', 'D�c.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'yy-mm-dd'
    }
);
$(function(){
    $('#datepicker').datepicker({showAnim: "fadeIn"});
})