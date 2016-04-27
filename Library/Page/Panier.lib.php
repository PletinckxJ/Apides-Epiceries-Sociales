<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 13:37
 */

    require("../../Manager/AchatManager.manager.php");
    require ("../Function/Database.lib.php");
    require ("../Function/Session.lib.php");
    require("../Function/Config.lib.php");

    if (isset($_POST['produit']) && isset($_POST['action'])) {
        if ($_POST['action'] == 'delete') {
            $id = $_POST['produit'];
            $user = $_POST['user'];
            $am = new AchatManager(connexionDb());
            $am->deleteUtilisateurAchat($user, $id);
        }

}