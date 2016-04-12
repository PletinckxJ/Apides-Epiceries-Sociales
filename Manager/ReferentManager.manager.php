<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12-04-16
 * Time: 12:06
 */

class ReferentManager
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

    public function getAllReferent()
    {
        $resultats = $this->db->query("SELECT * FROM referent_social");
        $resultats->execute();

        $tabReferent = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach ($tabReferent as $elem) {
            $ref = new Referent($elem);
            $tab[] = $ref;

        }

        return $tab;
    }

    public function getReferentById($id)
    {
        $query = $this->db->prepare("SELECT * FROM referent_social WHERE id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if ($tabRef = $query->fetch(PDO::FETCH_ASSOC)) {
            $ref = new Referent($tabRef);
        } else {
            $ref = new Referent(array());
        }


        return $ref;
    }

    public function updateReferent(Referent $ref)
    {

        $query = $this
            ->db
            ->prepare("UPDATE referent_social SET libelle = :libelle WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $ref->getId(),
                ":libelle" => $ref->getLibelle()
            ));

    }

    public function addRef($libelle)
    {
        $query = $this
            ->db
            ->prepare("INSERT INTO referent_social(libelle) VALUES (:libelle)");

        $query->execute(array(
            ":libelle" => $libelle
        ));
    }

    public function deleteRef($id)
    {
        $query = $this
            ->db
            ->prepare("DELETE FROM referent_social WHERE id = :id");

        $query->execute(array(
            ":id" => $id
        ));
    }
}

