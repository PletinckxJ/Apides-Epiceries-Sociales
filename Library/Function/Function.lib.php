<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 13:23
 */

/**
 * Fonction servant à générer un code aléatoire servant au mot de passe oublié ou à l'activation.
 * @return string : le code généré.
 */
function genererCode() {
    $characts    = 'abcdefghijklmnopqrstuvwxyz';
    $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characts   .= '1234567890';
    $code_aleatoire      = '';

    for($i=0;$i < 6;$i++)    //10 est le nombre de caractères
    {
        $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
    }
    return $code_aleatoire;
}

function membreExistant() {
    $id = $_GET['id'];
    $um = new UserManager(connexionDb());
    $user = $um->getUserById($id);
    if ($user->getNomSociete() == NULL) {
        return false;
    } else {
        return true;
    }
}

function benefExistant() {
    $id = $_GET['id'];
    $bm = new BeneficiaireManager(connexionDb());
    $benef = $bm->getBeneficiaireById($id);
    if ($benef->getNumeroRegistre() == NULL) {
        return false;
    } else {
        return true;
    }
}

function budgetExistant() {
    $id = $_GET['id'];
    $bm = new BudgetManager(connexionDb());
    $budget = $bm->getBudgetById($id);
    if ($budget->getSituationFam() == NULL) {
        return false;
    } else {
        return true;
    }
}

function produitExistant() {
    $id = $_GET['id'];
    $pm = new ProduitManager(connexionDb());
    $produit = $pm->getProduitById($id);
    if ($produit->getCodeProduit() == NULL) {
        return false;
    } else {
        return true;
    }
}

function fournisseurExistant() {
    $id = $_GET['id'];
    $fm = new FournisseurManager(connexionDb());
    $fournisseur = $fm->getFournisseurById($id);
    if ($fournisseur->getLibelle() == NULL) {
        return false;
    } else {
        return true;
    }
}

function marqueExistant() {
    $id = $_GET['id'];
    $mm = new MarqueManager(connexionDb());
    $marque = $mm->getMarqueById($id);
    if ($marque->getLibelle() == NULL) {
        return false;
    } else {
        return true;
    }
}

function sectionExistant() {
    $id = $_GET['id'];
    $sm = new SectionManager(connexionDb());
    $section = $sm->getSectionById($id);
    if ($section->getLibelle() == NULL) {
        return false;
    } else {
        return true;
    }
}

function TVAExistant() {
    $id = $_GET['id'];
    $tm = new TVAManager(connexionDb());
    $tva = $tm->getTVAById($id);
    if ($tva->getTexteTVA() == NULL) {
        return false;
    } else {
        return true;
    }
}

/**
 * Fonction servant à charger une image et la mettre dans un dossier du serveur.
 * @param $repertoire : le répertoire d'arrivée de l'image.
 * @param $nom : le nom de l'image.
 */
function uploadImage($repertoire, $nom) {
    $repertoire = $repertoire.'/'; // dossier où sera déplacé le fichier
    $type = "";
    $nomPhoto = "";
    $photo = $_FILES['image']['tmp_name'];
    if( !is_uploaded_file($photo) ) {
        exit("Le fichier est introuvable <br>");
    }
    // on vérifie maintenant l'extension
    $typePhoto = $_FILES['image']['type'];
    if( strstr($typePhoto, 'jpg') or strstr($typePhoto, 'jpeg')) {

        $type = "jpg";
    } else if ( strstr($typePhoto, 'png')) {

        $type = "png";
    } else if ( strstr($typePhoto, 'gif')) {

        $type = "gif";
    }
    // on copie le fichier dans le dossier de destination

    $nomPhoto = $nom.'.png';


    $donnees=getimagesize($photo);
    $nouvelleLargeur = 250;
    $reduction = ( ($nouvelleLargeur * 100) / $donnees[0]);
    $nouvelleHauteur = ( ($donnees[1] * $reduction) / 100);
    if ($type == "jpg") {
        $image = imagecreatefromjpeg($photo);
    } else if ($type == "png") {
        $image = imagecreatefrompng($photo);
    } else if ($type == "gif") {
        $image = imagecreatefromgif($photo);
    }
    $image_mini = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur); //création image finale
    imagecopyresampled($image_mini, $image, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $donnees[0], $donnees[1]);//copie avec redimensionnement
    imagepng($image_mini, $repertoire.$nomPhoto);

}


?>