/**
 * Created by Julien on 13/05/2016.
 */

function transferFav(id) {
    $.ajax({
        url : "../Library/Page/produits.lib.php",
        type : "POST",
        data : {
            user : id
        },
        success:function(data) {
            window.location.href = '../Produits';
        }
    })

}

function deleteFav(produit, user) {
    $.ajax({
        url : "../Library/Page/produits.lib.php",
        type : "POST",
        data : {
            prod : produit,
            produser : user,
            action : 'remove'
        },
        success:function(data) {
            window.location.reload(true);
        }

    })
}