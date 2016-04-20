<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:58
 */

ob_start();
?>

<?php include("../HTML/Boutique/NavigationProduct.php"); ?>
<div class="center_content">
    <?php
    echo "<div class='center_title_bar'>Liste des produits</div>";
    ?>
            <?php
           include("../HTML/Boutique/affichageBoutique.php");
            ?>
</div>
<div class="right_content">
    <div class="shopping_cart">
        <div class="cart_title">Panier</div>
        <div class="cart_details"> 3 items <br />
            <span class="border_cart"></span> Total: <span class="price">350$</span> </div>
        <div class="cart_icon"><a href="#" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img src="../Style/images/shoppingcart.png" alt="" width="48" height="48" border="0" /></a></div>
    </div>
    <div class="title_box">Produit le plus récent</div>
    <div class="border_box">
        <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href="details.html"><img src="Style/images/p2.gif" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
    </div>
    <div class="title_box">Le plus vendu</div>
    <div class="border_box">
        <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href="details.html"><img src="Style/images/laptop.png" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
    </div>
</div>

