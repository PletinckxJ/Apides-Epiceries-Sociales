<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 13:37
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
    if (isset($_POST['produit']) && isset($_POST['action'])) {
        if ($_POST['action'] == 'delete') {
            $id = $_POST['produit'];
            $user = $_POST['user'];
            $am = new AchatManager(connexionDb());
            $am->deleteUtilisateurAchat($user, $id);
        }

    } else if (isset($_POST['session'])) {
        $_SESSION['Achat'] = $_POST['session'];
    } else if (isset($_POST['action']) && $_POST['action'] == 'devis') {
        $dm = new DevisManager(connexionDb());
        $am = new AchatManager(connexionDb());
        $dm->insertDevis($_SESSION['Devis']);
        $devis = $dm->getDevisByNum($_SESSION['Devis']->getNumeroDevis());
        foreach ($_SESSION['Achat'] as $elem) {
            $am->setProduitDevis($elem, $devis);
        }
        $_SESSION['pdf']->Output("../../Devis/".$devis->getId().".pdf", "F");
        $am->deleteAllUtilisateurAchat($_SESSION['Utilisateur']->getId());
        unset($_SESSION['pdf']);
    }

