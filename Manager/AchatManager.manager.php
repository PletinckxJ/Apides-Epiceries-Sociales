<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 08:36
 */

class AchatManager {
    private $db;

    /**
     * Fonction générant un manager en fonction de la BDD.
     * @param PDO $database : la base de données.
     */
    public function __construct(PDO $database)
    {
        $this->db = $database;
    }


    public function getAllAchatsFromBeneficiaire(Beneficiaire $benef) {
        $resultats = $this->db->query("SELECT * FROM beneficiaire_achat where id_beneficiaire = :id");
        $resultats->execute(array(
            ":id" => $benef->getId()
        ));

        $tabAchat = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabAchat as $elem)
        {
            $achat = new Achat($elem);
            $pm = new ProduitManager(connexionDb());
            $achat->setProduit($pm->getProduitById($elem['id_produit']));
            $tab[] = $achat;

        }

        return $tab;

    }

    public function getAllAchatsFromDevis(Devis $devis) {
        $resultats = $this->db->query("SELECT * FROM produit_devis where id_devis = :id");
        $resultats->execute(array(
            ":id" => $devis->getId()
        ));

        $tabAchat = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabAchat as $elem)
        {
            $achat = new Achat($elem);
            $pm = new ProduitManager(connexionDb());
            $achat->setProduit($pm->getProduitById($elem['id_produit']));
            $tab[] = $achat;

        }

        return $tab;
    }

    public function setBeneficiaireAchat(Beneficiaire $beneficiaire, Produit $produit) {

    }
}