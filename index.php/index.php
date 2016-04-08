<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 11:34
 */

include("../Library/Function/Require.lib.php");
$tab = array();
if (isset($_POST['mdp']) && isset($_POST['userName'])) {
    $tab = doConnect();
}
include("../HTML/Head.php");

    if (!isConnect()) {
        echo "<span id='outPopUp'><img src='../Style/images/logo_apides_site1.png' alt='Titre Apides' />";
        echo "<div id='boxConnexion'>";
        echo "<article id='connexion'>";
        include "../Form/connexion.form.php";
        if (isset($tab['Error'])) {
            echo $tab['Error'];
        }
        echo "</article>";
        echo "</div>";
        echo "</span>";
    } else {
        header("Location :../Administration/");
    }
?>
</body>
</html>
