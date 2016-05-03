<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 10:10
 */

class UserManager {
    private $db;
    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function userDroit(Utilisateur $user) {
        $droit = $this->getUserDroit($user);
        $user->setDroit($droit);
        return $user;
    }



    public function getAllUser() {
        $resultats = $this->db->query("SELECT * FROM utilisateur");
        $resultats->execute();

        $tabUser = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabUser as $elem)
        {
            $user = new Utilisateur($elem);
            $user = $this->userDroit($user);
            $tab[] = $user;

        }

        return $tab;
    }

    public function searchUserByName($name) {

        $resultats = $this->db->prepare("SELECT * FROM utilisateur WHERE nom_societe like :name");
        $resultats->execute(array(
            ":name" => "%".$name."%"
        ));

        $tabUser = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabUser as $elem)
        {
            $tab[] = new Utilisateur($elem);
        }

        return $tab;
    }

    /**
     * Fonction permettant d'aller retrouver les droits d'un membre.
     * @param Utilisateur $user : le membre concerné.
     * @return Droit : le tableau des droits de l'utilisateur.
     */
    public function getUserDroit(Utilisateur $user)
    {
        $dm = new DroitManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM utilisateur_droit WHERE id_utilisateur = :id");
        $query->execute(array(
            ":id" => $user->getId()
        ));

        $tabDroit = $query->fetchAll(PDO::FETCH_ASSOC);

        $droitUser = new Droit(array());
        foreach($tabDroit as $elem)
        {
            $droitUser = $dm->getDroitById($elem['id_droit']);


        }
        return $droitUser;
    }

    public function setUserDroit(Utilisateur $user, $droits)
    {

        $query = $this->db->prepare("INSERT INTO utilisateur_droit(id_droit, id_utilisateur) values (:idDroit, :idUser)");
        $query->execute(array(
            ":idUser" => $user->getId(),
            ":idDroit" => $droits
        ));
    }

    public function updateUserDroit($idUser, $idDroit)
    {
        $query = $this->db->prepare("UPDATE utilisateur_droit set id_droit = :idDroit WHERE id_utilisateur = :idUser");
        $query->execute(array(
            ":idUser" => $idUser,
            ":idDroit" => $idDroit
        ));
    }

    public function getUserById($id)
    {
        $query = $this->db->prepare("SELECT * FROM utilisateur WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabUser = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new Utilisateur($tabUser);
            $user = $this->userDroit($user);
        } else {
            $user = new Utilisateur(array());
        }



        return $user;
    }

    /**
     * Fonction permettant de retrouver un user en fonction de son nom.
     * @param $userName : le nom de l'utilisateur.
     * @return Utilisateur : la classe utilisateur trouvée.
     */
    public function getUserByUserName($userName)
    {
        $query = $this->db->prepare("SELECT * FROM utilisateur WHERE nom_societe = :userName");
        $query->execute(array(
            ":userName" => $userName
        ));

        if($tabUser = $query->fetch(PDO::FETCH_ASSOC))
        {
            $user = new Utilisateur($tabUser);
            $user = $this->userDroit($user);
        }
        else
        {
            $user = new Utilisateur(array());
        }
        return $user;
    }

    /**
     * Fonction permettant de retrouver un user en fonction de son email.
     * @param mail : l'email de l'utilisateur.
     * @return Utilisateur : la classe user trouvée.
     */
    public function getUserByEmail($mail)
    {
        $query = $this
            ->db
            ->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $query->execute(array(
            ":mail" => $mail
        ));

        if($tabUser = $query->fetch(PDO::FETCH_ASSOC))
        {
            $user = new Utilisateur($tabUser);
            $user = $this->userDroit($user);
        }
        else
        {
            $user = new Utilisateur(array());
        }

        return $user;
    }


    /**
     * Fonction permettant d'ajouter un utilisateur à la BDD.
     * @param Utilisateur $user : l'utilisateur à ajouter.
     */
    public function addUser(Utilisateur $user)
    {
        $user->setSalt(uniqid(mt_rand(), true));
        $query = $this
            ->db
            ->prepare("INSERT INTO utilisateur(nom_societe, mdp, contact, date_inscription, date_connexion, mail, salt, telephone, adresse, ville, code_postal) VALUES (:username , :mdp , :contact, NOW(),NOW(), :mail, :salt, :tel, :adresse, :ville, :code)");

        $user->setHashMdp();
        $query->execute(array(
            ":username" => $user->getNomSociete(),
            ":mdp" => $user->getMdp(),
            ":contact" => $user->getContact(),
            ":mail" => $user->getMail(),
            ":salt" => $user->getSalt(),
            ":tel" => $user->getTelephone(),
            ":adresse" => $user->getAdresse(),
            ":ville" => $user->getVille(),
            ":code" => $user->getCode()
        ));
    }

    /**
     * Fonction permettant de mettre à jour les données d'un utilisateur.
     * @param Utilisateur $user : la classe modifiée de l'utilisateur.
     */
    public function updateUserProfil(Utilisateur $user)
    {
        $_SESSION['lol'] = $user;
        $query = $this
            ->db
            ->prepare("UPDATE utilisateur SET nom_societe = :username , mdp = :mdp , contact = :contact, mail = :mail, telephone = :tel, adresse = :adresse, ville = :ville, code_postal = :code WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $user->getId(),
                ":username" => $user->getNomSociete(),
                ":contact" => $user->getContact(),
                ":mail" => $user->getMail(),
                ":mdp" => $user->getMdp(),
                ":tel" => $user->getTelephone(),
                ":adresse" => $user->getAdresse(),
                ":ville" => $user->getVille(),
                ":code" => $user->getCode()
            ));
        $this->updateUserDroit($user->getId(), $user->getDroit()->getId());


    }

    /**
     * Fonction permettant de mettre à jour la date de dernière connexion de l'utilisateur.
     * @param Utilisateur $user : l'utilisateur concerné.
     */
    public function updateUserConnect(Utilisateur $user)
    {
        $query = $this
            ->db
            ->prepare("UPDATE utilisateur SET date_connexion = NOW() WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $user->getId(),
            ));

    }

    /**
     * Fonction permettant de mettre à jour le mot de passe d'un utilisateur.
     * @param Utilisateur $user : l'utilisateur modifié.
     */
    public function updateUserMdp (Utilisateur $user) {

        $query = $this
            -> db
            ->prepare("UPDATE utilisateur SET mdp = :mdp where id = :id");
        $user->setHashMdp();
        $query
            ->execute(array(
                ":id" => $user->getId(),
                ":mdp" => $user->getMdp(),
            ));
    }

}
