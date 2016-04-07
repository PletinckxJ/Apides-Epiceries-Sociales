<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 12:31
 */

/**
* Fonction v�rifiant l'identit� du membre et le connectant si il poss�de la bonne identit�.
 * @return array : tableau de message d'erreur dans le cas o� ses informations sont fausses, si il est banni ou encore
* si il ne s'est pas activ�.
 */
function doConnect()
{
    $tabRetour = array();

    $mdp = $_POST['mdp'];
    $userName = $_POST['userName'];
    $manager = new UserManager(connexionDb());

    $userFound = $manager->getUserByUserName($userName);
    /**
     * Je v�rifie sur le user est dans la base de donn�e et existe bel et bien
     */
    $echec = true;
    if ($userFound->getId() != NULL) {
        if($userFound->getmdp() == hash("sha256", $mdp.$userFound->getSalt()) ) {
            $echec = false;
        }
    }

    /**
     * Je v�rifie que le user n'a pas besoin de s'activer avant de se connecter, l'user pouvant avoir
    * deux code (inscription et mdp oubli�), je v�rifie que c'est bien le code d'inscription
    */
    $needActi = false;
    if (!$echec) {
        $acManager = new ActivationManager(connexionDb());
        $act = $acManager->getActivationByLibelleAndId("Inscription",$userFound->getId());
        if (isset($act) && $act->getCode() != NULL)
            $needActi = true;
    }
    if ($echec == true) {
        $tabRetour['Error'] = "<div class='danger' role='alert'>Erreur lors de la connexion, veuillez r��ssayer avec le bon nom d'utilisateur ou mot de passe !</div>";
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