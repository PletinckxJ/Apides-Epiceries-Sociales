<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:21
 */

require "../Library/Function/Session.lib.php";
require "../Library/Function/Database.lib.php";
require "../Library/Function/Config.lib.php";
require "../Manager/DroitManager.manager.php";
require "../Manager/UserManager.manager.php";
require "../Manager/ActivationManager.manager.php";
require "../Entity/Utilisateur.class.php";
require "../Entity/Activation.class.php";
require "../Library/Page/connexion.lib.php";
require "../Library/Page/administration.lib.php";
require "../Entity/Droit.class.php";
require "../Library/Function/Function.lib.php";

startSession();
?>