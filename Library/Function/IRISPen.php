<?php
/**
 * Created by PhpStorm.
 * User: JulienTour
 * Date: 15/06/2016
 * Time: 16:22
 */

if (isset($_POST['result'])) {

    $tabScan = array();
    $string = utf8_decode($_POST['result']);
    $string = trim($string);
    $string = str_replace(" ", "", $string);
    preg_replace("/\s/", "", $string);
    preg_match("/.{3}/", $string, $textetva);
    $string = str_replace($textetva[0], "", $string);
    $string = trim($string);
    preg_match("/(A|C)/i", $textetva[0], $tva);
    preg_match("/((\d{4,5})|(D\d{4,6}))/", $string, $code);
    $string = str_replace($code[0], "", $string);
    $string = trim($string);
    $string = substr($string, 1);
    preg_match("/.(.*)/", $string, $textenom);
    preg_match("/((\d.{1,4}(cl|L|kg|g))|(\d{1,4}(cl|L|kg|g)))/", $textenom[1], $quant);
    if (isset($quant[0])) {
        $nom = str_replace($quant[0], "", $textenom[0]);
        $tabScan[3] = $quant[0];
    } else {
        $nom = $textenom[0];
    }
    $tabScan[0] = $tva[0];
    $tabScan[1] = $code[0];
    $tabScan[2] = utf8_encode($nom);
    exit(json_encode($tabScan));
}
