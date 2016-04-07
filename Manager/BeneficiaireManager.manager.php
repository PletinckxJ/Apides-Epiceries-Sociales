<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 13:58
 */

class BeneficiaireManager {
    private $db;
    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function benefBudget(Beneficiaire $benef) {
        $budget = $this->getBenefBudget($benef);
        $benef->setBudget($budget);
        return $benef;
    }

    public function getAllBeneficiaire() {
        $resultats = $this->db->query("SELECT * FROM beneficiaires");
        $resultats->execute();

        $tabBenef = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabBenef as $elem)
        {
            $benef = new Beneficiaire($elem);
            $benef = $this->benefBudget($benef);
            $tab[] = $benef;

        }

        return $tab;
    }


    public function searchBeneficiaireByName($name) {
        $resultats = $this->db->prepare("SELECT * FROM beneficiaires WHERE nom like :name");
        $resultats->execute(array(
            ":name" => "%".$name."%"
        ));

        $tabBenef = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabBenef as $elem)
        {
            $tab[] = new Beneficiaire($elem);
        }

        return $tab;
    }

    public function getBeneficiaireByName($name) {

        $query = $this->db->prepare("SELECT * FROM beneficiaires WHERE nom = :name");
        $query->execute(array(
            ":name" => $name
        ));

        if($tabBenef = $query->fetch(PDO::FETCH_ASSOC))
        {
            $benef = new Beneficiaire($tabBenef);
            $benef = $this->benefBudget($benef);
        }
        else
        {
            $benef = new Beneficiaire(array());
        }
        return $benef;
    }

    public function getBenefBudget(Beneficiaire $benef)
    {
        $bm = new BudgetManager(connexionDb());
        $query = $this->db->prepare("SELECT * FROM beneficiaire_budget WHERE id_beneficiaire = :id");
        $query->execute(array(
            ":id" => $benef->getId()
        ));

        $tabBudget = $query->fetchAll(PDO::FETCH_ASSOC);
        $budgetBenef = new Budget(array());

        foreach($tabBudget as $elem)
        {
            $budgetBenef = $bm->getBudgetById($elem['id_budget']);


        }
        return $budgetBenef;
    }

    public function setBenefBudget(Beneficiaire $benef, Budget $budget)
    {
        $query = $this->db->prepare("INSERT INTO beneficiaire_budget(id_beneficiaire, id_budget) values (:id_budget, :id_benef)");
        $query->execute(array(
            ":id_benef" => $benef->getId(),
            ":id_budget" => $budget->getId()
        ));
    }

    /**
     * Fonction permettant d'ajouter un utilisateur à la BDD.
     * @param Beneficiaire $benef : l'utilisateur à ajouter.
     */
    public function addBenef(Beneficiaire $benef)
    {
        $query = $this
            ->db
            ->prepare("INSERT INTO beneficiaires(adresse, code_postal, date_inscription, gsm, limite_acces, mail, nom, note,
            numero_registre, prenom, referent_social, ville) VALUES (:adresse , :code_postal , NOW(), :gsm, :limite, :mail, :nom, :note, :numero, :prenom, :referent, :ville)");

        $query->execute(array(
            ":adresse" => $benef->getAdresse(),
            ":code_postal" => $benef->getCodePostal(),
            ":gsm" => $benef->getGsm(),
            ":limite" => $benef->getLimiteAccces(),
            ":mail" => $benef->getMail(),
            ":nom" => $benef->getNote(),
            ":note" => $benef->getNote(),
            ":numero" => $benef->getNumeroRegistre(),
            ":prenom" => $benef->getPrenom(),
            ":referent" =>$benef->getReferent(),
            ":ville" => $benef->getVille()
            ));

    }



    /**
     * Fonction permettant de mettre à jour les données d'un utilisateur.
     * @param Beneficiaire $benef : la classe modifiée de l'utilisateur.
     */
    public function updateUserProfil(Beneficiaire $benef)
    {

        $query = $this
            ->db
            ->prepare("UPDATE beneficiaires SET adresse = :adresse , code_postal = :code , gsm = :gsm, mail = :mail, limite_acces = :limite, nom = :nom, note = :note, numero_registre = :numero,
                    prenom = :prenom, referent_social = :referent, ville = :ville WHERE id = :id");

        $query
            ->execute(array(
                ":id" => $benef->getId(),
                ":adresse" => $benef->getAdresse(),
                ":code_postal" => $benef->getCodePostal(),
                ":gsm" => $benef->getGsm(),
                ":limite" => $benef->getLimiteAccces(),
                ":mail" => $benef->getMail(),
                ":nom" => $benef->getNote(),
                ":note" => $benef->getNote(),
                ":numero" => $benef->getNumeroRegistre(),
                ":prenom" => $benef->getPrenom(),
                ":referent" =>$benef->getReferent(),
                ":ville" => $benef->getVille()
            ));


    }

    public function deleteBeneficiaire(Beneficiaire $benef)
    {
        $query = $this->db->prepare("DELETE FROM beneficiaires WHERE id = :id");
        $query->execute(array(
            ":id" => $benef->getId()
        ));

    }

}