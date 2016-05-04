<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 12:23
 */

function getTitle()
{
    if (!isset($_GET['page']) || $_GET['page'] == "users") {
        if (!isset($_GET['option'])) {
            return "Liste des membres";
        } else if ($_GET['option'] == "createAccount") {
            return "Création de compte";
        } else {
            return "Error";
        }
    } else if (isset($_GET['page'])) {
        if ($_GET['page'] == "modifyUser") {
            return "Profil de l'utilisateur";
        } else if ($_GET['page'] == "showUser") {
            return "Devis de l'utilisateur";
        } else if ($_GET['page'] == "benef") {
            if (!isset($_GET['option'])) {
                return "Liste des bénéficiaires";
            } else {
                if ($_GET['option'] == 'create') {
                    return "Création d'un bénéficiaire";
                } else if ($_GET['option'] == 'budget') {
                    return "Liste des budgets";
                } else {
                    return "Error";
                }
            }
        } else if ($_GET['page'] == "modifyBenef") {
            return "Modifier le bénéficiaire";
        } else if ($_GET['page'] == "createBudget") {
            return "Créer le budget";
        } else if ($_GET['page'] == "modifyBudget") {
            return "Modifier le budget";
        } else if ($_GET['page'] == "produit") {
            if (!isset($_GET['option'])) {
                return "Liste des produits";
            } else if ($_GET['option'] == "create") {
                return "Création d'un produit";
            } else if ($_GET['option'] == "fournisseur") {
                return "Liste des fournisseurs";
            } else if ($_GET['option'] == "section") {
                return "Liste des sections";
            } else if ($_GET['option'] == "marque") {
                return "Liste des marques";
            } else if ($_GET['option'] == "tva") {
                return "Liste des TVA";
            } else {
                return "Error";
            }
        } else if ($_GET['page'] == "modifyProduit") {
            return "Modifier le produit";
        } else if ($_GET['page'] == "createMarque") {
            return "Créer une marque";
        } else if ($_GET['page'] == "createFournisseur") {
            return "Créer un fournisseur";
        } else if ($_GET['page'] == "createSection") {
            return "Créer une section";
        } else if ($_GET['page'] == "createTVA") {
            return "Créer une TVA";
        } else if ($_GET['page'] == "modifySection") {
            return "Modifier la section";
        } else if ($_GET['page'] == "modifyMarque") {
            return "Modifier la marque";
        } else if ($_GET['page'] == "modifyFournisseur") {
            return "Modifier le fournisseur";
        } else if ($_GET['page'] == "modifyTVA") {
            return "Modifier la TVA";
        } else if ($_GET['page'] == 'devis') {
            return "Liste des devis";
        } else if ($_GET['page'] == "modifyDevis") {
            return "Informations et opérations sur le devis";
        } else {
            return "Error";
        }
    } else {
        return "Error";
    }
}

function showPoids($poids)
{
    if ($poids >= 1000) {
        $poids = ($poids / 1000) . "kg";
    } else {
        $poids = $poids . "g";
    }
    return $poids;
}

function isValid()
{
    $tabReturn = array("Retour" => false, "Error" => array());

    $userName = strtolower($_POST['name']);
    $email = $_POST['mail'];
    $isReglementary = true;

    $um = new UserManager(connexionDb());
    $tabUser = $um->getAllUser();
    $validUserName = true;
    $validUserMail = true;
    $champValid = true;
    foreach ($tabUser as $userTest) {
        if ($userName == strtolower($userTest->getNomSociete()))
            $validUserName = false;
        if ($email == $userTest->getMail())
            $validUserMail = false;
    }
    if (!$validUserMail)
        $tabReturn['Error'][] = "<span class='alert alert-danger' style='float:left;margin-left:12em;'>Cette adresse mail est déjà utilisée, veuillez en choisir une autre !</span> <br>";
    if (!$validUserName)
        $tabReturn['Error'][] = "<span class='alert alert-danger' style='float:left;margin-left:15em;'>Ce login est déjà pris, veuillez en choisir en autre !</span> <br>";
    if ($validUserMail and $validUserName and $champValid and $isReglementary)
        $tabReturn['Retour'] = true;

    return $tabReturn;


}

/**
 * Fonction ajoutant en BDD le nouveau membre inscrit et lui envoyant un message contenant son code d'activation
 * d'inscription.
 */
function addDB()
{
    $userToAdd = new Utilisateur(array(
        "nom_societe" => $_POST['name'],
        "mail" => $_POST['mail'],
        "telephone" => $_POST['gsm'],
        "contact" => $_POST['toContact'],
        "adresse" => $_POST['adresse'],
        "ville" => $_POST['ville'],
        "code_postal" => $_POST['code']

    ));

    $code_aleatoire = genererCode();
    $adresseAdmin = "no-reply@centrale-achat-apides.be";
    $to = $userToAdd->getMail();
    $sujet = "Confirmation de l'inscription";
    $entete = "From:" . $adresseAdmin . "\r\n";
    $entete .= "MIME-Version: 1.0\r\n";
    $entete .= "Content-Type: text/html; charset=windows-1252\r\n";
    $message = '<html><body>';
    $message .= '<div align="center"><img  src="http://www.centrale-achat-apides.be//Style/images/logo_apides_site1.png" alt="Confirmation inscription" /></div>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10" align="center">';
    $message .= "<tr style='background: #eee;'><td><strong>Nom d'utilisateur</strong> </td><td>" . $userToAdd->getNomSociete() . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . $userToAdd->getMail() . "</td></tr>";
    $message .= "<tr><td><strong>Personne de contact:</strong> </td><td>" . $userToAdd->getContact() . "</td></tr>";
    $message .= "<tr><td><strong>Adresse :</strong> </td><td>" . $userToAdd->getAdresse() . "<br>" . $userToAdd->getCode() . " " . $userToAdd->getVille() . "</td></tr>";
    $message .= "<tr><td><strong>Code à entrer lors de la validation :</strong> </td><td>" . $code_aleatoire . "</td></tr>";
    $link = "http://www.centrale-achat-apides.be/Activation";
    $message .= "<tr><td><strong>Cliquez sur ce lien pour confirmer l'inscription :</strong> </td><td><a href=$link target='_blank'>http://www.centrale-achat-apides.be/Activation </a></td></tr>";
    $message .= "</table>";
    $message .= "<div align='center'><strong><br> Bienvenue sur la centrale d'achat Apides !</strong>";
    $message .= "</body></html>";
    mail($to, $sujet, $message, $entete);

    /** @var $um : un nouvel user qui va être ajouté à la BDD
     * J'ajoute le nouvel user à la BDD*/
    $um = new UserManager(connexionDb());
    $um->addUser($userToAdd);

    /**
     * Ici j'ai besoin de savoir quel est le user id du nouveau membre ajouté pour pouvoir le mettre dans l'ajout du code d'activation de cet user
     * Donc je vais le rechercher en base de donnée où il vient d'être ajouté
     */
    $user = $um->getUserByUserName($userToAdd->getNomSociete());

    $userid = $user->getId();

    $um->setUserDroit($user, 3);
    /**
     * J'ajoute le nouveau code d'activation à la BDD
     */
    $am = new ActivationManager(connexionDb());
    $activation = new Activation(array(
        "code" => $code_aleatoire,
        "id_utilisateur" => $userid,
        "libelle" => "Inscription",
    ));
    $am->addActivation($activation);


}

function modifyUser(Utilisateur $user)
{
    $retour = array();
    $user->setNomSociete($_POST['name']);
    $user->setContact($_POST['toContact']);
    $user->setTelephone($_POST['gsm']);
    $user->setMail($_POST['mail']);
    $user->getDroit()->setId($_POST['grade']);
    $user->setVille($_POST['ville']);
    $user->setAdresse($_POST['adresse']);
    $user->setCode($_POST['code']);
    $um = new UserManager(connexionDb());
    $userTestName = $um->getUserByUserName($user->getNomSociete());
    $userTestMail = $um->getUserByEmail($user->getMail());
    if ($userTestName->getNomSociete() != NULL && $userTestName->getId() != $_GET['id']) {
        $retour['Name'] = "Name";
        $retour['bool'] = false;

    } else if ($userTestMail->getNomSociete() != NULL && $userTestMail->getId() != $_GET['id']) {
        $retour['Name'] = "Mail";
        $retour['bool'] = false;
    } else {
        $um->updateUserProfil($user);
        $retour['bool'] = true;
    }
    return $retour;
}

function modifyBeneficiaire(Beneficiaire $benef)
{
    $retour = array();
    $bm = new BeneficiaireManager(connexionDb());
    $benef = fillBenef($benef);
    $benef->setNumeroRegistre($_POST['reg']);
    $benefTest = $bm->getBeneficiaireByRegistre($benef->getNumeroRegistre());
    if ($benefTest->getNom() != NULL && $benefTest->getId() != $_GET['id']) {
        $retour['bool'] = false;
    } else {
        $bm->updateBeneficiaire($benef);
        $bm->updateBenefBudget($benef, $benef->getBudget());
        $bm->updateBenefReferent($benef, $benef->getReferent());
        $retour['bool'] = true;
    }
    return $retour;
}

function modifyBudget(Budget $budget)
{
    $bm = new BudgetManager(connexionDb());
    $budget->setSituationFam($_POST['name']);
    $budget->setLibelle($_POST['montant']);
    $budgetTest = $bm->getBudgetBySituation($budget);
    if ($budgetTest->getSituationFam() != NULL && $budgetTest->getId() != $_GET['id']) {
        return false;
    } else {
        $bm->updateBudget($budget);
        return true;
    }
}

function fillBenef(Beneficiaire $benef)
{
    $benef->setAdresse($_POST['address']);
    $benef->setCodePostal($_POST['code']);
    $benef->setNom($_POST['name']);
    $benef->setMail($_POST['mail']);
    $benef->setPrenom($_POST['prenom']);
    $benef->setGsm($_POST['gsm']);
    $benef->setVille($_POST['ville']);
    if (isset($_POST['note']) && $_POST['note'] != NULL)
        $benef->setNote($_POST['note']);
    else
        $benef->setNote('');
    $budget = new Budget(array());
    $budget->setId($_POST['budget']);
    $ref = new Referent(array());
    $ref->setId($_POST['referent']);
    $benef->setBudget($budget);
    $benef->setReferent($ref);
    return $benef;
}

function addBenef()
{
    $benef = new Beneficiaire(array());
    $bm = new BeneficiaireManager(connexionDb());
    $benef = fillBenef($benef);
    $benef->setNumeroRegistre($_POST['numReg']);
    $refTest = $bm->getBeneficiaireByRegistre($benef->getNumeroRegistre());
    if ($refTest->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>Le numéro de registre existe déjà</label>";
    } else {
        $bm->addBenef($benef);
        $benefId = $bm->getBeneficiaireByRegistre($benef->getNumeroRegistre());
        $benef->setId($benefId->getId());
        $bm->setBenefBudget($benef, $benef->getBudget());
        $bm->setBenefReferent($benef, $benef->getReferent());
        return "<label class='alert alert-success' style='float:left;margin-left:20em;'>Le bénéficiaire a bien été créé</label>";
    }


}

function addBudget()
{
    $budget = new Budget(array());
    $bm = new BudgetManager(connexionDb());
    $budget->setSituationFam($_POST['name']);
    $budget->setLibelle($_POST['montant']);
    $budgetTest = $bm->getBudgetBySituation($budget);
    if ($budgetTest->getSituationFam() != NULL) {
        return false;
    } else {
        $bm->addBudget($budget);
        return true;
    }
}

function addProduit()
{
    $produit = new Produit(array());
    $pm = new ProduitManager(connexionDb());
    $produit = fillProduit($produit);
    $produitCodeTest = $pm->getProduitByCode($produit->getCodeProduit());
    $produitEANTest = $pm->getProduitByEAN($produit->getEAN());
    if ($produitCodeTest->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>Le code produit existe déjà</label>";
    } else if ($produitEANTest->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>L'EAN existe déjà</label>";
    } else {
        $pm->addProduit($produit);
        $pid = $pm->getProduitByCode($produit->getCodeProduit());
        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != NULL) {
            if ($_FILES['ImageNews']['size'] >= 2097152) {
                echo "<div class='alert' role='alert'>Votre image est trop lourde !</div>";
            } else {
                uploadImage('../Style/images/produits', $pid->getId());
            }
        } else {
            copy("../Style/images/produits/produit.png", "../Style/images/produits/" . $pid->getId() . ".png");
        }
        $pm->setProduitFournisseur($pid, $produit->getFournisseur()->getId());
        $pm->setProduitMarque($pid, $produit->getMarque()->getId());
        $pm->setProduitSection($pid, $produit->getSection()->getId());
        $pm->setProduitTVA($pid, $produit->getTVA()->getId());
        header("Location :index.php?page=produit");
    }
}

function modifyProduit($produit)
{
    $pm = new ProduitManager(connexionDb());
    $produit = fillProduit($produit);
    $produitCodeTest = $pm->getProduitByCode($produit->getCodeProduit());
    $produitEANTest = $pm->getProduitByEAN($produit->getEAN());
    if ($produitCodeTest->getId() != NULL && $produitCodeTest->getId() != $produit->getId()) {
        return false;
    } else if ($produitEANTest->getId() != NULL && $produitEANTest->getId() != $produit->getId()) {
        return false;
    } else {
        $pm->updateProduit($produit);
        var_dump($_POST);
        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != NULL) {
            if ($_FILES['image']['size'] >= 2097152) {
                echo "<div class='alert' role='alert'>Votre image est trop lourde !</div>";
            } else {
                uploadImage('../Style/images/produits', $produit->getId());
            }
        } else
            $pm->updateProduitMarque($produit, $produit->getMarque()->getId());
        $pm->updateProduitFournisseur($produit, $produit->getFournisseur()->getId());
        $pm->updateProduitSection($produit, $produit->getSection()->getId());
        $pm->updateProduitTVA($produit, $produit->getTVA()->getId());
        return true;
    }
}

function fillProduit(Produit $produit)
{
    $produit->setCodeProduit($_POST['code']);
    $produit->setDLV($_POST['dlv']);
    $produit->setEAN($_POST['ean']);
    $produit->setProduit($_POST['name']);
    $fournisseur = new Fournisseur(array());
    $fournisseur->setId($_POST['fournisseur']);
    $produit->setFournisseur($fournisseur);
    $marque = new Marque(array());
    $marque->setId($_POST['marque']);
    $produit->setMarque($marque);
    $section = new Section(array());
    $section->setId($_POST['section']);
    $produit->setSection($section);
    $tva = new TVA(array());
    $tva->setId($_POST['tva']);
    $produit->setTVA($tva);
    $produit->setGroupement($_POST['groupement']);
    $produit->setPoids($_POST['poids']);
    $produit->setPrixHTVA($_POST['prix']);
    $produit->setProduitActif($_POST['actif']);
    $produit->setPromo($_POST['promo']);
    return $produit;
}

function addFournisseur()
{
    $libelle = $_POST['name'];
    $fm = new FournisseurManager(connexionDb());
    if ($fm->getFournisseurByLibelle($libelle)->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>Le fournisseur existe déjà</label>";

    } else {
        $fm->addFournisseur($libelle);
        header("Location :index.php?page=produit&option=fournisseur");

    }
}

function modifyFournisseur(Fournisseur $fournisseur)
{
    $fournisseur->setLibelle($_POST['name']);
    $fm = new FournisseurManager(connexionDb());
    $fourniTest = $fm->getFournisseurByLibelle($fournisseur->getLibelle());
    if ($fourniTest->getId() != NULL && $fourniTest->getId() != $fournisseur->getId()) {
        return false;

    } else {
        $fm->updateFournisseur($fournisseur);
        return true;

    }
}

function addSection()
{
    $libelle = $_POST['name'];
    $sm = new SectionManager(connexionDb());
    if ($sm->getSectionByLibelle($libelle)->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>La section existe déjà</label>";

    } else {
        $sm->addSection($libelle);
        header("Location :index.php?page=produit&option=section");

    }
}

function modifySection(Section $section)
{
    $section->setLibelle($_POST['name']);
    $sm = new SectionManager(connexionDb());
    $sectionTest = $sm->getSectionByLibelle($section->getLibelle());
    if ($sectionTest->getId() != NULL && $sectionTest->getId() != $section->getId()) {
        return false;

    } else {
        $sm->updateSection($section);
        return true;

    }
}

function addMarque()
{
    $libelle = $_POST['name'];
    $mm = new MarqueManager(connexionDb());
    if ($mm->getMarqueByLibelle($libelle)->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>La marque existe déjà</label>";

    } else {
        $mm->addMarque($libelle);
        header("Location :index.php?page=produit&option=marque");

    }
}

function modifyMarque(Marque $marque)
{
    $marque->setLibelle($_POST['name']);
    $mm = new MarqueManager(connexionDb());
    $marqueTest = $mm->getMarqueByLibelle($marque->getLibelle());
    if ($marqueTest->getId() != NULL && $marqueTest->getId() != $marque->getId()) {
        return false;

    } else {
        $mm->updateMarque($marque);
        return true;

    }
}

function addTVA()
{
    $libelle = $_POST['name'];
    $tva = new TVA(array());
    $tva->setCoef($libelle / 100);
    $tva->setTexteTVA($libelle . "%");
    $tm = new TVAManager(connexionDb());
    if ($tm->getTVAByTexte($tva->getTexteTVA())->getId() != NULL) {
        return "<label class='alert alert-danger' style='float:left;margin-left:20em;'>La TVA existe déjà</label>";

    } else {
        $tm->addTVA($tva);
        header("Location :index.php?page=produit&option=tva");

    }
}

function modifyTVA(TVA $tva)
{
    $libelle = $_POST['name'];
    $tva->setCoef($libelle / 100);
    $tva->setTexteTVA($libelle . "%");
    $tm = new TVAManager(connexionDb());
    $tvaTest = $tm->getTVAByTexte($tva->getTexteTVA());
    if ($tvaTest->getId() != NULL && $tvaTest->getId() != $tva->getId()) {
        return false;

    } else {
        $tm->updateTVA($tva);
        return true;

    }
}

?>