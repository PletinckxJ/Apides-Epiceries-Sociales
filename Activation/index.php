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
if (isset($_POST['code'])) {
    $tab = validateCode();
} else if (isset($_POST['mdp'])) {
    $tab[] = validateMdp();
}
include("../HTML/Head.php");

if (!isConnect()) {
    echo "<span id='outPopUp'><img src='../Style/images/logo_apides_site1.png' alt='Titre Apides' />";
    echo "<div id='boxConnexion'>";
    echo "<article id='connexion'>";

    include "../Form/validation.form.php";
    if (isset($tab[0])) {
        foreach ($tab as $elem) {
            echo $elem;
        }
    }

    echo "</article>";
    echo "</div>";
    echo "</span>";
} else {
    header("Location :../Compte");
}
?>
</body>
</html>
