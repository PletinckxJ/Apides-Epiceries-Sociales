<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 11:19
 */

class Devis {

    private $cloture;
    private $date_emission;
    private $id;
    private $num_devis;

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

    public function getCloture()
    {
        return $this->cloture;
    }

    public function getDateEmission()
    {
        return $this->date_emission;
    }

    public function getNumeroDevis()
    {
        return $this->num_devis;
    }

    /** SETTER */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCloture($cloture)
    {
        $this->clorure = $cloture;
    }

    public function setDateEmission($date)
    {
        $this->date_emission = $date;
    }

    public function setNumeroDevis($num)
    {
        $this->num_devis = $num;
    }
}