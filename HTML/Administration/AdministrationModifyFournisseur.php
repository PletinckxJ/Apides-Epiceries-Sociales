<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:51
 */

$id = $_GET['id'];
$fm = new FournisseurManager(connexionDb());
$fournisseur = $fm->getFournisseurById($id);
require("../Form/modifyFournisseur.form.php");
if (isset($_POST['modifFournisseur'])) {
    if (modifyFournisseur($fournisseur)) {
        ob_clean();
        header("Location :index.php?page=produit&option=fournisseur");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>Le fournisseur existe déjà</label>";
    }

}
?>