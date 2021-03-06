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
     * Fonction g�n�rant un manager en fonction de la BDD.
     * @param PDO $database : la base de donn�es.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function getAllDevis() {
        $query = $this->db->prepare("SELECT * FROM devis ORDER BY id DESC");
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
            $devis = new Devis($tabDevis);
        } else {
            $devis = new Devis(array());
        }


        return $devis;
    }

    public function getDevisByNum($num) {
        $query = $this->db->prepare("SELECT * FROM devis WHERE num_devis = :num");
        $query->execute(array(
            ":num" => $num
        ));

        if ($tabDevis = $query->fetch(PDO::FETCH_ASSOC)) {
            $devis = new Devis($tabDevis);
        } else {
            $devis = new Devis(array());
        }


        return $devis;
    }

    public function getAllDevisFromUser(Utilisateur $user) {
        $query = $this->db->prepare("SELECT id_devis FROM utilisateur_devis WHERE id_utilisateur = :id ORDER BY id_devis DESC");
        $query->execute(array(
            ":id" => $user->getId(),
        ));
        $tabDevis = $query->fetchAll(PDO::FETCH_ASSOC);
        $listDevis = array();

        foreach ($tabDevis as $elem) {
            $devis = $this->getDevisById($elem['id_devis']);
            $listDevis[] = $devis;
        }


        return $listDevis;
    }

    public function getDevisUser($devis) {
        $query = $this->db->prepare("SELECT id_utilisateur FROM utilisateur_devis WHERE id_devis = :id");
        $query->execute(array(
            ":id" => $devis
        ));

        if ($tabDevis = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = $tabDevis['id_utilisateur'];
        } else {
            $user = NULL;
        }



        return $user;
    }

    public function addUtilisateurDevis($user,$devis) {
        $query = $this->db->prepare("INSERT INTO utilisateur_devis(id_utilisateur, id_devis) values ( :iduser, :iddevis) ");
        $query->execute(array(
            ":iduser" => $user,
            ":iddevis" => $devis
        ));
    }
    public function insertDevis(Devis $devis) {
        $query = $this->db->prepare("INSERT INTO devis(date_emission, num_devis, note) values ( NOW(), :num, :note) ");
        $query->execute(array(
            ":num" => $devis->getNumeroDevis(),
            ":note" => $devis->getNote()
        ));
    }

    public function modifyNote($note, $devis) {
        $query = $this->db->prepare("update devis set note = :note WHERE id=:id");
        $query->execute(array(
            ":id" => $devis,
            "note" => $note
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

    public function lancerAchatDevis($id) {
        $query = $this->db->prepare("update devis set cloture = 2 WHERE id=:id");
        $query->execute(array(
            ":id" => $id
        ));
    }
    public function lancerLivraisonDevis($id) {
        $query = $this->db->prepare("update devis set cloture = 3 WHERE id=:id");
        $query->execute(array(
            ":id" => $id
        ));
    }
    public function lancerFinalDevis($id) {
        $query = $this->db->prepare("update devis set cloture = 4 WHERE id=:id");
        $query->execute(array(
            ":id" => $id
        ));
    }
    public function modifyLivraison($date, $devis) {
        $query = $this->db->prepare("update devis set date_livraison = :dateliv WHERE id=:id");
        $query->execute(array(
            ":id" => $devis,
            ":dateliv" => date("Y-m-d", strtotime($date))
        ));
    }
    public function deleteDevis($id) {
        $query = $this->db->prepare("update devis set cloture = 5 WHERE id=:id");
        $query->execute(array(
            ":id" => $id
        ));
    }
}