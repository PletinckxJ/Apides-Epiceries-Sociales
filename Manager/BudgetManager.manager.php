<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 15:03
 */

class BudgetManager {

    private $db;
    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAllBudget() {
        $resultats = $this->db->query("SELECT * FROM budget_mensuel");
        $resultats->execute();

        $tabBudget = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabBudget as $elem)
        {
            $budget = new Budget($elem);
            $tab[] = $budget;

        }

        return $tab;
    }

    public function getBudgetById($id) {

        $resultats = $this->db->query("SELECT * FROM budget_mensuel WHERE id = :id");
        $resultats->execute(array(
            ":id" => $id
        ));

        if ($tabBudget = $resultats->fetch(PDO::FETCH_ASSOC)) {
            $budget = new Budget($tabBudget);
        } else {
            $budget = new Budget(array());
        }

            return $budget;
    }

    public function updateBudget(Budget $budget) {
        $query = $this
            ->db
            ->prepare("UPDATE budget_mensuel SET budget_mens = :budget , situation_fam = :situation WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $budget->getId(),
                ":budget" => $budget->getBudgetMens(),
                ":situation" => $budget->getSituationFam()
            ));
    }

    public function addBudget(Budget $budget) {
        $query = $this
            ->db
            ->prepare("INSERT INTO budget_mensuel(budget_mens, situation_fam) VALUES (:budget, :situation)");

        $query->execute(array(
            ":budget" => $budget->getBudgetMens(),
            ":situation" => $budget->getSituationFam()
        ));
    }

    public function deleteBudget(Budget $budget) {
        $query = $this
            ->db
            ->prepare("DELETE FROM budget_mensuel WHERE id = :id");

        $query->execute(array(
            ":id" => $budget->getId()
        ));
    }

}