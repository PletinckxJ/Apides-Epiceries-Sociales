<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 16:02
 */

/**
 * Class ActivationManager
 * Controlleur de la base de donn�e li� au code d'activation
 */
class ActivationManager
{
    private $db;

    /**
     * Fonction g�n�rant un manager en fonction de la BDD.
     * @param PDO $database : la base de donn�es.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    /**
     * M�thode permettant la r�cup�ration des codes d'activation li� � un libell� et a un user
     * @param string $libelle du code d'activation
     * @param int $id le user li� au code d'activation
     * @return Activation
     */
    public function getActivationByLibelleAndId($libelle, $id)
    {
        $query = $this->db->prepare("SELECT * FROM activation WHERE libelle = :libelle AND id_utilisateur = :id");
        $query->execute(array(
            ":libelle" => $libelle,
            ":id" => $id
        ));

        if ($tabAct = $query->fetch(PDO::FETCH_ASSOC)) {
            $act = new Activation($tabAct);
        } else {
            $act = new Activation(array());
        }
        return $act;
    }

    /**
     * Fonction permettant de r�cup�rer un code d'activation en fonction  du code.
     * @param $code : le  code.
     * @return Activation : la classe Activation concernant ce code.
     */
    public function getActivationByCode($code)
    {
        $query = $this->db->prepare("SELECT * FROM activation WHERE code = :code");
        $query->execute(array(
            ":code" => $code,
        ));

        if ($tabAct = $query->fetch(PDO::FETCH_ASSOC)) {
            $act = new Activation($tabAct);
        } else {
            $act = new Activation(array());
        }
        return $act;
    }

    /**
     * Fonction permettant de r�cuperer une Activation en fonction du code et du libell�.
     * @param $libelle : le libell� du code.
     * @param $code : le code.
     * @return Activation : la classe Activation concernant ce code.
     */
    public function getActivationByCodeAndLibelle($libelle, $code)
    {
        $query = $this->db->prepare("SELECT * FROM activation WHERE libelle = :libelle AND code = :code");
        $query->execute(array(
            ":libelle" => $libelle,
            ":code" => $code,
        ));

        if ($tabActi = $query->fetch(PDO::FETCH_ASSOC)) {
            $codeRenvoi = new Activation($tabActi);
        } else {
            $codeRenvoi = new Activation(array());
        }

        return $codeRenvoi;
    }

    /**
     * M�thode permettant la r�cup�ration des codes d'activation li� � un user
     * @param int $id de l'utilisateur que l'on recherche
     * @return array : un tableau contenant toues les Activations concernant l'utilisateur.
     */
    public function getActivationById($id)
    {
        $query = $this->db->prepare("SELECT * FROM activation WHERE id_utilisateur = :id");
        $query->execute(array(
            ":id" => $id
        ));

        $tabAct = $query->fetch(PDO::FETCH_ASSOC);
        $tab = array();
        foreach ($tabAct as $elem) {
            $tab[] = new Activation($elem);
        }

        return $tab;
    }

    /**
     * Fonction renvoyant toutes les Activation li�es � un libell�.
     * @param $libelle : le libell� concern�.
     * @return array : le tableau d'Activation.
     */
    public function getActivationByLibelle($libelle)
    {
        $query = $this->db->prepare("SELECT * FROM activation WHERE libelle = :libelle");
        $query->execute(array(
            ":libelle" => $libelle
        ));

        $tabAct = $query->fetch(PDO::FETCH_ASSOC);
        $tab = array();
        foreach ($tabAct as $elem) {
            $tab[] = new Activation($elem);
        }

        return $tab;
    }

    /**
     * Fonction permettant d'ajouter une activation � la base de donn�es.
     * @param Activation $activation : la classe Activation que l'on souhaite ajouter.
     */
    public function addActivation(Activation $activation)
    {
        $query = $this
            ->db
            ->prepare("INSERT INTO activation(id_utilisateur, code,libelle) VALUES (:id_user , :code , :libelle)");

        $query->execute(array(
            ":id_user" => $activation->getIdUser(),
            ":code" => $activation->getCode(),
            ":libelle" => $activation->getLibelle()
        ));
    }

    /**
     * Fonction supprimant le code d'activation d'un utilisateur en fonction de son libell�.
     * @param $id : l'id de l'utilisateur.
     * @param $libelle : le libell� du code.
     */
    public function deleteActivationByIdAndLibelle($id, $libelle)
    {
        $query = $this
            ->db
            ->prepare("DELETE FROM activation WHERE id_utilisateur = :id AND libelle = :libelle");

        $query
            ->execute(array(
                ":id" => $id,
                ":libelle" => $libelle,
            ));
    }

    /**
     * Fonction supprimant un code d'activation en fonction de sa classe Activation.
     * @param Activation $activation : la classe Activation que l'on souhaite supprimer.
     */
    public function deleteActivation(Activation $activation)
    {
        $query = $this
            ->db
            ->prepare("DELETE FROM activation WHERE code= :code AND id_utilisateur = :id_user AND libelle = :libelle");

        $query
            ->execute(array(
                ":code" => $activation->getCode(),
                ":id_user" => $activation->getIdUser(),
                ":libelle" => $activation->getLibelle(),
            ));
    }
}

