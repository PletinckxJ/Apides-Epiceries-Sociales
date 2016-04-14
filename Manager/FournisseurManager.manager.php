<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 15:55
 */

class FournisseurManager
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

    public function getAllFournisseur()
    {
        $resultats = $this->db->query("SELECT * FROM fournisseur");
        $resultats->execute();

        $tabFournisseur = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach ($tabFournisseur as $elem) {
            $fournisseur = new Fournisseur($elem);
            $tab[] = $fournisseur;

        }

        return $tab;
    }

    public function updateFournisseur(Fournisseur $fournisseur)
    {

        $query = $this
            ->db
            ->prepare("UPDATE fournisseur SET libelle = :libelle WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $fournisseur->getId(),
                ":libelle" => $fournisseur->getLibelle()
            ));

    }

    public function getFournisseurById($id) {
        $query = $this->db->prepare("SELECT * FROM fournisseur WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabFournisseur = $query->fetch(PDO::FETCH_ASSOC)) {
            $fournisseur = new Fournisseur($tabFournisseur);
        } else {
            $fournisseur = new Fournisseur(array());
        }



        return $fournisseur;
    }

    public function getFournisseurByLibelle($libelle) {
        $query = $this->db->prepare("SELECT * FROM fournisseur WHERE libelle = :lib");
        $query->execute(array(
            ":lib" => $libelle
        ));

        if ($tabFournisseur = $query->fetch(PDO::FETCH_ASSOC)) {
            $fournisseur = new Fournisseur($tabFournisseur);
        } else {
            $fournisseur = new Fournisseur(array());
        }



        return $fournisseur;
    }

    public function addFournisseur($libelle)
    {
        $query = $this
            ->db
            ->prepare("INSERT INTO fournisseur(libelle) VALUES (:libelle)");

        $query->execute(array(
            ":libelle" => $libelle
        ));
    }

    public function deleteFournisseur($id)
    {
        $query = $this
            ->db
            ->prepare("DELETE FROM fournisseur WHERE id = :id");

        $query->execute(array(
            ":id" => $id
        ));
    }

}