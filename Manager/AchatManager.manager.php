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
        $resultats = $this->db->prepare("SELECT * FROM beneficiaire_achat where id_beneficiaire = :id");
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

    public function getAllAchatFromUser(Utilisateur $user) {
        $resultats = $this->db->prepare("SELECT * FROM utilisateur_achat where id_user = :id");
        $resultats->execute(array(
            ":id" => $user->getId()
        ));

        $tabAchat = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $tab = array();

        foreach($tabAchat as $elem)
        {
            $achat = new Achat($elem);
            $pm = new ProduitManager(connexionDb());
            $achat->setProduit($pm->getProduitById($elem['id_produit']));
            $achat->setQuantite(0);
            $tab[] = $achat;

        }

        return $tab;
    }
    public function getAllAchatsFromDevis(Devis $devis) {
        $resultats = $this->db->prepare("SELECT * FROM produit_devis where id_devis = :id");
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

    public function getAchatFromUser($id_user, $id_produit) {
        $resultats = $this->db->prepare("SELECT * FROM utilisateur_achat where id_user = :id_user and id_produit = :id_prod" );
        $resultats->execute(array(
            ":id_user" => $id_user,
            ":id_prod" => $id_produit
        ));
        $pm = new ProduitManager(connexionDb());

        if($tabAchat = $resultats->fetch(PDO::FETCH_ASSOC))
        {
            $achat = new Achat(array());
            $produit = $pm->getProduitById($tabAchat['id_produit']);
            $achat->setProduit($produit);

        }
        else
        {
            $achat = new Achat(array());
        }
        return $achat;
    }
    public function setBeneficiaireAchat(Beneficiaire $beneficiaire, Produit $produit) {

    }

    public function deleteUtilisateurAchat($id_user, $id_produit) {
        $query = $this->db->prepare("DELETE FROM utilisateur_achat WHERE id_produit = :idProd and id_user = :idUser");
        $query->execute(array(
            ":idUser" => $id_user,
            ":idProd" => $id_produit
        ));
    }

    public function setUtilisateurAchat($id_user, $id_produit) {
        $query = $this->db->prepare("INSERT INTO utilisateur_achat(id_user, id_produit) values (:iduser, :idprod)");
        $query->execute(array(
            ":iduser" => $id_user,
            ":idprod" => $id_produit
        ));
    }
}