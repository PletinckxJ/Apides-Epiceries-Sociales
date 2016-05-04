<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 03/05/2016
 * Time: 08:40
 */

function modifyProfil() {
    $um = new UserManager(connexionDb());
    $tabError = array();
    if (isset($_POST['modifyAccount'])) {
        $user = $_SESSION['Utilisateur'];
        if ($_POST['name'] != $user->getNomSociete()) {
            $test = $um->getUserByUserName($_POST['name']);
            if ($test->getId() != NULL) {
                $tabError[] = "Ce nom de société existe déjà";
            } else {
                $user->setNomSociete($_POST['name']);
            }
        }

        $user->setContact($_POST['toContact']);
        $user->setTelephone($_POST['gsm']);
        if ($_POST['mail'] != $user->getMail()) {
            $test = $um->getUserByEmail($_POST['mail']);
            if ($test->getId() != NULL) {
                $tabError[] = "Ce mail existe déjà";
            } else {
                $user->setMail($_POST['mail']);
            }
        }
        $user->setAdresse($_POST['adresse']);
        $user->setVille($_POST['ville']);
        $user->setCode($_POST['code']);
        if (isset($_POST['mdp']) && isset($_POST['mdpverif']) && $_POST['mdp'] == $_POST['mdpverif']) {
            $user->setMdp($_POST['mdp']);
            $user->setHashMdp();
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