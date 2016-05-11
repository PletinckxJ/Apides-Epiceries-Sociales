<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 10:56
 */

class Produit {

    private $id;
    private $promo;
    private $code_produit;
    private $DLV;
    private $EAN;
    private $groupement;
    private $poids;
    private $prix_htva;
    private $produit;
    private $produit_actif;
    private $fournisseur;
    private $marque;
    private $section;
    private $tva;
    private $promo_texte;

    /**
     * Fonction permettant l'hydratation de la classe.
     * @param array $tab est un tableau associatif selon les attributs a assigner.
     */
    private function __hydrate(array $tab)
    {
        foreach($tab as $key => $value)
        {
            if(property_exists($this,$key))$this->$key = $value;
        }
    }
    public function __construct(array $produit)
    {
        $this->__hydrate($produit);
    }

    /** GETTER */

    public function getId()
    {
        return $this->id;
    }

    public function getPromo()
    {
        return $this->promo;
    }

    public function getCodeProduit()
    {
        return $this->code_produit;
    }

    public function getDLV()
    {
        return $this->DLV;
    }

    public function getEAN()
    {
        return $this->EAN;
    }

    public function getGroupement()
    {
        return $this->groupement;
    }

    public function getPoids()
    {
        return $this->poids;
    }

    public function getPrixHTVA()
    {
        return $this->prix_htva;
    }

    public function getTextePromo()
    {
        return $this->promo_texte;
    }

    public function getProduit()
    {
        return $this->produit;
    }

    public function getProduitActif()
    {
        return $this->produit_actif;
    }

    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getSection()
    {
        return $this->section;
    }
    public function getTVA()
    {
        return $this->tva;
    }


    /** SETTER */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    public function setCodeProduit($code)
    {
        $this->code_produit = $code;
    }

    public function setDLV($DLV)
    {
        $this->DLV = $DLV;
    }

    public function setEAN($EAN)
    {
        $this->EAN = $EAN;
    }

    public function setGroupement($groupement)
    {
        $this->groupement = $groupement;
    }

    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    public function setPrixHTVA($prix)
    {
        $this->prix_htva = $prix;
    }

    public function setPromoTexte($texte) {
        $this->promo_texte = $texte;
    }

    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    public function setProduitActif($produit_actif)
    {
        $this->produit_actif = $produit_actif;
    }

    public function setFournisseur(Fournisseur $fournisseur)
    {
        $this->fournisseur = $fournisseur;
    }

    public function setMarque(Marque $marque)
    {
        $this->marque = $marque;
    }

    public function setSection(Section $section)
    {
        $this->section = $section;
    }
    public function setTVA(TVA $tva)
    {
        $this->tva = $tva;
    }
}