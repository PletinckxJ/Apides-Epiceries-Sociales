<?php
/**
 * Created by PhpStorm.
 * User: JulienTour
 * Date: 7/05/2016
 * Time: 14:36
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
$pm = new ProduitManager(connexionDb());
$data = $pm->getProduitName($_GET['term']);
$am = new AchatManager(connexionDb());
$tabAchat = $am->getAllAchatsFromDevis($_SESSION['CurrentDevis']);
foreach ($tabAchat as $elem) {
    foreach ($data as $nom) {
        if ($nom == $elem->getProduit()->getProduit()) {
            $key = array_search($nom, $data);
            unset($data[$key]);
        }
    }
}
echo json_encode($data);