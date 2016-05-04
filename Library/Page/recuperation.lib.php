<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 04/05/2016
 * Time: 13:53
 */

function sendMail() {
    if (isset($_POST['mail'])) {
        $um = new UserManager(connexionDb());
        $user = $um->getUserByEmail($_POST['mail']);
        if ($user->getId() != NULL) {
            $act = new Activation(array(
                'id_utilisateur' => $user->getId(),
                'libelle' => "Recuperation",
                'code' => genererCode()
            ));
            $am = new ActivationManager(connexionDb());
            $testActi = $am->getActivationByLibelleAndId("Inscription",$user->getId());
            if ($testActi->getCode() == NULL) {
                $am->deleteActivationByIdAndLibelle($user->getId(), "Recuperation");
                $am->addActivation($act);
                $adresseAdmin = "no-reply@centrale-achat-apides.be";
                $to = $user->getMail();
                $sujet = "Recuperation de votre mot de passe";
                $entete = "From:" . $adresseAdmin . "\r\n";
                $entete .= "MIME-Version: 1.0\r\n";
                $entete .= "Content-Type: text/html; charset=windows-1252\r\n";
                $message = '<html><body>';
                $message .= '<div align="center"><img  src="http://www.centrale-achat-apides.be//Style/images/logo_apides_site1.png" alt="Recuperation mdp" /></div><br><br><br>';
                $message .= "<div align='center'><strong><br> Il semblerait que vous ayez perdu votre mot de passe !</strong></div><br><br><br>";
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10" align="center">';
                $message .= "<tr><td><strong>Code à entrer lors de la récupération :</strong> </td><td>" . $act->getCode() . "</td></tr>";
                $link = "http://www.centrale-achat-apides.be/Recuperation/index.php?page=code";
                $message .= "<tr><td><strong>Cliquez sur ce lien pour confirmer l'inscription :</strong> </td><td><a href=$link target='_blank'>http://www.centrale-achat-apides.be/Recuperation/index.php?page=code </a></td></tr>";
                $message .= "</table>";

                $message .= "</body></html>";
                mail($to, $sujet, $message, $entete);
                return 1;
            } else {
                return  2;
            }
        } else {
            return 3;
        }
    }
}

function validateCodeRecup() {
    $secret = "6Le2CR8TAAAAAIl3V_MyvFnEgsHDUtPHw-DnRqcW";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    $tabError = array();
    $goodCode = false;
    $captchaOK = false;
    if (isset($_POST['g-recaptcha-response'])) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER['REMOTE_ADDR'],
            $_POST['g-recaptcha-response']
        );
    }
    if ($response != null && $response->success) {
        $captchaOK = true;
    }

    if (isset($_POST['code'])) {
        $am = new ActivationManager(connexionDb());
        $verif = $am->getActivationByCode($_POST['code']);

        if (isset($verif) && $verif->getLibelle() == "Recuperation") {
            $goodCode = true;
        }

    }

    if (!$goodCode) {
        $tabError[] = "<span class='alert alert-danger' style='font-size:14px;'>Ce code n'est pas correct, entrez bien celui reçu par mail !</span><br><br>";
    }
    if (!$captchaOK) {
        $tabError[] = "<span class='alert alert-danger' style='float:left;margin-left:1.5em;'>Le captcha n'a pas été bien résolu, recommencez ! </span><br>";
    }

    if ($goodCode && $captchaOK) {
        $tabError[] = "<span class='alert alert-success'>Entrez votre nouveau mot de passe</span>";
        $um = new UserManager(connexionDb());
        $user = $um->getUserById($verif->getIdUser());
        $_POST['OK'] = true;
        $_SESSION['Temp'] = $user;

    }

    return $tabError;
}

function validateChangementMdp() {
    if (isset($_POST['mdp']) && isset($_POST['mdpverif']) && $_POST['mdp'] == $_POST['mdpverif']) {
        $_SESSION['Temp']->setMdp($_POST['mdp']);
        $_SESSION['Temp']->setHashMdp();
        $um = new UserManager(connexionDb());
        $um->updateUserMdp($_SESSION['Temp']);
        $am = new ActivationManager(connexionDb());
        $am->deleteActivationByIdAndLibelle($_SESSION['Temp']->getId(), "Recuperation");
        unset($_SESSION['Temp']);
        $_SESSION['WIN'] =  "<span class='alert alert-success'>Votre mot de passe a été changé ! Connectez-vous</span>";
        header("Location :../index.php");

    } else {
        return "<span class='alert alert-danger' style='font-size:14px;'>Les mots de passe ne correspondent pas !</span>";
    }
}