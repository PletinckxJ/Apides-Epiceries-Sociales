<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11-04-16
 * Time: 14:04
 */
$id = $_GET['id'];
$um = new UserManager(connexionDb());
$dm = new DroitManager(connexionDb());
$user = $um->getUserById($id);
$tabDroit = $dm->getAllDroit();
require("../Form/modifyUser.form.php");
if (isset($_POST['modifyAccount'])) {
    $retour = modifyUser($user);
    if (!$retour['bool']) {
        if ($retour['Name'] == "Name") {
            echo "<label class='contact' style='color:Red; width:350px;'>Ce nom d'utilisateur est déjà pris</label>";
        } else if ($retour['Name'] == "Mail") {
            echo "<label class='contact' style='color:Red; width:350px;'>Ce mail est déjà pris</label>";
        }
    } else if ($retour['bool']) {
        ob_clean();
       header("Location :index.php?page=modifyUser&id=$id");
    }

}
?>