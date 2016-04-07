<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 11:55
 */

class Achat {

    private $date;
    private $quantite;
    private $produit;

    /**
     * Fonction permettant l'hydratation de la classe.
     * @param array $tab est un tableau associatif selon les attributs a assigner.
     */
    private function __hydrate(array $tab)
    {
        foreach ($tab as $key => $value) {
            if (property_exists($this, $key)) $this->$key = $value;
        }
    }

    public function __construct(array $user)
    {
        $this->__hydrate($user);
    }

    /** GETTER */

    public function getDate() {
        return $this->date;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getProduit() {
        return $this->produit;
    }

    /** SETTER */

    public function setDate($date) {
        $this->date = $date;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setProduit(Produit $produit)
    {
        $this->produit = $produit;
    }
}