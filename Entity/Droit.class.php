<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 10:27
 */

class Droit {
    private $id;
    private $libelle;

    private function __hydrate(array $tab)
    {
        foreach($tab as $key => $value)
        {
            if(property_exists($this,$key))$this->$key = $value;
        }
    }
    public function __construct(array $droit)
    {
        $this->__hydrate($droit);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**SETTER**/
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}