<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/05/2016
 * Time: 08:31
 */


include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");
?>

<?php

if (isConnect()) {
    include("../HTML/Contact/contactContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>