<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 11:34
 */

require "Library/Session.lib.php";
require "Library/Database.lib.php";
require "Library/Config.lib.php";
require "Manager/DroitManager.manager.php";
require "Manager/UserManager.manager.php";
require "Entity/Utilisateur.class.php";
require "Library/Page/connexion.lib.php";
require "Entity/Droit.class.php";
require "Manager/ActivationManager.manager.php";
require "Entity/Activation.class.php";
$tab = array();
if (isset($_POST['mdp']) && isset($_POST['userName'])) {
    $tab = doConnect();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Apides Centrale</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="privateCSS.css" />
    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="iecss.css" />
    <![endif]-->
    <script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<?php

    if (!isConnect()) {
        echo "<span id='outPopUp'><img src='images/logo_apides_site1.png' alt='Titre Apides' />";
        echo "<div id='boxConnexion'>";
        echo "<article id='connexion'>";
        include "Form/connexion.form.php";
        if (isset($tab['Error'])) {
            echo $tab['Error'];
        }
        echo "</article>";
        echo "</div>";
        echo "</span>";
    } else {
        include "content.php";
    }

?>
</body>
</html>
