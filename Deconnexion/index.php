<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:54
 */

require "../Library/Function/Session.lib.php";
startSession();
session_unset();
session_destroy();
header('Location: ../index.php');

?>