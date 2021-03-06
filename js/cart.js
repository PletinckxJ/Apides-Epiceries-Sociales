/**
 * Created by Julien on 27/04/2016.
 */

$(function() {
    $('input').bind("change keyup",(function() {
        var id = $(this).attr('name');
        var max = $(this).attr('max');
        var groupement = $(this).attr('groupement');
        if ($(this).val() > parseInt(max)) {
            $(this).val(parseInt(max));
        } else if ($(this).val() == 0) {
            $(this).val(1);
        }
        if ($(this).val() %groupement == 0) {
            document.getElementById(id).style.borderColor = "#00FF00";
        } else {
            document.getElementById(id).style.borderColor = "#FFAF0A";
        }
        recalculate(id);
    }));

});

$(function() {
    $('input').each(function() {
        recalculate($(this).attr('name'));
        var groupement = $(this).attr('groupement');
        var id = $(this).attr('name');
        if ($(this).val()%groupement == 0) {
            document.getElementById(id).style.borderColor = "#00FF00";
        } else {
            document.getElementById(id).style.borderColor = "#FFAF0A";
        }
    });
});



function recalculate(id) {
    var value = $('#'+id).val();
    var price = $('#price_'+id).html();
    var ancientsub = $('#subtotal_'+id).html();
    var splitSub = ancientsub.split('�');
    var split = price.split('�');
    var subtotal = value*split[0];
    var total = $('#total').html();
    var split2 = total.split('�');
    var split3 = split2[0].split('Total : ');
    var newtotal = 0;
    var diff = 0;
    if (subtotal > splitSub[0]) {
        diff = subtotal - splitSub[0];
        newtotal = parseFloat(split3[1]) + parseFloat(diff);

    } else if (subtotal < splitSub[0]) {
        diff = splitSub[0] - subtotal;
        newtotal = parseFloat(split3[1]) - parseFloat(diff);
    }else {
        newtotal = parseFloat(split3[1]);
    }
    subtotal = subtotal.toFixed(2);
    newtotal = newtotal.toFixed(2);
    $('#subtotal_'+id).html(subtotal+"�");
    $('#total').html("Total : "+newtotal+"�");
}

function deleteAchat(id, user) {
    $.ajax({
        url: '../Library/Page/Panier.lib.php',
        type: "POST",
        data : {produit : id,
                action : 'delete',
                user : user
        }


    });
    setTimeout(function() {
        location.reload();
    },350);

}

function lancerFacture() {
    var achat = {};
    $('input').each(function() {
        achat[$(this).attr("name")] = $(this).val();
    });
    var note = $('textarea#note').val();
    $.ajax({
       url :  "../Library/Page/Panier.lib.php",
        type : "POST",
        data: {
            session : achat,
            noteDevis : note
        },
        success:function(data) {
            console.log(data);
        }
    });
    console.log(achat,note);
    setTimeout(100);
    $(".container").remove();
    $(".facture").append("<object data='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' ><embed src='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' /> </object>");
    $(".facture").append("<div class='facture' style='padding-bottom:2em;'><a href='../Achat' class='btn btn-warning col-sm-6'><i class='fa fa-angle-left'></i> Retourner au panier</a><a class='btn btn-success col-sm-6' onclick='startCommande();'>Passer commande <i class='fa fa-angle-right'></i></a></div>");

}

function startCommande() {
    $.ajax({
        url: '../Library/Page/Panier.lib.php',
        type: "POST",
        data : {
            action : 'devis'
        },
        success:function (data) {
            console.log(data);
        }

    });
    setTimeout(function() {
    window.location.href = "../Commande";
    },350);

}