/**
 * Created by Julien on 27/04/2016.
 */


function recalculate(id) {
    var value = $('#'+id).val();
    var price = $('#price_'+id).html();
    var split = price.split('€');
    var subtotal = value*split[0];
    subtotal = subtotal.toFixed(2);
    var adding = subtotal - split[0];
    var total = $('#total').html();
    var split2 = total.split('€');
    var split3 = split2[0].split('Total : ');
    var newtotal = adding + parseInt(split3[1]);
    newtotal = newtotal.toFixed(2);
    $('#subtotal_'+id).html(subtotal+"€");
    $('#total').html("Total : "+newtotal+"€");
}

function deleteAchat(id, user) {
    $.ajax({
        url: '../Library/Page/Panier.lib.php',
        type: "POST",
        data : {produit : id,
                action : 'delete',
                user : user
        },

    })
    location.reload();

}

function lancerFacture() {
    var achat = {};
    $('input').each(function() {
        achat[$(this).attr("name")] = $(this).val();
    })
    achat['total'] = $('#total').html();
    console.log(achat);

}