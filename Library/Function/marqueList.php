<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11/05/2016
 * Time: 10:53
 */

require "../../Manager/MarqueManager.manager.php";
require "../../Entity/Marque.class.php";
require('../Function/Session.lib.php');
require('../Function/Config.lib.php');
require('../Function/Database.lib.php');

$mm = new MarqueManager(connexionDb());
$data = $mm->getMarqueByName($_GET['term']);
echo json_encode($data);