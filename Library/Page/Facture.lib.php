<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 14:52
 */


// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
require "../../Manager/ProduitManager.manager.php";
require "../../Manager/SectionManager.manager.php";
require "../../Manager/DroitManager.manager.php";
require "../../Manager/UserManager.manager.php";
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
$different = false;
if (isset ($_SESSION['Devis'])) {
    $am = new AchatManager(connexionDb());
    $tabProd = $am->getAllAchatsFromDevis($_SESSION['Devis']);
  foreach ($tabProd as $elem) {
      if ($_SESSION['Cloture'][$elem->getProduit()->getId()] !=  $elem->getQuantite()) {
          $different = true;
      }
  }
}
if ((isset ($_SESSION['Devis']) && $different) || (!isset($_SESSION['Devis']) && !$different)) {
    if (!isset($_SESSION['Devis'])) {
        $tabDevis = $dm->getAllDevis();
        $actualNum = 0;
        $split2 = explode("0", date("Y"));
        $year = $split2[1];
        foreach ($tabDevis as $elem) {
            $num = $elem->getNumeroDevis();
            $split = explode("\\", $num);
            $num = intval($split[1]);
            if ($num > $actualNum && $year == intval($split[0])) {
                $actualNum = $num;

            }

        }
    }
    $pdf = new PDF_Invoice('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->addSociete("Centrale d'achats Apides",
        "MONARD Stéphane\n" .
        "Clos de l'Aciérie 1\n" .
        "1490 Court-Saint-Etienne\n");
    if (isset($_SESSION['Devis'])) {
        $pdf->fact_dev("Devis ", $_SESSION['Devis']->getNumeroDevis());
        $pdf->addDate(date("d/m/Y", strtotime($_SESSION['Devis']->getDateEmission())));
        $iduser = $dm->getDevisUser($_SESSION['Devis']->getId());
        $um = new UserManager(connexionDb());
        $user = $um->getUserById($iduser);
        $pdf->addClient("CL" . $user->getId());
    } else {
        $pdf->fact_dev("Devis ", $year . " \\ " . ($actualNum + 1));
        $pdf->addDate(date("d/m/Y"));
        $pdf->addClient("CL" . $_SESSION['Utilisateur']->getId());
    }
    $pdf->addPageNumber("1");
    if (!isset($_SESSION['Devis'])) {
        $pdf->addClientAdresse($_SESSION['Utilisateur']->getNomSociete() . "\n" . $_SESSION['Utilisateur']->getContact() . "\n" . $_SESSION['Utilisateur']->getAdresse() . "\n" . $_SESSION['Utilisateur']->getCode() . "   " . $_SESSION['Utilisateur']->getVille() . "");
        $pdf->addReglement("Payement à la réception des biens");
        $time = strtotime(date("d.m.Y"));
        $final = date("d/m/Y", strtotime("+1 month", $time));
        $pdf->addEcheance("Délai max : " . $final);

        $pdf->addReference("Devis " . ($actualNum + 1) . " de " . date("Y") . "");
    } else {
        $pdf->addClientAdresse($user->getNomSociete() . "\n" . $user->getContact() . "\n" . $user->getAdresse() . "\n" . $user->getCode() . "   " . $user->getVille() . "");
        $pdf->addReglement("Payement à la réception des biens");
        $time = $_SESSION['Devis']->getDateEmission();
        $final = date("d/m/Y", strtotime("+1 month", $time));
        $pdf->addEcheance("Délai max : " . $final);
        $split = explode("\\", $_SESSION['Devis']->getNumeroDevis());
        $num = intval($split[1]);
        $pdf->addReference("Devis " . $num . " de " . date("Y", strtotime($time)) . "");
    }
    $cols = array("REFERENCE" => 23,
        "DESIGNATION" => 70,
        "QUANTITE" => 22,
        "P.U. HT (€)" => 26,
        "MONTANT H.T. (€)" => 34,
        "TVA" => 15);
    $pdf->addCols($cols);
    $cols = array("REFERENCE" => "L",
        "DESIGNATION" => "L",
        "QUANTITE" => "C",
        "P.U. HT (€)" => "R",
        "MONTANT H.T. (€)" => "R",
        "TVA" => "C");
    $pdf->addLineFormat($cols);
    $pdf->addLineFormat($cols);
    $y = 109;
    $count = 0;
    $p = 2;
    $pm = new ProduitManager(connexionDb());
    $actualProd = array();
    do {
        if (!isset($_SESSION['Devis'])) {
            foreach ($_SESSION['Achat'] as $key => $value) {
                $prod = $pm->getProduitById($key);

                if ($prod->getId() != NULL) {
                    $line = array("REFERENCE" => $prod->getCodeProduit(),
                        "DESIGNATION" => $prod->getProduit() . "\n" . $prod->getMarque()->getLibelle() . " | " . $prod->getFournisseur()->getLibelle(),
                        "QUANTITE" => $value,
                        "P.U. HT (€)" => $prod->getPrixHTVA(),
                        "MONTANT H.T. (€)" => strval(round(($prod->getPrixHTVA() * $value), 2)),
                        "TVA" => $prod->getTVA()->getTexteTVA());
                    $size = $pdf->addLine($y, $line);
                    $y += $size + 2;
                    $count++;
                    $achat = new Achat(array());
                    $achat->setProduit($prod);
                    $achat->setQuantite($value);
                    $actualProd[] = $achat;
                }
                unset($_SESSION['Achat'][$key]);
                if (($count % 14) == 0) break;

            }
        } else if (isset($_SESSION['Devis'])) {
            foreach ($_SESSION['Cloture'] as $key => $value) {
                $prod = $pm->getProduitById($key);

                if ($prod->getId() != NULL) {
                    $line = array("REFERENCE" => $prod->getCodeProduit(),
                        "DESIGNATION" => $prod->getProduit() . "\n" . $prod->getMarque()->getLibelle() . " | " . $prod->getFournisseur()->getLibelle(),
                        "QUANTITE" => $value,
                        "P.U. HT (€)" => $prod->getPrixHTVA(),
                        "MONTANT H.T. (€)" => strval(round(($prod->getPrixHTVA() * $value), 2)),
                        "TVA" => $prod->getTVA()->getTexteTVA());
                    $size = $pdf->addLine($y, $line);
                    $y += $size + 2;
                    $count++;
                    $achat = new Achat(array());
                    $achat->setProduit($prod);
                    $achat->setQuantite($value);
                    $actualProd[] = $achat;
                }
                unset($_SESSION['Cloture'][$key]);
                if (($count % 14) == 0) break;

            }
        }

        if ($count % 14 == 0) {
            $pdf->AddPage();
            $pdf->addPageNumber($p);
            $pdf->addSociete("Centrale d'achats Apides",
                "MONARD Stéphane\n" .
                "Clos de l'Aciérie 1\n" .
                "1490 Court-Saint-Etienne\n");
            if (isset($_SESSION['Devis'])) {
                $pdf->fact_dev("Devis ", $_SESSION['Devis']->getNumeroDevis());
                $pdf->addDate(date("d/m/Y", strtotime($_SESSION['Devis']->getDateEmission())));
                $pdf->addClient("CL" . $user->getId());
                $pdf->addClientAdresse($user->getNomSociete() . "\n" . $user->getContact() . "\n" . $user->getAdresse() . "\n" . $user->getCode() . "   " . $user->getVille() . "");
            } else {

                $pdf->fact_dev("Devis ", $year . " \\ " . $actualNum);
                $pdf->addDate(date("d/m/Y"));
                $pdf->addClient("CL" . $_SESSION['Utilisateur']->getId());
                $pdf->addClientAdresse($_SESSION['Utilisateur']->getNomSociete() . "\n" . $_SESSION['Utilisateur']->getContact() . "\n" . $_SESSION['Utilisateur']->getAdresse() . "\n" . $_SESSION['Utilisateur']->getCode() . "   " . $_SESSION['Utilisateur']->getVille() . "");
            }
            $y = 109;
            $cols = array("REFERENCE" => 23,
                "DESIGNATION" => 70,
                "QUANTITE" => 22,
                "P.U. HT (€)" => 26,
                "MONTANT H.T. (€)" => 34,
                "TVA" => 15);
            $pdf->addCols($cols);
            $cols = array("REFERENCE" => "L",
                "DESIGNATION" => "L",
                "QUANTITE" => "C",
                "P.U. HT (€)" => "R",
                "MONTANT H.T. (€)" => "R",
                "TVA" => "C");
            $pdf->addLineFormat($cols);
            $pdf->addLineFormat($cols);
            $p++;
        }
    } while ($count % 14 == 0);


    $pdf->addCadreTVAs();

// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
    $tot_prods = array();
    foreach ($actualProd as $elem) {
        $current = array("px_unit" => $elem->getProduit()->getPrixHTVA(), "qte" => $elem->getQuantite(), "tva" => $elem->getProduit()->getTVA()->getId());
        $tot_prods[] = $current;

    }
    $tab_tva = array();
    $tm = new TVAManager(connexionDb());
    $tvas = $tm->getAllTVA();
    foreach ($tvas as $elem) {
        $tab_tva[$elem->getId()] = $elem->getCoef() * 100;
    }
    $params = array("RemiseGlobale" => 0,
        "remise_tva" => 0,       // {la remise s'applique sur ce code TVA}
        "remise" => 0,       // {montant de la remise}
        "remise_percent" => 0,      // {pourcentage de remise sur ce montant de TVA}
        "FraisPort" => 0,
        "portTTC" => 0,      // montant des frais de ports TTC
        // par defaut la TVA = 19.6 %
        "portHT" => 0,       // montant des frais de ports HT
        "portTVA" => 0,    // valeur de la TVA a appliquer sur le montant HT
        "AccompteExige" => 0,
        "accompte" => 0,     // montant de l'acompte (TTC)
        "accompte_percent" => 0,    // pourcentage d'acompte (TTC)
    );

    $pdf->addTVAs($params, $tab_tva, $tot_prods);
    $pdf->addCadreEurosFrancs();
    if (!isset($_SESSION['Devis'])) {
        $_SESSION['Achat'] = $actualProd;
        $devis = new Devis(array(
            "date_emission" => date("d/m/Y"),
            "num_devis" => $year . " \\ " . ($actualNum + 1)
        ));
        $_SESSION['Devis'] = $devis;
    } else {
        $_SESSION['Cloture'] = $actualProd;
    }
    $_SESSION['pdf'] = $pdf;
    $pdf->Output();
} else {
    require_once('../Function/fpdf/fpdi.php');
    require_once('../Function/fpdf/fpdf.php');
    $pdf = new FPDI();
    $pdf->AddPage();

    $pdf->setSourceFile("../../Devis/pdf/".$_SESSION['Devis']->getId().".pdf");
// import page 1
    $tplIdx = $pdf->importPage(1);
//use the imported page and place it at point 0,0; calculate width and height
//automaticallay and ajust the page size to the size of the imported page
    $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
    $pdf->Output();
}



?>