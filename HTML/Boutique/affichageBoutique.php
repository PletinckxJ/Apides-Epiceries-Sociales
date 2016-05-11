<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:22
 */

?>
<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />

<?php
if (!isset($_GET['section']) or sectionExistant()) {
    echo "<div class='store'>";
    $newProduct = new Produit(array());
    function tri($a,$b) {
        if ($a->getPromo() == 0 && $b->getPromo() == 1) {
            return 1;
        } else if ($a->getPromo() == 1 && $b->getPromo() == 0) {
            return -1;
        } else {
            return 0;
        }
    }
    uasort($produitList, 'tri');
foreach($produitList as $elem) {
    $prix = round(($elem->getPrixHTVA() + ($elem->getPrixHTVA() * $elem->getTVA()->getCoef())), 2);
    $vente = round_up($prix / 2, 1);
    if ($elem->getId() > $newProduct->getId() && $elem->getProduitActif() == 1) {
        $newProduct = $elem;
        $newProduct->setPrixHTVA($prix);

    }
    if ((!isset($_GET['section']) or  ($elem->getSection()->getId() == $_GET['section'])) and $elem->getProduitActif() == 1) {
        if ($elem->getPromo() == 1) {
            $i = 1;
        } else {
            $i=100;
        }
        echo "<div class='prod_box'  data-listing-price='$i'>";
        echo "<div class='top_prod_box'></div >";
        echo "<div class='center_prod_box' >";
        echo "<div class='product_title' ><a href = 'index.php?page=details&produit=".$elem->getId()."' > " . $elem->getProduit() . " | " . $elem->getPoids() . " </a ></div >";
        echo "<div class='product_img' ><a href = 'index.php?page=details&produit=".$elem->getId()."' ><img src = '../Style/images/produits/" . $elem->getId() . ".png' alt = '' style='max-height:90px;max-width:100px;' border = '0' /></a ></div >";
        echo "<div class='prod_price' ><span class='price' > " . $prix . "€</span ></div >";
        if ($elem->getPromo() == 1 && $elem->getTextePromo() != NULL && $elem->getTextePromo() != "")
        echo "<div class='prod_price' ><span class='price' ><strong> " . $elem->getTextePromo(). "</strong></span ></div >";
        echo "</div >";
        echo "<div class='bottom_prod_box' ></div >";
        echo "<div class='prod_details_tab' > <a id='prod_cart' href='index.php?addtocart=".$elem->getId()."' class='confirmLink' > Commander </a > <a href = 'index.php?page=details&produit=".$elem->getId()."' class='prod_details' > details</a > </div >";
        echo "</div >";
    }

    }
} else {
    header("Location :../Deconnexion");
}
?>
</div>
<div id="dialog" title="Confirmation requise">
    Ajouter ce produit à votre panier ?
</div>



<div id='page_navigation'></div>