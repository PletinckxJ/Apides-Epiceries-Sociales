<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 11:58
 */


$id = $_GET['id'];
$rm = new ReferentManager(connexionDb());
$tabReferent = $rm->getAllReferent();
$bm = new BudgetManager(connexionDb());
$bem = new BeneficiaireManager(connexionDb());
$benef = $bem->getBeneficiaireById($id);
$tabBudget = $bm->getAllBudget();
require "../Form/modifyBenef.form.php";
if (isset($_POST['modifBenef'])) {
    $retour = modifyBeneficiaire($benef);
    if (!$retour['bool']) {
        echo "<label class='contact' style='color:Red; width:350px;'>Numéro de registre déjà existant</label>";
    } else if ($retour['bool']) {
        ob_clean();
        header("Location :index.php?page=modifyBenef&id=$id");
    }

}