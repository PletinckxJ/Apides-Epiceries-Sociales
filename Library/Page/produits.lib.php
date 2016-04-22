<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 22/04/2016
 * Time: 13:56
 */

function addToCart() {
    $id = $_GET['addtocart'];
    $am = new AchatManager(connexionDb());
    if ($am->getAchatFromUser($_SESSION['Utilisateur']->getId(), $id)->getProduit() == NULL) {
        $am->setUtilisateurAchat($_SESSION['Utilisateur']->getId(), $id);
    }
    ob_clean();
    header("Location :../Produits");
}