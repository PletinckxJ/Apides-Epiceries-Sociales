<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 13:23
 */

/**
 * Fonction servant à générer un code aléatoire servant au mot de passe oublié ou à l'activation.
 * @return string : le code généré.
 */
function genererCode() {
    $characts    = 'abcdefghijklmnopqrstuvwxyz';
    $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characts   .= '1234567890';
    $code_aleatoire      = '';

    for($i=0;$i < 6;$i++)    //10 est le nombre de caractères
    {
        $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
    }
    return $code_aleatoire;
}

function membreExistant() {
    $id = $_GET['id'];
    $um = new UserManager(connexionDb());
    $user = $um->getUserById($id);
    if ($user->getNomSociete() == NULL) {
        return false;
    } else {
        return true;
    }
}

function benefExistant() {
    $id = $_GET['id'];
    $bm = new BeneficiaireManager(connexionDb());
    $benef = $bm->getBeneficiaireById($id);
    if ($benef->getNumeroRegistre() == NULL) {
        return false;
    } else {
        return true;
    }
}

function budgetExistant() {
    $id = $_GET['id'];
    $bm = new BudgetManager(connexionDb());
    $budget = $bm->getBudgetById($id);
    if ($budget->getSituationFam() == NULL) {
        return false;
    } else {
        return true;
    }
}


?>