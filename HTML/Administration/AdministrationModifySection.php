<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 15:17
 */

$id = $_GET['id'];
$sm = new SectionManager(connexionDb());
$section = $sm->getSectionById($id);
require("../Form/modifySection.form.php");
if (isset($_POST['modifSection'])) {
    if (modifySection($section)) {
        ob_clean();
        header("Location :index.php?page=produit&option=section");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>La section existe déjà</label>";
    }

}
?>