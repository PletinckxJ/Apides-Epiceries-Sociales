<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 04/05/2016
 * Time: 10:16
 */


include("../Library/Function/Require.lib.php");
if (isConnect()) {
    header("Location :../Compte");
}
$tab = array();
if (isset($_POST['mail'])) {
    $result = sendMail();
    if ($result == 3) {
        $tab[] = "<span class='alert alert-danger' style='float:left;margin-left:2.5em;margin-top:-0.5em; '> Cette adresse mail n'existe pas sur ce site ! </span>";
    } else if ($result == 2) {
        $tab[] = "<span class='alert alert-danger' style='float:left;margin-left:2.5em;margin-top:-0.5em; '> Vous devez activer votre compte d'abord ! </span>";

    } else {
        $tab[] = "<span class='alert alert-success' style='float:left;margin-left:2.5em;margin-top:-0.5em; '> Un mail vous a été envoyé avec le code de récupération ! </span>";

    }
}

if (isset($_POST['code'])) {
    $tab = validateCodeRecup();
}

if (isset($_POST['mdp']) && isset($_POST['mdpverif'])) {
    $tab[] = validateChangementMdp();
}
include("../HTML/Head.php");

if (!isConnect()) {
    echo "<span id='outPopUp'><img src='../Style/images/logo_apides_site1.png' alt='Titre Apides' />";
    echo "<div id='boxConnexion'>";
    echo "<article id='connexion' style='padding-bottom:1.5em;'>";

    include "../Form/recuperation.form.php";
    if (isset($tab[0])) {
        foreach ($tab as $elem) {
            echo $elem;
        }
    }

    echo "</article>";
    echo "</div>";
    echo "</span>";
}
?>
</body>
</html>