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
unset($_SESSION['Devis']);
unset($_SESSION['pdf']);
unset($_SESSION['Cloture']);
unset($_SESSION['tempSess']);
unset($_SESSION['Achat']);

?>

<?php

if (isConnect() && devisExistant()) {
    include("../HTML/Devis/devisContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>