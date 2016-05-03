/**
 * Created by Julien on 29/04/2016.
 */


$(function() {
    $('input').change(function() {
        var id = $(this).attr('name');
        var grade = $(this).attr('grade');
        var quantity = parseInt($('#quantity_'+id).html());
        if ($(this).val() > quantity && grade != 3) {
            $(this).val(quantity);
        } else if ($(this).val() == 0) {
            $(this).val(1);
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
    $(".facture").append("<object data='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' ><embed src='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' /> </object>");
    $(".facture").append("<div class='facture' style='padding-bottom:2em;'><a href='../Devis/index.php?id="+id+"' class='btn btn-warning col-sm-6'><i class='fa fa-angle-left'></i> Retourner au devis</a><a class='btn btn-success col-sm-6' onclick='startCloturation();'>Finir la procédure <i class='fa fa-angle-right'></i></a></div>");
}

function startCloturation() {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            action : 'devis'
        },
        success:function (data) {
            console.log(data);
            window.location.href = data;
        }

    });


}