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
     * Fonction g�n�rant un manager en fonction de la BDD.
     * @param PDO $database : la base de donn�es.
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

    public function getMarqueByName($name) {
        $query = $this->db->query("SELECT * FROM marque WHERE libelle LIKE '%".$name."%'");
        $query->execute();

        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = utf8_encode($row['libelle']);
        }

        return $data;

    }
    public function getMarqueById($id) {
        $query = $this->db->prepare("SELECT * FROM marque WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabMarque = $query->fetch(PDO::FETCH_ASSOC)) {
            $marque = new Marque($tabMarque);
        } else {
            $marque = new Marque(array());
        }



        return $marque;
    }

    public function getMarqueByLibelle($libelle) {
        $query = $this->db->prepare("SELECT * FROM marque WHERE libelle = :lib");
        $query->execute(array(
            ":lib" => $libelle
        ));

        if ($tabMarque = $query->fetch(PDO::FETCH_ASSOC)) {
            $marque = new Marque($tabMarque);
        } else {
            $marque = new Marque(array());
        }



        return $marque;
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