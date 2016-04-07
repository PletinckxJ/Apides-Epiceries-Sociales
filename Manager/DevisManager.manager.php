<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 11:13
 */

class DevisManager {

    private $db;

    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAllDevis() {
        $query = $this->db->prepare("SELECT * FROM devis");
        $query->execute();

        $tabDevis = $query->fetchAll(PDO::FETCH_ASSOC);
        $tab = array();

        foreach($tabDevis as $elem) {

            $devis = new Devis($elem);
            $tab[] = $devis;
        }

        return $tab;

    }

    public function getDevisById($id) {
        $query = $this->db->prepare("SELECT * FROM devis WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabDevis = $query->fetch(PDO::FETCH_ASSOC)) {
            $devis = new Fournisseur($tabDevis);
        } else {
            $devis = new Fournisseur(array());
        }


        return $devis;
    }

    public function insertDevis(Devis $devis) {
        $query = $this->db->prepare("INSERT INTO devis(cloture, date_emission, num_devis) values (:cloture, :emission, :num) ");
        $query->execute(array(
            ":cloture"  => $devis->getCloture(),
            ":emission" => $devis->getDateEmission(),
            ":num" => $devis->getNumeroDevis()
        ));
    }

    public function updateDevis(Devis $devis) {
        $query = $this->db->prepare("update devis set cloture = :cloture, date_emission = :date, num_devis = :numero WHERE id=:id");
        $query->execute(array(
            ":cloture"  => $devis->getCloture(),
            ":date" => $devis->getDateEmission(),
            ":numero" => $devis->getNumeroDevis(),
            ":id" => $devis->getId()
        ));
    }

    public function cloturerDevis($id) {
        $query = $this->db->prepare("update devis set cloture = 1 WHERE id=:id");
        $query->execute(array(
            ":id" => $id
        ));
    }
}