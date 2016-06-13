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
    $tabRetour['Error'][] = "<span class='alert alert-success' style='float:left;margin-left:8em;'>Le membre a été inscrit et un mail lui a été envoyé pour confirmer son inscription</span>";
} else if (isset($_POST['formulaire']) && !isValid()['Retour']) {
    foreach(isValid()['Error'] as $elem) {
        $tabRetour['Error'][] = $elem;
    }
}
?>

<?php

    if (isConnect() && ($_SESSION['Utilisateur']->getDroit()->getId() == 1 or $_SESSION['Utilisateur']->getDroit()->getId() == 2)) {
        include("../HTML/Administration/AdministrationContent.php");
    } else {
        header("Location :../Deconnexion");
    }

include "../HTML/Footer.php";
?>