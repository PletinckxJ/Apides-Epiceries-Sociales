<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 04/05/2016
 * Time: 10:25
 */

function validateCode() {
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

        if (isset($verif) && $verif->getLibelle() == "Inscription") {
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
        $tabError[] = "<span class='alert alert-success'>Entrez votre mot de passe pour finaliser votre compte</span>";
        $um = new UserManager(connexionDb());
        $user = $um->getUserById($verif->getIdUser());
        $_POST['OK'] = true;
        $_SESSION['Temp'] = $user;

    }

    return $tabError;
}

function validateMdp() {
    if (isset($_POST['mdp']) && isset($_POST['mdpverif']) && $_POST['mdp'] == $_POST['mdpverif']) {
        $_SESSION['Temp']->setMdp($_POST['mdp']);
        $_SESSION['Temp']->setHashMdp();
        $um = new UserManager(connexionDb());
        $um->updateUserMdp($_SESSION['Temp']);
        $am = new ActivationManager(connexionDb());
        $am->deleteActivationByIdAndLibelle($_SESSION['Temp']->getId(), "Inscription");
        unset($_SESSION['Temp']);
        $_SESSION['WIN'] =  "<span class='alert alert-success'>Votre inscription est finalisée ! Connectez-vous</span>";
        header("Location :../index.php");

    } else {
        return "<span class='alert alert-danger' style='font-size:14px;'>Les mots de passe ne correspondent pas !</span>";
    }
}