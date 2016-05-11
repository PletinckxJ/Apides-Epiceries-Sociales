<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 03/05/2016
 * Time: 08:40
 */
/**
function modifyProfil() {
    $um = new UserManager(connexionDb());
    $tabError = array();
    if (isset($_POST['modifyAccount'])) {
        $user = new Utilisateur(array());
        $user->setId($_SESSION['Utilisateur']->getId());
        $user->setDroit($_SESSION['Utilisateur']->getDroit());
        $user->setSalt($_SESSION['Utilisateur']->getSalt());
        if ($_POST['name'] != $_SESSION['Utilisateur']->getNomSociete()) {
            $test = $um->getUserByUserName($_POST['name']);
            if ($test->getId() != NULL) {
                $tabError[] = "Ce nom de société existe déjà";
            } else {
                $user->setNomSociete($_POST['name']);
            }
        } else {
            $user->setNomSociete($_SESSION['Utilisateur']->getNomSociete());
        }
        $user->setContact($_POST['toContact']);
        $user->setTelephone($_POST['gsm']);
        if ($_POST['mail'] != $_SESSION['Utilisateur']->getMail()) {
            $test = $um->getUserByEmail($_POST['mail']);
            if ($test->getId() != NULL) {
                $tabError[] = "Ce mail existe déjà";
            } else {
                $user->setMail($_POST['mail']);
            }
        } else {
            $user->setMail($_SESSION['Utilisateur']->getMail());
        }
        $user->setAdresse($_POST['adresse']);
        $user->setVille($_POST['ville']);
        $user->setCode($_POST['code']);
        if (isset($_POST['mdp']) && isset($_POST['mdpverif']) && $_POST['mdp'] == $_POST['mdpverif'] && $_POST['mdp'] != "") {
            $user->setMdp($_POST['mdp']);
            $user->setHashMdp();
        } else {
            $user->setMdp($_SESSION['Utilisateur']->getMdp());
        }
        if ($tabError[0] == NULL) {

            $um->updateUserProfil($user);
            $um->updateUserMdp($user);
            $_SESSION['Utilisateur'] = $user;
            //header('Location :index.php');
        }


    }
    return $tabError;
}
*/
function modifyProfilUser()
{
    $user = new Utilisateur(array());
    $user->setId($_SESSION['Utilisateur']->getId());
    $user->setNomSociete($_POST['name']);
    $user->setContact($_POST['toContact']);
    $user->setTelephone($_POST['gsm']);
    $user->setMail($_POST['mail']);
    $user->setVille($_POST['ville']);
    $user->setAdresse($_POST['adresse']);
    $user->setCode($_POST['code']);
    $user->setSalt($_SESSION['Utilisateur']->getSalt());
    $user->setDroit($_SESSION['Utilisateur']->getDroit());
    $um = new UserManager(connexionDb());
    $userTestName = $um->getUserByUserName($user->getNomSociete());
    $userTestMail = $um->getUserByEmail($user->getMail());
    if ($userTestName->getNomSociete() != NULL && $userTestName->getId() != $_GET['id'] && $_POST['name'] != $_SESSION['Utilisateur']->getNomSociete()) {
        $tabError[] = "Ce nom de société existe déjà";

    } else if ($userTestMail->getNomSociete() != NULL && $userTestMail->getId() != $_GET['id'] && $_POST['mail'] != $_SESSION['Utilisateur']->getMail()) {
        $tabError[] = "Ce mail existe déjà";
    } else {
        $um->updateUserProfil($user);
        if (isset($_POST['mdp']) && isset($_POST['mdpverif']) && $_POST['mdp'] == $_POST['mdpverif'] && $_POST['mdp'] != "") {
            $user->setMdp($_POST['mdp']);
            $user->setHashMdp();
            $um->updateUserMdp($user);
        } else {
            $user->setMdp($_SESSION['Utilisateur']->getMdp());
        }
        $_SESSION['Utilisateur'] = $user;
        //header('Location :index.php');
    }


}