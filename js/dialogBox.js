/**
 * Created by Julien on 22/04/2016.
 */
$(document).ready(function() {
    $("#dialog").dialog({
        autoOpen: false,
        modal: true
    });
});

$(".confirmLink").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Je l'ajoute" : function() {
                window.location.href = targetUrl;
            },
            "Non, je ne veux pas" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});