<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 08:46
 */

class ProduitManager {
    private $db;

    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getProduitArray(Produit $produit) {
        $marque = $this->getProduitMarque($produit);
        $TVA = $this->getProduitTVA($produit);
        $fournisseur = $this->getProduitFournisseur($produit);
        $section = $this->getProduitSection($produit);
        $produit->setMarque($marque);
        $produit->setFournisseur($fournisseur);
        $produit->setTVA($TVA);
        $produit->setSection($section);
        return $produit;
    }

    public function getAllProduit() {
        $resultats = $this->db->query("SELECT * FROM produits");
        $resultats->execute();

        $tabProduit = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabProduit as $elem)
        {
            $produit = new Produit($elem);
            $produit = $this->getProduitArray($produit);
            $tab[] = $produit;

        }

        return $tab;
    }
    public function getProduitById($id) {
        $query = $this->db->prepare("SELECT * FROM produits WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabProduit = $query->fetch(PDO::FETCH_ASSOC)) {
            $produit = new Produit($tabProduit);
            $produit = $this->getProduitArray($produit);
        } else {
            $produit = new Produit(array());
        }



        return $produit;
    }

    public function getProduitByCode($code) {
        $query = $this->db->prepare("SELECT * FROM produits WHERE code_produit= :code");
        $query->execute(array(
            ":code" => $code
        ));

        if ($tabProduit = $query->fetch(PDO::FETCH_ASSOC)) {
            $produit = new Produit($tabProduit);
            $produit = $this->getProduitArray($produit);
        } else {
            $produit = new Produit(array());
        }



        return $produit;
    }

    public function getProduitByEAN($ean) {
        $query = $this->db->prepare("SELECT * FROM produits WHERE EAN = :ean");
        $query->execute(array(
            ":ean" => $ean
        ));

        if ($tabProduit = $query->fetch(PDO::FETCH_ASSOC)) {
            $produit = new Produit($tabProduit);
            $produit = $this->getProduitArray($produit);
        } else {
            $produit = new Produit(array());
        }



        return $produit;
    }

    public function addProduit(Produit $produit) {
        $query = $this->db->prepare("INSERT INTO produits(code_produit, EAN, DLV, groupement, poids, prix_htva, produit, produit_actif, promo)
                                      VALUES(:code, :ean, :dlv, :groupement, :poids, :prix, :name, :actif, :promo)");
        $query->execute(array(
            ":code" => $produit->getCodeProduit(),
            ":ean" => $produit->getEAN(),
            ":dlv" => $produit->getDLV(),
            ":groupement" => $produit->getGroupement(),
            ":poids" => $produit->getPoids(),
            ":prix" => $produit->getPrixHTVA(),
            ":name" => $produit->getProduit(),
            ":actif" => $produit->getProduitActif(),
            ":promo" => $produit->getPromo()
        ));
    }

    public function getProduitMarque(Produit $produit) {
        $mm = new MarqueManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM produit_marque WHERE id_produit = :id");
        $query->execute(array(
            ":id" => $produit->getId()
        ));

        $tabMarque = $query->fetchAll(PDO::FETCH_ASSOC);

        $marqueProduit = new Marque(array());
        foreach($tabMarque as $elem)
        {
            $marqueProduit = $mm->getMarqueById($elem['id_marque']);


        }
        return $marqueProduit;
    }

    public function getProduitTVA(Produit $produit) {
        $tm = new TVAManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM produit_tva WHERE id_produit = :id");
        $query->execute(array(
            ":id" => $produit->getId()
        ));

        $tabTVA = $query->fetchAll(PDO::FETCH_ASSOC);

        $TVAProduit = new TVA(array());
        foreach($tabTVA as $elem)
        {
            $TVAProduit = $tm->getTVAById($elem['id_tva']);


        }
        return $TVAProduit;
    }

    public function getProduitFournisseur(Produit $produit) {
        $fm = new FournisseurManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM produit_fournisseur WHERE id_produit = :id");
        $query->execute(array(
            ":id" => $produit->getId()
        ));

        $tabFournisseur = $query->fetchAll(PDO::FETCH_ASSOC);

        $fournisseurProduit = new Fournisseur(array());
        foreach($tabFournisseur as $elem)
        {
            $fournisseurProduit = $fm->getFournisseurById($elem['id_fournisseur']);

        }
        return $fournisseurProduit;
    }

    public function getProduitSection(Produit $produit) {
        $sm = new SectionManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM produit_section WHERE id_produit = :id");
        $query->execute(array(
            ":id" => $produit->getId()
        ));

        $tabSection = $query->fetchAll(PDO::FETCH_ASSOC);

        $sectionProduit = new Section(array());
        foreach($tabSection as $elem)
        {
            $sectionProduit = $sm->getSectionById($elem['id_section']);


        }
        return $sectionProduit;
    }

    public function setProduitMarque(Produit $produit, $marque)
    {
        $query = $this->db->prepare("INSERT INTO produit_marque(id_produit, id_marque)  values (:idProd, :idMarque)");
        $query->execute(array(
            ":idProd" => $produit->getId(),
            ":idMarque" => $marque
        ));
    }

    public function setProduitTVA(Produit $produit, $tva)
    {
        $query = $this->db->prepare("INSERT INTO produit_tva(id_produit, id_tva)  values (:idProd, :idTVA)");
        $query->execute(array(
            ":idProd" => $produit->getId(),
            ":idTVA" => $tva
        ));
    }
    public function setProduitFournisseur(Produit $produit, $fournisseur)
    {
        $query = $this->db->prepare("INSERT INTO produit_fournisseur(id_produit, id_fournisseur)  values (:idProd, :idFourn)");
        $query->execute(array(
            ":idProd" => $produit->getId(),
            ":idFourn" => $fournisseur
        ));
    }
    public function setProduitSection(Produit $produit, $section)
    {
        $query = $this->db->prepare("INSERT INTO produit_section(id_produit, id_section)  values (:idProd, :idSec)");
        $query->execute(array(
            ":idProd" => $produit->getId(),
            ":idSec" => $section
        ));
    }

    public function updateProduitMarque(Produit $produit, $marque) {
        $query = $this->db->prepare("UPDATE produit_marque SET id_marque = :marque WHERE id_produit = :id");
        $query->execute(array(
            ":marque" => $marque,
            ":id" => $produit->getId()
        ));
    }

    public function updateProduitTVA(Produit $produit, $tva) {
        $query = $this->db->prepare("UPDATE produit_tva SET id_tva = :tva WHERE id_produit = :id");
        $query->execute(array(
            ":tva" => $tva,
            ":id" => $produit->getId()
        ));
    }

    public function updateProduitFournisseur(Produit $produit, $fournisseur) {
        $query = $this->db->prepare("UPDATE produit_fournisseur SET id_fournisseur = :fourn WHERE id_produit = :id");
        $query->execute(array(
            ":fourn" => $fournisseur,
            ":id" => $produit->getId()
        ));
    }

    public function updateProduitSection(Produit $produit, $section) {
        $query = $this->db->prepare("UPDATE produit_section SET id_section = :sec WHERE id_produit = :id");
        $query->execute(array(
            ":sec" => $section,
            ":id" => $produit->getId()
        ));
    }

    public function updateProduit(Produit $produit) {
        $query = $this->db->prepare("UPDATE produits SET promo = :promo, code_produit = :code, DLV = :dlv, EAN = :ean, groupement = :groupement, poids = :poids, prix_htva = :prix, produit = :nom,
                   produit_actif = :actif WHERE id = :id");

        $query->execute(array(
            ":promo" => $produit->getPromo(),
            ":code" => $produit->getCodeProduit(),
            ":dlv" => $produit->getDLV(),
            ":ean" => $produit->getEAN(),
            ":groupement" => $produit->getGroupement(),
            ":nom" => $produit->getProduit(),
            ":poids" => $produit->getPoids(),
            ":prix" => $produit->getPrixHTVA(),
            ":actif" => $produit->getProduitActif(),
            ":id" => $produit->getId()
        ));
    }

}