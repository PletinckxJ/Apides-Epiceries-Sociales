/**
 * Created by Julien on 22/04/2016.
 */
$(document).ready(function() {
    $("#dialog").dialog({
        autoOpen: false,
        modal: true
    });
    $("#dialog2").dialog({
        autoOpen: false,
        modal: true
    });
    $("#dialog3").dialog({
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
                targetUrl = targetUrl + $("input#quant").val();
                window.location.href = targetUrl
            },
            "Non, je ne veux pas" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmLink").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui" : function() {
                lancerFacture();
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmLivraison").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui": function() {
                lancerLivraison(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmFinal").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui": function() {
                lancerFinal(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmAchat").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui": function() {
                lancerAchat(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmTransfer").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui": function() {
                transferFav(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});
$("#deleteDevis").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog3").dialog({
        buttons : {
            "Oui": function() {
                deleteDevis(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog3").dialog("open");
});
$("#confirmClot").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
        buttons : {
            "Oui": function() {
                lancerCloturation(targetUrl);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
});

$("#confirmSuppr").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");
    var prod = $(this).attr("produit");
    var devis = $(this).attr("devis");

    $("#dialog2").dialog({
        buttons : {
            "Oui" : function() {

                deleteProduit(prod, devis);
                $(this).dialog("close");
            },
            "Non" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog2").dialog("open");
});