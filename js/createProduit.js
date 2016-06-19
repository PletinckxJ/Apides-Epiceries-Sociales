/**
 * Created by JulienTour on 15/06/2016.
 */


$(document).click(function(event) {
    var x = window.scrollX, y = window.scrollY;
    if (event.target.nodeName != "INPUT" && event.target.nodeName != "LABEL" && event.target.nodeName != "STRONG" && event.target.nodeName != "SELECT" && event.target.nodeName != "BUTTON" && event.target.id != "radio") {
        $("input#scanner").focus();
    }
    window.scrollTo(x, y);
});
function getprod() {
    var val = $("input#code").val();
    var cache;
    if (val != "" && val != null) {
        $.ajax({
            url: "../Library/Function/getProduit.php",
            type :  "POST",
            data: {
                valeur: val
            },
            success: function (data) {
                if (data != "" && data != null) {
                    $.ajax({
                        url: "../Form/modifyProduit.form.php",
                        type: "POST",
                        data: {
                            id: data
                        },
                        success: function (output) {
                            test = output;
                            $("div#formcontent").html(output);
                            $("div.center_title_bar").html("Modification d'un produit existant");
                        }
                    });
                }
            }
        });

    } else {
        $.ajax({
            url: "../Form/createProduit.form.php",
            type: "POST",
            data: {
                action: "cherche"
            },
            success: function (output) {
                $("div.pageCrea").html(output);
                $("div.center_title_bar").html("Création d'un produit");
            }
        });
    }
}
function decode(input) {
    var scan = input;
    $("input#scanner").val("");
    if (scan != null && scan != "") {
        $.ajax({
            url: "../Library/Function/IRISPen.php",
            type: "POST",
            data: {
                result : scan
            },
            dataType : "json",
            success: function (data) {
                if (data[1] != null && data[1] != "" && data[0] != null && data[0] != "" && data[2] != null && data[2] != "") {
                    $("input#code").val(data[1]);
                    $("input#name").val(data[2]);
                    if (data[0] == "A" || data[0] == "a") {
                        $('select#tva option[value="3"]').prop('selected', true);
                    } else if (data[0] == "C" || data[0] == "c") {
                        $('select#tva option[value="2"]').prop('selected', true);
                    }
                    if (data[3] != null && data[3] != "") {
                        $("input#poids").val(data[3]);
                    }
                    getprod();
                }
            }
        })
    }
}