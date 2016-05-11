<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11/05/2016
 * Time: 10:36
 */

require "../../Manager/FournisseurManager.manager.php";
require "../../Entity/Fournisseur.class.php";
require('../Function/Session.lib.php');
require('../Function/Config.lib.php');
require('../Function/Database.lib.php');

$fm = new FournisseurManager(connexionDb());
$data = $fm->getFournisseurByName($_GET['term']);
echo json_encode($data);