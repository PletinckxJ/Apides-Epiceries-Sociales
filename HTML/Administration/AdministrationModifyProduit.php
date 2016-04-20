<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 13:54
 */

$id = $_GET['id'];
$pm = new ProduitManager(connexionDb());
$produit = $pm->getProduitById($id);
$fm = new FournisseurManager(connexionDb());
$sm = new SectionManager(connexionDb());
$mm = new MarqueManager(connexionDb());
$tm = new TVAManager(connexionDb());
$tabFourni = $fm->getAllFournisseur();
$tabSection = $sm->getAllSection();
$tabMarque = $mm->getAllMarque();
$tabTVA = $tm->getAllTVA();

require("../Form/modifyProduit.form.php");
if (isset($_POST['modifProduit'])) {
    if (modifyProduit($produit)) {
        ob_clean();
       header("Location :index.php?page=produit");
    } else  {
        echo "<label class='contact' style='color:Red; width:350px;'>Le produit existe déjà</label>";
    }

}
?>