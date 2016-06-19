<?php
/**
 * Created by PhpStorm.
 * User: JulienTour
 * Date: 16/06/2016
 * Time: 16:28
 */

require "Session.lib.php";
require "Database.lib.php";
require "Config.lib.php";
require "../../Manager/DroitManager.manager.php";
require "../../Manager/UserManager.manager.php";
require "../../Manager/BeneficiaireManager.manager.php";
require "../../Manager/BudgetManager.manager.php";
require "../../Manager/ReferentManager.manager.php";
require "../../Manager/ProduitManager.manager.php";
require "../../Manager/SectionManager.manager.php";
require "../../Manager/DevisManager.manager.php";
require "../../Manager/AchatManager.manager.php";
require "../../Manager/FournisseurManager.manager.php";
require "../../Manager/MarqueManager.manager.php";
require "../../Manager/TVAManager.manager.php";
require "../../Manager/ActivationManager.manager.php";
require "../../Entity/Utilisateur.class.php";
require "../../Entity/Activation.class.php";
require "../../Entity/Referent.class.php";
require "../../Entity/Beneficiaire.class.php";
require "../../Entity/Produit.class.php";
require "../../Entity/Fournisseur.class.php";
require "../../Entity/Section.class.php";
require "../../Entity/Marque.class.php";
require "../../Entity/Devis.class.php";
require "../../Entity/TVA.class.php";
require "../../Entity/Budget.class.php";
require "../../Entity/Achat.class.php";

if (1 == 6) {
    class migration
    {
        private $db;

        public function __construct(PDO $database)
        {
            $this->db = $database;
        }

        function getAll()
        {
            $query = $this->db->prepare("SELECT * FROM migration");
            $query->execute(array());

            $tabAct = $query->fetchAll(PDO::FETCH_ASSOC);

            return $tabAct;
        }


    }

    $m = new migration(connexionDb());
    $tab = $m->getAll();


    foreach ($tab as $elem) {
        $prod = new Produit(array());
        preg_match("/(\d{1,3}\s[x]\s)*\d{1,4}(\s*(.|à)\s*\d{1,2})*\s*(kg|gr|g|L|cl|l|ml|doses|portions|pces|dosettes|KG|cubes|rlx)/", $elem['Produit'], $texteQuant);
        if ($texteQuant[0] != null) {
            $prod->setPoids($texteQuant[0]);
        }
        $testName = str_replace($prod->getPoids(), "", $elem['Produit']);
        if (strstr($testName, "TRIAL-")) {
            $testName = str_replace("TRIAL-", "", $testName);
            preg_match("/[-](.*)[-]\s/", $testName, $result);
            if ($result[1] == null) {
                preg_match("/[-](.*)[-]*\s/", $testName, $result);
            }
            $testName = $result[1];
        }
        $testName = str_replace(" - ", " ", $testName);
        $prod->setProduit($testName);
        $prod->setCodeProduit($elem['Code produit']);
        if (strstr($elem['EAN'], "TRIAL-")) {
            preg_match("/[-](\d+)[-]*/", $elem['EAN'], $texteEAN);
            if ($texteEAN[1] != null) {
                $prod->setEAN($texteEAN[1]);
            }
        } else {
            if ($elem['EAN'] != null) {
                $prod->setEAN($elem['EAN']);
            }
        }
        $fourn = new Fournisseur(array());
        if (strstr($elem['Fournisseur'], "TRIAL-")) {
            $elem['Fournisseur'] = str_replace("TRIAL-", "", $elem['Fournisseur']);
            preg_match("/[-](.*)[-]*\s/", $elem['Fournisseur'], $fourntest);
            $fourn->setLibelle($fourntest[1]);
        } else {
            $fourn->setLibelle($elem['Fournisseur']);
        }
        if ($fourn->getLibelle() == "Colruyt") {
            $fourn->setId(1);
        } else {
            $fourn->setId(2);
        }
        $prod->setFournisseur($fourn);
        $marque = new Marque(array());
        if (strstr($elem['Marque'], "TRIAL-")) {
            $elem['Marque'] = str_replace("TRIAL-", "", $elem['Marque']);
            preg_match("/[-](.*)[-]*\s/", $elem['Marque'], $marquetest);
            $marque->setLibelle($marquetest[1]);
        } else {
            $marque->setLibelle($elem['Marque']);
        }
        if ($marque->getLibelle() == "") {
            $marque->setLibelle("Sans-Marque");
        }
        $prod->setMarque($marque);
        $section = new Section(array());
        if (strstr($elem['Section'], "TRIAL-")) {
            $elem['Section'] = str_replace("TRIAL-", "", $elem['Section']);
            preg_match("/[-](.*)[-]*\s/", $elem['Section'], $sectiontest);
            $section->setLibelle($sectiontest[1]);
        } else {
            $section->setLibelle($elem['Section']);
        }
        if ($section->getLibelle() == "") {
            $section->setLibelle("Hygiène");
        }
        $prod->setSection($section);
        switch ($prod->getSection()->getLibelle()) {
            case "Epice - Sauce" :
                $prod->getSection()->setId(7);
                break;
            case "Soupe" :
                $prod->getSection()->setId(13);
                break;
            case "Chocolat" :
                $prod->getSection()->setId(5);
                break;
            case "Biscuit" :
                $prod->getSection()->setId(3);
                break;
            case "Boisson - Sirop" :
                $prod->getSection()->setId(1);
                break;
            case "Hygiène" :
                $prod->getSection()->setId(15);
                break;
            case "Café - Thé" :
                $prod->getSection()->setId(4);
                break;
            case "Céréale" :
                $prod->getSection()->setId(2);
                break;
            case "Féculent" :
                $prod->getSection()->setId(8);
                break;
            case "Fruit" :
                $prod->getSection()->setId(9);
                break;
            case "Légume" :
                $prod->getSection()->setId(10);
                break;
            case "Sucre / Miel" :
                $prod->getSection()->setId(6);
                break;
            case "Alimentation / Divers" :
                $prod->getSection()->setId(17);
                break;
            case "Poisson" :
                $prod->getSection()->setId(11);
                break;
            case "Viande" :
                $prod->getSection()->setId(14);
                break;

        }
        if (strstr($elem['DLV'], "TRIAL-")) {
            $elem['DLV'] = str_replace("TRIAL-", "", $elem['DLV']);
            preg_match("/[-](.*)[-]*\s/", $elem['DLV'], $dlvtest);
            $dlv = $dlvtest[1];
        } else {
            $dlv = null;
        }
        if ($dlv == "") {
            $dlv = null;
        }
        $prod->setDLV($dlv);

        if ($elem['Groupement'] != null) {
            $prod->setGroupement($elem['Groupement']);
        }
        if ($elem['Prix achat HTVA'] != null) {
            $prod->setPrixHTVA($elem['Prix achat HTVA']);
        }
        $tva = new TVA(array());
        if ($elem['TVA'] == "0.06") {
            $tva->setId(3);
        } else {
            $tva->setId(2);
        }
        $prod->setTVA($tva);


        $mm = new MarqueManager(connexionDb());
        $bddmarque = $mm->getMarqueByLibelle($prod->getMarque()->getLibelle());
        if ($bddmarque->getId() != null) {
            $prod->getMarque()->setId($bddmarque->getId());
        } else {
            $mm->addMarque($prod->getMarque()->getLibelle());
            $bddmarque = $mm->getMarqueByLibelle($prod->getMarque()->getLibelle());
            $prod->getMarque()->setId($bddmarque->getId());
        }

        $pm = new ProduitManager(connexionDb());
        $codetest = $pm->getProduitByCode($prod->getCodeProduit());
        $prod->setProduitActif(1);
        $prod->setPromo(0);

        if ($codetest->getCodeProduit() == null) {
            $pm->addProduit($prod);
            $newProd = $pm->getProduitByCode($prod->getCodeProduit());
            var_dump($newProd);
            var_dump($prod);
            echo "<br>";
            $pm->setProduitFournisseur($newProd, $prod->getFournisseur()->getId());
            $pm->setProduitMarque($newProd, $prod->getMarque()->getId());
            $pm->setProduitSection($newProd, $prod->getSection()->getId());
            $pm->setProduitTVA($newProd, $prod->getTVA()->getId());
            copy("../../Style/images/produits/produit.png", "../../Style/images/produits/" . $newProd->getId() . ".png");

        }

    }
} else {
    echo "<h1>Accès refusé !</h1>";
}
