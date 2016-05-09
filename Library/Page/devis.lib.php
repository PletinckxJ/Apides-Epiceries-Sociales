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
            if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
                $_SESSION['pdf']->Output("../../Devis/pdf/" . $devis->getId() . ".pdf", "F");
            } else {
                $_SESSION['pdf']->Output("../../Devis/pdf/revision-" . $devis->getId() . ".pdf", "F");
                $dm->cloturerDevis($devis->getId());
            }
            unset($_SESSION['pdf']);

        }

         unset($_SESSION['Cloture']);
    }

    unset($_SESSION['Devis']);
    if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
        print "../Compte";

    } else {
        print "../Administration/index.php?page=devis";
    }
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $am = new AchatManager(connexionDb());
    $tab = array();
    $devis = new Devis(array(
        "id" => $_POST['devis'],
    ));
    $devis = $dm->getDevisById($devis->getId());
    $_SESSION['Devis'] = $devis;
    $tabAchat = $am->getAllAchatsFromDevis($devis);
    $am->deleteProduitDevis($_POST['produit'], $_POST['devis']);
    if (count($tabAchat) == 1) {
        $dm->deleteDevis($_POST['devis']);
        unlink("../../Devis/pdf/".$devis->getId().".pdf");

        print "deleted";
    }  else {
        $tabAchat = $am->getAllAchatsFromDevis($devis);
        foreach($tabAchat as $elem) {
            $tab[$elem->getProduit()->getId()] = $elem->getQuantite();
        }
        $_SESSION['Cloture'] = $tab;
        $_SESSION['action'] = "modif";
        include("Facture.lib.php");
        print "go";
    }


} else if (isset($_POST['action']) && $_POST['action'] == "add") {
    $pm = new ProduitManager(connexionDb());
    $prod = $pm->getProduitByName($_POST['name']);
    $tab = array();
    $am = new AchatManager(connexionDb());
    $achat = new Achat(array(
        "quantite" => 1,
        "produit" => $prod,
        "date" => date('Y-m-d H:i:s')
    ));
    $devis = new Devis(array(
        "id" => $_POST['devis'],
    ));

    $am->setProduitDevis($achat, $devis);
    $devis = $dm->getDevisById($devis->getId());
    $_SESSION['Devis'] = $devis;
    $tabAchat = $am->getAllAchatsFromDevis($devis);
    foreach($tabAchat as $elem) {
        $tab[$elem->getProduit()->getId()] = $elem->getQuantite();
    }
    $_SESSION['Cloture'] = $tab;
    $_SESSION['action'] = "modif";
    include("Facture.lib.php");

    /**
    $prod = array(
        "id" => $achat->getProduit()->getId(),
        "quantite" => $achat->getQuantite(),
        "nom" => $achat->getProduit()->getProduit(),
        "marque" => $achat->getProduit()->getMarque()->getLibelle(),
        "fournisseur" => $achat->getProduit()->getFournisseur()->getLibelle(),
        "groupe" => $achat->getProduit()->getGroupement(),
        "prix" => round(($achat->getProduit()->getPrixHTVA()+($achat->getProduit()->getPrixHTVA()*$achat->getProduit()->getTVA()->getCoef())),2)


    );
    print json_encode($prod);
    */

}

