<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 25/04/2016
 * Time: 09:47
 */

$produit = $pm->getProduitById($_GET['produit']);
$prix = round(($produit->getPrixHTVA() + ($produit->getPrixHTVA() * $produit->getTVA()->getCoef())), 2);
$vente = round_up($prix / 2, 1);
if ($produit->getDLV() != NULL && $produit->getDLV() != "") {
    $dlv = $produit->getDLV();
} else {
    $dlv = "Aucune";
}

if ($produit->getProduitActif() == 1) {
    $stock = "En Stock";
} else {
    $stock = "Aucun en stock";
}
$id = 0;
$listSimilar = array();

foreach ($produitList as $elem) {
    if ($elem->getId() > $id && $elem->getProduitActif() == 1) {

        $newProduct = $elem;
        $id = $elem->getId();
    }
    if ($elem->getSection()->getId() == $produit->getSection()->getId() && $produit->getId() != $elem->getId() && $elem->getProduitActif() == 1) {
        $listSimilar[] = $elem;
    }
}

?>

    <div class="center_title_bar"><?php echo $produit->getProduit(); ?></div>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <div class="product_img_big"> <img style="max-height:300px; max-width:180px;" src="../Style/images/produits/<?php echo $produit->getId() .".png" ?>" alt="" border="0" />
            </div>
            <div class="details_big_box" style="padding-left:2em; padding-top : 1em;">
                <div class="product_title_big"><?php echo $produit->getProduit(); ?></div>
                <div class="specifications"> Disponibilité : <span class="blue"><?php echo $stock; ?></span> <br />
                    Fournisseur <span class="blue"><?php echo $produit->getFournisseur()->getLibelle(); ?></span><br />
                    Marque : <span class="blue"><?php echo $produit->getMarque()->getLibelle(); ?></span><br />
                    Date limite de vente : <span class="blue"><?php echo $dlv ?></span><br />
                    Prix d'achat : <span class="blue"><?php echo $prix; ?> €</span><br />
                    Prix de vente conseillé :  <span class="blue"><?php echo $vente; ?> €</span><br />
                    Quantité : <span class="blue"><?php echo $produit->getPoids(); ?></span><br />
                    Groupement : <span class="blue"><?php echo $produit->getGroupement(); ?></span><br />
                    <?php if ($produit->getTextePromo() != NULL && $produit->getTextePromo() != "") {
                        echo "Promotion : <span class='blue'>".$produit->getTextePromo()."</span><br />";
                    }
                    ?>
                </div>
                <div class="prod_price_big"><span class="price"><?php echo $prix; ?> €</span></div>
               <a href='index.php?addtocart=<?php echo $produit->getId(); ?>&quant=' class="confirmLink" id="addtocart">Ajouter au panier</a> </div>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
    <div id="dialog" title="Confirmation requise">
        Ajouter ce produit à votre panier ?<br>
        <br>Quelle quantité désirez-vous ? <input type="number" min="1" max="999" name="quantite" id="quant" value="1">
    </div>
    <script type="text/javascript" src="../js/dialogBox.js"></script>
    <div class="center_title_bar">Produits similaires</div>
<?php

$s = 0;
$j = 0;
if (sizeof($listSimilar) != 0) {
    $c = sizeof($listSimilar) - 1;
    $tabId = array();

    for ($i = 0; $i < 10000; $i++) {
        $idx = mt_rand($s, $c);
        $isOK = true;
        foreach ($tabId as $elem) {
            if ($idx != $elem) {
                $isOK = true;
            } else {
                $isOK = false;
                break;
            }
        }

            if ($isOK) {
                $tabId[] = $idx;
                $prodSimilar = $listSimilar[$idx];
                $prix = round(($prodSimilar->getPrixHTVA() + ($prodSimilar->getPrixHTVA() * $prodSimilar->getTVA()->getCoef())), 2);
                $j++;
                echo "<div class='prod_box'>";
                echo "<div class='top_prod_box'></div>";
                echo "<div class='center_prod_box'>";

                echo "<div class='product_title'><a href='index.php?page=details&produit=" . $prodSimilar->getId() . "'>" . $prodSimilar->getProduit() . "</a></div>";
                echo "<div class='product_img'><a href='index.php?page=details&produit=" . $prodSimilar->getId() . "'><img style='max-height:90px;max-width:100px;' src='../Style/images/produits/" . $prodSimilar->getId() . ".png' alt='image' border='0' /></a></div>";
                echo "<div class='prod_price'> <span class='price'>" . $prix . "€</span></div>";
                echo "</div>";
                echo "<div class='bottom_prod_box' ></div >";
                echo "</div>";
            }
        if ($j == 3) {
            break;
        }
        }

    } else {
    echo "<div id='nothing' > <span class='alert alert-warning'>Aucun produit similaire, désolé</span></div>";
}

?>


