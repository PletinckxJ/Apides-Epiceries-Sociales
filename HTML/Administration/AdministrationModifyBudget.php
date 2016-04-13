<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 15:33
 */

$id = $_GET['id'];
$bm = new BudgetManager(connexionDb());
$budget = $bm->getBudgetById($id);
require("../Form/modifyBudget.form.php");
if (isset($_POST['modifBudget'])) {
    if (modifyBudget($budget)) {
        ob_clean();
        header("Location :index.php?page=benef&option=budget");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>Le budget existe déjà</label>";
    }

}
?>