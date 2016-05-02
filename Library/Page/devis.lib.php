<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/04/2016
 * Time: 14:33
 */
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

startSession();
$dm = new DevisManager(connexionDb());
if (isset($_POST['session'])) {
    $_SESSION['Cloture'] = $_POST['session'];
    $_SESSION['Devis'] = $dm->getDevisById($_POST['devis']);
} else if (isset($_POST['action']) && $_POST['action'] == 'devis') {
    $devis = $_SESSION['Devis'];
    if (isset($_SESSION['Cloture'])) {
        $tabAchat = $_SESSION['Cloture'];
        $am = new AchatManager(connexionDb());
        foreach ($tabAchat as $elem) {
            $am->modifyProduitDevisQuantity($elem, $devis);
        }

        if (isset ($_SESSION['pdf'])) {
            $_SESSION['pdf']->Output("../../Devis/pdf/revision-" . $devis->getId() . ".pdf", "F");
            unset($_SESSION['pdf']);

        }

         unset($_SESSION['Cloture']);
    }
    $dm->cloturerDevis($devis->getId());
    unset($_SESSION['Devis']);
}

