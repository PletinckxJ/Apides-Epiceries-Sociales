<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:10
 */



$id = $_GET['id'];
$mm = new MarqueManager(connexionDb());
$marque = $mm->getMarqueById($id);
require("../Form/modifyMarque.form.php");
if (isset($_POST['modifMarque'])) {
    if (modifyMarque($marque)) {
        ob_clean();
        header("Location :index.php?page=produit&option=marque");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>La marque existe déjà</label>";
    }

}
?>