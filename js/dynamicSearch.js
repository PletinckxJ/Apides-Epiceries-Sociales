/**
 * Created by Julien on 21-04-16.
 */

$(function () {
    var $cells = $(" .product_title");
    var i = 0;
    $("#searchProduct").keyup(function () {
        i = 0;
        var val = $.trim(this.value).toUpperCase();
        if (val === "") {
            $("#nothing").hide();
            $("#navig").show();
            go_to_page(0);
        } else {
            $cells.parent().parent().hide();

            $cells.filter(function () {
                if ($(this).text().toUpperCase().indexOf(val) != -1) {
                    i++;
                }
                return (-1 != $(this).text().toUpperCase().indexOf(val) && i <= 9);
            }).parent().parent().show();
            $("#navig").hide();

            if ($(".prod_box:visible").length == 0) {
                $("#nothing").show();
            } else {
                $("#nothing").hide();
            }
        }
    });
});