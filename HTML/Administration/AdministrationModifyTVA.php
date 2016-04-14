<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:43
 */


$id = $_GET['id'];
$tm = new TVAManager(connexionDb());
$tva = $tm->getTVAById($id);
require("../Form/modifyTVA.form.php");
if (isset($_POST['modifTVA'])) {
    if (modifyTVA($tva)) {
        ob_clean();
        header("Location :index.php?page=produit&option=tva");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>La TVA existe déjà</label>";
    }

}
?>