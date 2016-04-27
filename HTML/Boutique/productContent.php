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
    if (isset($_GET['page']) && $_GET['page'] == "details" && isset($_GET['produit']) && produitExistant()) {
        include("../HTML/Boutique/ficheProduit.php");
    } else if (!isset($_GET['page'])) {
        echo "<div class='center_title_bar'>Liste des produits <label style='margin-left:13em;'>Recherche : <input id='searchProduct'  type='text'></label></div>";
        echo "<div id='nothing' style='display:none;'> Aucun résultat trouvé, désolé</div>";
        include("../HTML/Boutique/affichageBoutique.php");

    }
    ?>

</div>
<div class="right_content">
    <?php include("../HTML/Panier.php");?>

    <div class="title_box">Produit le plus récent</div>
    <div class="border_box">
        <div class="product_title_expo"><a href='index.php?page=details&produit=<?php echo $newProduct->getId(); ?>'><?php echo $newProduct->getProduit()." | ".$newProduct->getPoids(); ?></a></div>
        <div class="product_img"><a href='index.php?page=details&produit=<?php echo $newProduct->getId(); ?>'><img src="../Style/images/produits/<?php echo $newProduct->getId(); ?>.png" alt="" border="0" /></a></div>
        <div style="padding-bottom:2em; margin-left:4em;"><a href = 'index.php?addtocart=<?php echo $newProduct->getId(); ?>' class="confirmLink" id='prod_cart'> Commander </a ></div>
        <div class="prod_price"><span class="price"><?php echo $newProduct->getPrixHTVA(); ?>€</span></div>
    </div>
    <div class="title_box">Le plus vendu</div>
    <div class="border_box">
        <div class="product_title_expo"><a href='index.php?page=details&produit=<?php echo $newProduct->getId(); ?>'>Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href='index.php?page=details&produit=<?php echo $newProduct->getId(); ?>'><img src="Style/images/laptop.png" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
    </div>
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>



