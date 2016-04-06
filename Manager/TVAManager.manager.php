<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 15:16
 */

class TVAManager {
    private $db;
    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAllTVA() {
        $resultats = $this->db->query("SELECT * FROM taux_tva");
        $resultats->execute();

        $tabTVA = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabTVA as $elem)
        {
            $tva = new TVA($elem);
            $tab[] = $tva;

        }

        return $tab;
    }

    public function updateTVA(TVA $tva) {

        $query = $this
            ->db
            ->prepare("UPDATE taux_tva SET coef = :coef, texte_tva = :texte WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $tva->getId(),
                ":coef" => $tva->getCoef(),
                ":texte" => $tva->getTexteTVA()
            ));

    }

    public function addTVA(TVA $tva) {
        $query = $this
            ->db
            ->prepare("INSERT INTO taux_tva(coef, texte_tva) VALUES (:coef, :texte)");

        $query->execute(array(
            ":coef" => $tva->getCoef(),
            ":texte" => $tva->getTexteTVA()
        ));
    }

    public function deleteBudget(TVA $tva) {
        $query = $this
            ->db
            ->prepare("DELETE FROM taux_tva WHERE id = :id");

        $query->execute(array(
            ":id" => $tva->getId()
        ));
    }
}