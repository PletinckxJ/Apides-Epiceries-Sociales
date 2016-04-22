<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:58
 */


$pm = new ProduitManager(connexionDb());
$produitList = $pm->getAllProduit();
if (isset($_GET['addtocart'])) {
    if (produitExistant()) {
        addToCart();
    } else {
        header("Location :../Deconnexion");
    }

}
?>

<?php include("../HTML/Boutique/NavigationProduct.php"); ?>
<div class="center_content">

    <?php
    echo "<div class='center_title_bar'>Liste des produits <label style='margin-left:13em;'>Recherche : <input id='searchProduct'  type='text'></label></div>";
    ?>
    <div id="nothing" style="display:none;"> Aucun résultat trouvé, désolé</div>
            <?php
           include("../HTML/Boutique/affichageBoutique.php");
            ?>

</div>
<div class="right_content">
    <div class="shopping_cart">
        <div class="cart_title">Panier</div>
        <?php
            $am = new AchatManager(connexionDb());
            $tabAchat = $am->getAllAchatFromUser($_SESSION['Utilisateur']);
            $somme = 0;
            foreach ($tabAchat as $elem) {
                $prod = $elem->getProduit();
                $somme = $somme + round(($prod->getPrixHTVA() + ($prod->getPrixHTVA() * $prod->getTVA()->getCoef())),2);
            }
            echo "<div class='cart_details'> ".count($tabAchat)." produits <br />";
        ?>
            <span class="border_cart"></span> Total: <span class="price"><?php echo $somme; ?> €</span> </div>
        <div class="cart_icon"><a href="#" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img src="../Style/images/shoppingcart.png" alt="" width="48" height="48" border="0" /></a></div>
    </div>
    <div class="title_box">Produit le plus récent</div>
    <div class="border_box">
        <div class="product_title_expo"><a href="details.html"><?php echo $newProduct->getProduit()." | ".$newProduct->getPoids(); ?></a></div>
        <div class="product_img"><a href="details.html"><img src="../Style/images/produits/<?php echo $newProduct->getId(); ?>.png" alt="" border="0" /></a></div>
        <div style="padding-bottom:2em; margin-left:4em;"><a href = 'index.php?addtocart=<?php echo $newProduct->getId(); ?>' class="confirmLink" id='prod_cart'> Commander </a ></div>
        <div class="prod_price"><span class="price"><?php echo $newProduct->getPrixHTVA(); ?>€</span></div>
    </div>
    <div class="title_box">Le plus vendu</div>
    <div class="border_box">
        <div class="product_title_expo"><a href="details.html">Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href="details.html"><img src="Style/images/laptop.png" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
    </div>
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>



