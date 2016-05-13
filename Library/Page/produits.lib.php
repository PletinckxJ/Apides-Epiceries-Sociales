<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 22/04/2016
 * Time: 13:56
 */

function addToCart() {
    $id = $_GET['addtocart'];
    $quant = $_GET['quant'];
    $am = new AchatManager(connexionDb());
    if ($am->getAchatFromUser($_SESSION['Utilisateur']->getId(), $id)->getProduit() == NULL) {
        $am->setUtilisateurAchat($_SESSION['Utilisateur']->getId(), $id, $quant);
    }
    ob_clean();
    header("Location :../Produits");
}

function addToFav()  {
    $id = $_GET['addtofavoris'];
    $pm = new ProduitManager(connexionDb());
    $pm->addToFavoris($id, $_SESSION['Utilisateur']->getId());
    ob_clean();
    header("Location :../Produits");
}

if (isset($_POST['user']) or isset($_POST['action'])) {
    require "../../Manager/ProduitManager.manager.php";
    require "../../Manager/SectionManager.manager.php";
    require "../../Manager/DroitManager.manager.php";
    require "../../Manager/AchatManager.manager.php";
    require "../../Manager/DevisManager.manager.php";
    require "../../Manager/FournisseurManager.manager.php";
    require "../../Manager/MarqueManager.manager.php";
    require "../../Manager/TVAManager.manager.php";
    require "../../Entity/Produit.class.php";
    require "../../Entity/Fournisseur.class.php";
    require "../../Entity/Utilisateur.class.php";
    require "../../Entity/Section.class.php";
    require "../../Entity/Marque.class.php";
    require "../../Entity/TVA.class.php";
    require "../../Entity/Achat.class.php";
    require "../../Entity/Droit.class.php";
    require "../../Entity/Devis.class.php";
    require('../Function/invoice.php');
    require('../../kint-master/Kint.class.php');
    require('../Function/Session.lib.php');
    require('../Function/Config.lib.php');
    require('../Function/Database.lib.php');
    $am = new AchatManager(connexionDb());
    $pm = new ProduitManager(connexionDb());
    if ($_POST['action'] == "remove") {
        $pm->deleteFavoris($_POST['prod'], $_POST['produser']);
    } else {

        $tabFav = $pm->getFavoris($_POST['user']);

        foreach ($tabFav as $elem) {
            $am->setUtilisateurAchat($_POST['user'], $elem->getId(), 1);
        }
    }
}