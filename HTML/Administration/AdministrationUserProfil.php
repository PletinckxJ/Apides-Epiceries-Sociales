<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11-04-16
 * Time: 14:04
 */
ob_start();
$id = $_GET['id'];
$um = new UserManager(connexionDb());
$dm = new DroitManager(connexionDb());
$user = $um->getUserById($id);
$tabDroit = $dm->getAllDroit();
require("../Form/modifyUser.form.php");
if (isset($_POST['modifyAccount'])) {
    modifyUser($user);
    ob_clean();
    header("Location :index.php?page=modifyUser&id=$id");

}
?>