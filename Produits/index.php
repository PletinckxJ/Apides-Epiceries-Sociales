<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:52
 */

include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");

?>

<?php

if (isConnect()) {
    include("../HTML/Boutique/productContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>