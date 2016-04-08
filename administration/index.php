<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:17
 */

include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");
if (isset($_POST['formulaire']) && isValid()['Retour']) {
    addDB();
    $tabRetour['Error'][] = "Le membre a �t� inscrit et un mail lui a �t� envoy� pour confirmer son inscription";
} else if (isset($_POST['formulaire']) && !isValid()['Retour']) {
    foreach(isValid()['Error'] as $elem) {
        $tabRetour['Error'][] = $elem;
    }
}
?>

<?php

    if (isConnect()) {
        include("../HTML/AdministrationContent.php");
    } else {
        header("Location :../Deconnexion");
    }

include "../HTML/Footer.php";
?>