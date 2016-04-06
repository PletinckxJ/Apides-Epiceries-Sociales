<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 10:13
 */

class Utilisateur
{
    private $id;
    private $nom_societe;
    private $mdp;
    private $telephone;
    private $mail;
    private $date_inscription;
    private $date_connexion;
    private $contact;
    private $droit = array();
    private $salt;

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

    /**GETTER**/
    public function getId()
    {
        return $this->id;
    }

    public function getContact()
    {
        return $this->contact;
    }
    public function getMail()
    {
        return $this->mail;
    }

    public function getNomSociete()
    {
        return $this->nom_societe;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getDateinscription()
    {
        return $this->date_inscription;
    }

    public function getDateconnexion()
    {
        return $this->date_connexion;
    }

    public function getDroit()
    {
        return $this->droit;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getSalt()
    {
        return $this->salt;
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

    public function setContact($contact)
    {
        $this->contact = $contact;
    }


    public function setNomSociete($societe)
    {
        $this->nom_societe = $societe;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setDateinscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    public function setDateconnexion($date_connexion)
    {
        $this->date_connexion = $date_connexion;
    }

    public function setDroit(array $droit)
    {
        $this->droit = $droit;
    }

    public function setTelelephone($tel)
    {
        $this->telephone = $tel;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Fonction permettant le hashage du mots de passe.
     * @use inscription
     * @use profil
     */
    public function setHashMdp()
    {
        $this->setMdp(hash("sha256", $this->getMdp() . $this->salt));
    }

}