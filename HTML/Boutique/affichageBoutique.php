<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:22
 */


$pm = new ProduitManager(connexionDb());
$produitList = $pm->getAllProduit();

foreach($produitList as $elem) {
    $prix = round(($elem->getPrixHTVA() + ($elem->getPrixHTVA()* $elem->getTVA()->getCoef())), 2);
    $vente = round($prix/2,1);
    echo "<div class='prod_box' >";
    echo "<div class='top_prod_box'></div >";
    echo "<div class='center_prod_box' >";
        echo "<div class='product_title' ><a href = 'details.html' > ".$elem->getProduit()." | ".$elem->getPoids()." </a ></div >";
        echo "<div class='product_img' ><a href = 'details.html' ><img src = '../Style/images/produits/".$elem->getId().".png' alt = '' style='max-height:90px;max-width:100px;' border = '0' /></a ></div >";
        echo "<div class='prod_price' ><span class='price' >".$vente."</span ></div >";
    echo "</div >";
    echo "<div class='bottom_prod_box' ></div >";
    echo "<div class='prod_details_tab' > <a href = '#' title = 'header=[Add to cart] body=[&nbsp;] fade=[on]' ><img src = '../Style/images/cart.gif' alt = '' border = '0' class='left_bt' /></a > <a href = '#' title = 'header=[Specials] body=[&nbsp;] fade=[on]' ><img src = '../Style/images/favs.gif' alt = '' border = '0' class='left_bt' /></a > <a href = '#' title = 'header=[Gifts] body=[&nbsp;] fade=[on]' ><img src = '../Style/images/favorites.gif' alt = '' border = '0' class='left_bt' /></a > <a href = 'details.html' class='prod_details' > details</a > </div >";
echo "</div >";

}
?>
