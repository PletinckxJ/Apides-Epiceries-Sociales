<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 12:23
 */

function getTitle() {
    if (!isset($_GET['page'])) {
        return "Création de compte";
    } else {
        return "Nothing";
    }
}

function isValid()
{
    $tabReturn = array("Retour" => false, "Error" => array());

    $ini = getConfigFile();
    $userName = strtolower($_POST['name']);
    $mdp = $_POST['mdp'];
    $email = $_POST['mail'];
    $mdpConfirm = $_POST['mdpverif'];
    $isReglementary = true;
    if (strlen($userName) < $ini['CONSTANTE']['size_user_name']) {
        $tabReturn['Error'][] = "Votre nom d'utilisateur est trop court, 6 caractères minimum ! <br>";
        $isReglementary = false;
    }

    if (strlen($mdp) < $ini['CONSTANTE']['size_user_mdp']) {
        $tabReturn['Error'][] = "Votre mot de passe est trop court, 5 caractères minimum ! <br>";
        $isReglementary = false;
    }
    if ($mdp != $mdpConfirm) {
        $tabReturn['Error'][] = "Les mots de passe ne correspondent pas ! <br>";
        $isReglementary = false;
    }

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
        $tabReturn['Error'][] = "Cette adresse mail est déjà utilisée, veuillez en choisir une autre ! <br>";
    if (!$validUserName)
        $tabReturn['Error'][] = "Ce login est déjà pris, veuillez en choisir en autre ! <br>";
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
        "mdp" => $_POST['mdp'],
        "telephone" => $_POST['gsm'],
        "contact" => $_POST['toContact'],

    ));

    $code_aleatoire = genererCode();
    $adresseAdmin = "no-reply@centrale-achat-apides.be";
    $to = $userToAdd->getMail();
    $sujet = "Confirmation de l'inscription";
    $entete = "From:" . $adresseAdmin . "\r\n";
    $entete .= "Content-Type: text/html; charset=utf-8\r\n";
    $message = "Nous confirmons que vous êtes officiellement inscrit sur le site EveryDayIdea <br>
									Votre login est : " . $userToAdd->getNomSociete() . " <br>
									Votre email est : " . $userToAdd->getMail() . " <br>
									Votre mot de passe temporaire est : " . $userToAdd->getMdp() . " <br>
									Votre lien d'activation est : <a href='http://www.everydayidea.be/Page/activationInscription.page.php?code=" . $code_aleatoire . "'>Cliquez ici !</a>";
    mail($to, $sujet, $message, $entete);

    /** @var $um : un nouvel user qui va être ajouté à la BDD
    J'ajoute le nouvel user à la BDD*/
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
        "id_user" => $userid,
        "libelle" => "Inscription",
    ));
    $am->addActivation($activation);


}

?>