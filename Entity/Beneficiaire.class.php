<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 10:29
 */

class Beneficiaire {

    private $id;
    private $adresse;
    private $code_postal;
    private $gsm;
    private $limite_acces;
    private $mail;
    private $nom;
    private $prenom;
    private $date_inscription;
    private $note;
    private $numero_registre;
    private $referent_social;
    private $ville;
    private $budget = array();

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

    public function __construct(array $benef)
    {
        $this->__hydrate($benef);
    }

    /**GETTER**/
    public function getId()
    {
        return $this->id;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getMail()
    {
        return $this->mail;
    }

    public function getCodePostal()
    {
        return $this->code_postal;
    }

    public function getGsm()
    {
        return $this->gsm;
    }

    public function getDateinscription()
    {
        return $this->date_inscription;
    }

    public function getLimiteAccces()
    {
        return $this->limite_acces;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getReferent()
    {
        return $this->referent_social;
    }

    public function getNumeroRegistre()
    {
        return $this->numero_registre;
    }
    public function getVille()
    {
        return $this->ville;
    }
    /**SETTER**/
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }


    public function setCodePostal($code)
    {
        $this->code_postal = $code;
    }

    public function setLimiteAcces($limite)
    {
        $this->limite_acces = $limite;
    }

    public function setDateinscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    public function setGsm($gsm)
    {
        $this->gsm = $gsm;
    }

    public function setBudget(array $budget)
    {
        $this->budget = $budget;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setReferent($referent)
    {
        $this->referent_social = $referent;
    }

    public function setNote($note)
    {
        $this->note = $note;
    }
    public function setNumeroRegistre($registe)
    {
        $this->numero_registre = $registe;
    }

}