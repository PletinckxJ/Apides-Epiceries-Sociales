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
foreach($produitList as $elem) {
    $prix = round(($elem->getPrixHTVA() + ($elem->getPrixHTVA() * $elem->getTVA()->getCoef())), 2);
    $vente = round($prix / 2, 1);
    if ($elem->getId() > $newProduct->getId()) {
        $newProduct = $elem;
        $newProduct->setPrixHTVA($prix);

    }
    if ((!isset($_GET['section']) or  ($elem->getSection()->getId() == $_GET['section'])) and $elem->getProduitActif() == 1) {

        echo "<div class='prod_box' >";
        echo "<div class='top_prod_box'></div >";
        echo "<div class='center_prod_box' >";
        echo "<div class='product_title' ><a href = 'details.php?produit=".$elem->getId()."' > " . $elem->getProduit() . " | " . $elem->getPoids() . " </a ></div >";
        echo "<div class='product_img' ><a href = 'details.php?produit=".$elem->getId()."' ><img src = '../Style/images/produits/" . $elem->getId() . ".png' alt = '' style='max-height:90px;max-width:100px;' border = '0' /></a ></div >";
        echo "<div class='prod_price' ><span class='price' > " . $prix . "€</span ></div >";
        echo "</div >";
        echo "<div class='bottom_prod_box' ></div >";
        echo "<div class='prod_details_tab' > <a id='prod_cart' href='index.php?addtocart=".$elem->getId()."' class='confirmLink' > Commander </a > <a href = 'details.php?produit=".$elem->getId()."' class='prod_details' > details</a > </div >";
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