<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 15:25
 */

class MarqueManager {
    private $db;
    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAllMarque() {
        $resultats = $this->db->query("SELECT * FROM marque");
        $resultats->execute();

        $tabMarque = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabMarque as $elem)
        {
            $marque = new Marque($elem);
            $tab[] = $marque;

        }

        return $tab;
    }

    public function updateMarque(Marque $marque) {

        $query = $this
            ->db
            ->prepare("UPDATE marque SET libelle = :libelle WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $marque->getId(),
                ":libelle" => $marque->getLibelle()
            ));

    }

    public function addMarque($libelle) {
        $query = $this
            ->db
            ->prepare("INSERT INTO marque(libelle) VALUES (:libelle)");

        $query->execute(array(
            ":libelle" => $libelle
        ));
    }

    public function deleteMarque($id) {
        $query = $this
            ->db
            ->prepare("DELETE FROM marque WHERE id = :id");

        $query->execute(array(
            ":id" => $id
        ));
    }

}