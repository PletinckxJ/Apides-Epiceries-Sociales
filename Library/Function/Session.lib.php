<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 12:38
 */


/**
 * Fonction faisant débuter la session.
 */
function startSession()
{
    session_name("Apides");
    session_start();
}

/**
 * Fonction permettant de savoir si un utilisateur est connecter
 * @return bool : true si il est connecté, false sinon.
 */
function isConnect()
{
    return (isset($_SESSION['Utilisateur']));
}

/**
 * Fonction permettant de récupérer la variable session lié à un utilisateur
 * @return string
 */
function getSessionUser()
{
    return (isConnect() ? $_SESSION['Utilisateur'] : new User(array()));
}

/**
 * Fonction permettant de générer la session de l'utilisateur.
 * @param User $user : l'utilisateur concerné.
 */
function setSessionUser(Utilisateur $user)
{
    $_SESSION['Utilisateur'] = $user;
}
