<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 08:48
 */
?>
<div class="shopping_cart">
    <div class="cart_title">Panier</div>
    <?php
    $am = new AchatManager(connexionDb());
    $tabAchat = $am->getAllAchatFromUser($_SESSION['Utilisateur']);
    $somme = 0;
    /**foreach ($tabAchat as $elem) {
    $prod = $elem->getProduit();
    $somme = $somme + round(($prod->getPrixHTVA() + ($prod->getPrixHTVA() * $prod->getTVA()->getCoef())),2);
    }*/
    echo "<div class='cart_details'> ".count($tabAchat)." produits <br />";
    ?>
    <span class="border_cart"></span><a <?php if (count($tabAchat) > 0) echo "href='../Achat'"; ?> style="color:red"> Passer commande </a></div>
<div class="cart_icon"><a <?php if (count($tabAchat) > 0) echo "href='../Achat'"; ?> title="header=[Voir le panier] body=[&nbsp;] fade=[on]"><img src="../Style/images/shoppingcart.png" alt="" width="48" height="48" border="0" /></a></div>
</div>
<?php
$pm = new ProduitManager(connexionDb());
$tabFav = $pm->getFavoris($_SESSION['Utilisateur']->getId());
if (count($tabFav) > 0) {
    ?>

<div class="shopping_cart" style="margin-top:5px">
    <div class="cart_title">Favoris</div>
    <?php
    $pm = new ProduitManager(connexionDb());
    $tabFav = $pm->getFavoris($_SESSION['Utilisateur']->getId());
    $somme = 0;
    /**foreach ($tabAchat as $elem) {
    $prod = $elem->getProduit();
    $somme = $somme + round(($prod->getPrixHTVA() + ($prod->getPrixHTVA() * $prod->getTVA()->getCoef())),2);
    }*/
    echo "<div class='cart_details'> ".count($tabFav)." produits <br />";
    ?>
    <span class="border_cart"></span><a <?php if (count($tabAchat) > 0) echo "href='../Produits/index.php?page=favoris'"; ?> style="color:red"> Voir mes favoris</a></div>
<div class="cart_icon"><a <?php if (count($tabFav) > 0) echo "href='../Produits/index.php?page=favoris'"; ?> title="header=[Voir mes favoris] body=[&nbsp;] fade=[on]"><img src="../Style/images/bookmarks.png" alt="" width="48" height="48" border="0" /></a></div>
</div>
<?php } ?>