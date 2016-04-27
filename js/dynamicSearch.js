/**
 * Created by Julien on 21-04-16.
 */

$(function() {
    var $cells = $(" .product_title");

    $("#searchProduct").keyup(function() {
        var val = $.trim(this.value).toUpperCase();
        if (val === "") {
            $("#nothing").hide();
            go_to_page(0);
        } else {
            $cells.parent().parent().hide();
            $cells.filter(function() {
                return -1 != $(this).text().toUpperCase().indexOf(val);
            }).parent().parent().show();
            if ( $(".prod_box:visible").length == 0) {
                $("#nothing").show();
            } else {
                $("#nothing").hide();
            }
            pagintest();
        }
    });
});