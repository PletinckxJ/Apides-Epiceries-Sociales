<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 11:50
 */


class Budget {

    private $budget_mens;
    private $id;
    private $situation_fam;

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

    public function getBudgetMens()
    {
        return $this->budget_mens;
    }

    public function getSituationFam()
    {
        return $this->situation_fam;
    }
    /** SETTER */

    public function setId($id) {
        $this->id = $id;
    }

    public function setLibelle($budget) {
        $this->budget_mens = $budget;
    }

    public function setSituationFam($situation)
    {
        $this->situation_fam = $situation;
    }
}