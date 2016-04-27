<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 08:44
 */

$pm = new ProduitManager(connexionDb());

?>

<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>

<?php include("showCart.php"); ?>