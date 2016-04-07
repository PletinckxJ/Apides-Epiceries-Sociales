<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 12:43
 */

class DroitManager
{
    private $db;

    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    /**
     * Fonction permettant de récupérer le droit en fonction de son id.
     * @param $id : l'id du droit voulu.
     * @return Droit : la classe Droit du droit retrouvé.
     */
    public function getDroitById($id)
    {
        $query = $this->db->prepare("SELECT * FROM droit WHERE id = :id");
        $query->execute(array(
            ":id" => $id,
        ));

        if ($tabDroit = $query->fetch(PDO::FETCH_ASSOC)) {
            $droit = new Droit($tabDroit);
        } else {
            $droit = new Droit(array());
        }

        return $droit;
    }

    /**
     * Fonction permettant d'ajouter un nouveau droit en base de données.
     * @param $libelle : le nouveau libellé du droit.
     */
    public function addDroit($libelle)
    {
        $query = $this->db->prepare("INSERT INTO droit(libelle) VALUES (:libelle)");
        $query->execute(array(
            ":libelle" => $libelle,
        ));
    }

    /**
     * Fonction permettant de récupérer tous les droits contenus en BDD.
     * @return array : tableau contenant toutes les classes Droit trouvées.
     */
    public function getAllDroit()
    {

        $resultats = $this->db->query("SELECT * FROM droit");
        $resultats->execute();

        $tabDroit = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach ($tabDroit as $elem) {
            $tab[] = new Droit($elem);
        }

        return $tab;


    }
}
