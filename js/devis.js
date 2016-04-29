/**
 * Created by Julien on 29/04/2016.
 */


$(function() {
    $('input').change(function() {
        var id = $(this).attr('name');
        var quantity = parseInt($('#quantity_'+id).html());
        if ($(this).val() > quantity) {
            $(this).val(quantity);
        }
        rectification(id);
        });

    });

function rectification(id) {
    var value = $('#'+id).val();
    var price = $('#price_'+id).html();
    var quantity = $('#quantity_'+id).html();
    var split = price.split('€');
    var subtotal = $('#subtotal_'+id).html();
    var splitSub = subtotal.split('€');
    subtotal = (split[0]*value);
    var total = $('#total').html();
    var split2 = total.split('€');
    var split3 = split2[0].split('Total : ');
    var newtotal = 0;
    var diff = 0;
    if (subtotal > splitSub[0]) {
         diff = subtotal - splitSub[0];
        newtotal = parseFloat(split3[1]) + parseFloat(diff);

    } else if (subtotal < splitSub[0]) {
        diff = splitSub[0] - subtotal;
        newtotal = parseFloat(split3[1]) - parseFloat(diff);
    } else {
        newtotal = parseFloat(split3[1]);
    }
    subtotal = subtotal.toFixed(2);
    newtotal = newtotal.toFixed(2);
    $('#subtotal_'+id).html(subtotal+"€");
    $('#total').html("Total : "+newtotal+"€");
}


function lancerCloturation(id) {
    var achat = {};
    $('input').each(function() {
        achat[$(this).attr("name")] = $(this).val();
    });
    console.log(achat, id);
    $.post("../Library/Page/devis.lib.php", {"session" : achat,
                                            "devis" : id});
    $("#tabs").remove();
    $(".facture").append("<iframe src='../Library/Page/Facture.lib.php' width='100%' style='height:1000px'></iframe>");
    $(".facture").append("<div class='facture' style='padding-bottom:2em;'><a href='../Administration/index.php?page=devis' class='btn btn-warning col-sm-6'><i class='fa fa-angle-left'></i> Retourner aux devis</a><a class='btn btn-success col-sm-6' onclick='startCloturation();'>Clôturer la commande <i class='fa fa-angle-right'></i></a></div>");



    //$(".container").remove();
    //$(".facture").append("<iframe src='../Library/Page/Facture.lib.php' width='100%' style='height:1000px'></iframe>");
    //$(".facture").append("<div class='facture' style='padding-bottom:2em;'><a href='../Achat' class='btn btn-warning col-sm-6'><i class='fa fa-angle-left'></i> Retourner au panier</a><a class='btn btn-success col-sm-6' onclick='startCommande();'>Passer commande <i class='fa fa-angle-right'></i></a></div>");

}
