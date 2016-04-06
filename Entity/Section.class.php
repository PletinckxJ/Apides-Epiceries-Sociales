<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 11:41
 */

class Section {

    private $id;
    private $numero;
    private $section;
    private $libelle;

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

    public function getNumero()
    {
        return $this->numero;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function getLibelle()
    {
        return $this->section;
    }

    /** SETTER */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}