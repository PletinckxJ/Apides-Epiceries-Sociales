<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/05/2016
 * Time: 08:58
 */

function sendContact() {
    if (isset($_POST['name']) && isset($_POST['desc'])) {
        $message = "<b>Titre</b> : " . stripslashes($_POST['name'])."<br><br> ".
            "\n <b>Email</b>: <a href='mailto:".$_SESSION['Utilisateur']->getMail()."'>" . $_SESSION['Utilisateur']->getMail() ."</a><br><br>".
            "\n\n <b>Message</b> : " . stripslashes($_POST['desc'])."<br><br>";
        $entete = "From:" . $_SESSION['Utilisateur']->getMail() . "\r\n";
        $entete .= "MIME-Version: 1.0\r\n";
        $entete .= "Content-Type: text/html; charset=windows-1252\r\n";
        $message .= "\n\n <div style='background-color:#9dbed0;height:35px;width:700px;'><div style='margin:2em;padding:1em;'><strong>Provenant de la page</strong><a href='". $_SERVER["HTTP_REFERER"]."'> " . $_SERVER["HTTP_REFERER"]."</a></div></div><br><br>";
        $message .= "\n\n <strong>Date </strong> : " . date("Y-m-d h:i:s")."<br><br>";
        $message .= "\n\n <strong>Utilisateur </strong> : ".$_SESSION['Utilisateur']->getNomSociete()." | ".$_SESSION['Utilisateur']->getContact()."";
        $siteEmail = 'centrale_achat@apides.be';
        $emailTitle = 'Message provenant de la centrale d\'achats';
        mail($siteEmail,$emailTitle,$message,$entete);
        return "<span class='alert alert-success' style='margin-left:9.5em;'>Message envoyé ! Nous vous répondrons bientôt.</span>";
    }


}