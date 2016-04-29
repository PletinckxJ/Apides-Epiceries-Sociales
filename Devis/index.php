<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/04/2016
 * Time: 10:16
 */


include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");


?>

<?php

if (isConnect() && devisExistant()) {
    include("../HTML/Devis/devisContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>