<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 15:51
 */

class SectionManager
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

    public function getAllSection()
    {
        $resultats = $this->db->query("SELECT * FROM sections");
        $resultats->execute();

        $tabSection = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach ($tabSection as $elem) {
            $section = new Section($elem);
            $tab[] = $section;

        }

        return $tab;
    }

    public function updateSection(Section $section)
    {

        $query = $this
            ->db
            ->prepare("UPDATE sections SET libelle = :libelle WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $section->getId(),
                ":libelle" => $section->getLibelle()
            ));

    }

    public function addSection($libelle)
    {
        $query = $this
            ->db
            ->prepare("INSERT INTO sections(libelle) VALUES (:libelle)");

        $query->execute(array(
            ":libelle" => $libelle
        ));
    }

    public function deleteSection($id)
    {
        $query = $this
            ->db
            ->prepare("DELETE FROM sections WHERE id = :id");

        $query->execute(array(
            ":id" => $id
        ));
    }

}