<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 11:37
 */

class TVA {

    private $coef;
    private $id;
    private $texte_tva;

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

    public function getId()
    {
        return $this->id;
    }

    public function getCoef()
    {
        return $this->coef;
    }

    public function getTexteTVA()
    {
        return $this->texte_tva;
    }

    /** SETTER */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCoef($coef)
    {
        $this->coef = $coef;
    }

    public function setTexteTVA($texte)
    {
        $this->texte_tva = $texte;
    }
}