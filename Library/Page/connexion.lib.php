<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 12:31
 */

/**
* Fonction vérifiant l'identité du membre et le connectant si il possède la bonne identité.
 * @return array : tableau de message d'erreur dans le cas où ses informations sont fausses, si il est banni ou encore
* si il ne s'est pas activé.
 */
function doConnect()
{
    $tabRetour = array();

    $mdp = $_POST['mdp'];
    $userName = $_POST['userName'];
    $manager = new UserManager(connexionDb());

    $userFound = $manager->getUserByUserName($userName);
    /**
     * Je vérifie sur le user est dans la base de donnée et existe bel et bien
     */
    $echec = true;
    if ($userFound->getId() != NULL) {
        if($userFound->getmdp() == hash("sha256", $mdp.$userFound->getSalt()) ) {
            $echec = false;
        }
    }

    /**
     * Je vérifie que le user n'a pas besoin de s'activer avant de se connecter, l'user pouvant avoir
    * deux code (inscription et mdp oublié), je vérifie que c'est bien le code d'inscription
    */
    $needActi = false;
    if (!$echec) {
        $acManager = new ActivationManager(connexionDb());
        $act = $acManager->getActivationByLibelleAndId("Inscription",$userFound->getId());
        if (isset($act) && $act->getCode() != NULL)
            $needActi = true;
    }
    if ($echec == true) {
        $tabRetour['Error'] = "<div class='danger' role='alert'>Erreur lors de la connexion, veuillez rééssayer avec le bon nom d'utilisateur ou mot de passe !</div>";
    }
    else if ($needActi == true)
        $tabRetour['Error'] = "<div class='danger' role='alert'>Vous devez activer votre compte avant la connexion !</div>";
    else  {
        $manager->updateUserConnect($userFound);
        startSession();
        setSessionUser($userFound);

    }
    return $tabRetour;
}