/**
 * Created by Julien on 29/04/2016.
 */


$(function() {
    $('input').change(function() {
        var id = $(this).attr('name');
        if (id != null) {
            var grade = $(this).attr('grade');
            var quantity = parseInt($('#quantity_' + id).html());
            if ($(this).val() > quantity && grade != 3) {
                $(this).val(quantity);
            } else if ($(this).val() == 0) {
                $(this).val(1);
            }
            rectification(id);
        }
        });

    });

$(function() {
    $('#datepicker').change(function() {
        var date = $(this).val();
        var devis = $(this).attr('devis');
        $.ajax({
            url: "../Library/Page/devis.lib.php",
            type: "POST",
            data: {
                dateLivr: date,
                dateDev: devis
            },
            success: function (data) {
                console.log(data);
            }
        });
    });
});
$(function() {
    $('textarea#note').change(function() {
        var val = $(this).val();
        var devis = $(this).attr('devis');
        $.ajax({
            url : "../Library/Page/devis.lib.php",
            type : "POST",
            data : {
                note : val,
                noteDev : devis
            },
            success:function(data) {

            }
        })
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

function deleteProduit(id, devis) {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {produit : id,
            action : 'delete',
            devis : devis
        },
        success:function (data) {
            console.log(data);
            if (data == 'deleted') {
                window.location.href = "../Commande";
            } else {
                if (data == "go") {
                    window.location.reload(true);
                }


            }
        }

    });


}

function lancerCloturation(id) {
    var achat = {};
    $('input').each(function() {
        if ($(this).val() != "" && $(this).attr('id') != 'datepicker' && $(this).attr('name') != "note") {
            achat[$(this).attr("name")] = $(this).val();
        }
    });
    console.log(achat, id);
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            session : achat,
            devis : id
        }
    });
    $.post("../Library/Page/devis.lib.php", {"session" : achat,
                                            "devis" : id});
    setTimeout(350);
    $("#tabs").remove();
    $(".facture").append("<object data='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' ><embed src='../Library/Page/Facture.lib.php' type='application/pdf' height='1000' width='1000' /> </object>");
    $(".facture").append("<div class='facture' style='padding-bottom:2em;'><a href='../Devis/index.php?id="+id+"' class='btn btn-warning col-sm-6'><i class='fa fa-angle-left'></i> Retourner au devis</a><a class='btn btn-success col-sm-6' onclick='startCloturation();'>Finir la procédure <i class='fa fa-angle-right'></i></a></div>");
}

function lancerAchat(id) {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            action : 'achat',
            devis : id
        },
        success:function () {
            window.location.reload(true);

        }
    })
}

function lancerLivraison(id) {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            action : 'livraison',
            devis : id
        },
        success:function () {
            window.location.reload(true);

        }
    })
}
function lancerFinal(id) {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            action : 'final',
            devis : id
        },
        success:function () {
            window.location.reload(true);

        }
    })
}

function addProduit(devis) {
    var name = $('input#prod').val();
    var prod;
    if (name.trim()) {
        $.ajax({
            url: '../Library/Page/devis.lib.php',
            type: "POST",
            data : {
                action : 'add',
                name : name,
                devis : devis
            },
            success:function (data) {
                console.log(data);
                window.location.reload(true);

            }

        });
    }
}
$(function() {
    $("input#prod").bind("keyup blur",function(event) {
        var source;
        var val = $(this).val();
        $.ajax({
            url: '../Library/Function/prodList.php',
            type: "POST",
            success:function (data) {
                source = JSON.parse(data);
                var arr = $.map(source, function(el) { return el});
                if (jQuery.inArray(val,arr) == -1) {
                    $("button#addprod").prop('disabled', true);
                    document.getElementById("prod").style.borderColor = "#E34234";
                } else {
                    $("button#addprod").prop('disabled', false);
                    document.getElementById("prod").style.borderColor = "#00FF00";
                }
            }

        });


    });
});

function deleteDevis(devis) {
    $.ajax({
        url: '../Library/Page/devis.lib.php',
        type: "POST",
        data : {
            action : 'deleteDevis',
            devis : devis
        },
        success:function (data) {
            console.log(data);
            if (data == "user") {
                window.location.href = "../Commande";
            } else if (data = "admin") {
                window.location.href = "../Administration/index.php?page=devis";
            }
        }

    });

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