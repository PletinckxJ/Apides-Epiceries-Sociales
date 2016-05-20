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
startSession();
unset($_SESSION['Devis']);
unset($_SESSION['pdf']);
unset($_SESSION['tempAchat']);
unset($_SESSION['tempDev']);
unset($_SESSION['Cloture']);
?>

<?php

if (isConnect()) {
    include("../HTML/Achat/AchatContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>