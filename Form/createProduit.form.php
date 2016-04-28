<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 10:38
 */

$fm = new FournisseurManager(connexionDb());
$tabFourni = $fm->getAllFournisseur();
$mm = new MarqueManager(connexionDb());
$tabMarque = $mm->getAllMarque();
$tm = new TVAManager(connexionDb());
$tabTVA = $tm->getAllTVA();
$sm = new SectionManager(connexionDb());
$tabSection = $sm->getAllSection();
?>

<form enctype='multipart/form-data' action="index.php?page=produit&option=create" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Nom* :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <label class="contact" for="image" ><strong>Image: </strong></label>
    <input name="image" size="30" type="file" onchange="readURL(this);" accept="image/x-png, image/gif, image/jpeg" />
    <img id="show" style="display:none;padding-left : 10em;" src="#" alt="your image" /> <br>
    <label class="contact" for="fournisseur"><strong>Fournisseur* :</strong></label>

    <select name='fournisseur' id='fournisseur' class="contact_input">
        <?php

        foreach($tabFourni as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="section"><strong>Section* :</strong></label>

    <select name='section' id='section' class="contact_input">
        <?php

        foreach($tabSection as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="marque"><strong>Marque* :</strong></label>

    <select name='marque' id='marque' class="contact_input">
        <?php

        foreach($tabMarque as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="tva"><strong>TVA* :</strong></label>

    <select name='tva' id='tva' class="contact_input">
        <?php

        foreach($tabTVA as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getTexteTVA() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="code"><strong>Code produit* :</strong></label>
    <input type="number" class="contact_input" id="code" name="code" required>
    <label class="contact" for="ean"><strong>EAN :</strong></label>
    <input type="number" class="contact_input" id="ean" name="ean">
    <label class="contact" for="dlv"><strong>DLV :</strong></label>
    <input type="text" class="contact_input" id="dlv" name="dlv" >
    <label class="contact" for="prix"><strong>Prix HTVA (€)*:</strong></label>
    <input type="number" step="any" class="contact_input" id="prix" name="prix"  required>
    <label class="contact" for="poids"><strong>Quantité (kg/l) :</strong></label>
    <input type="text" step="any" class="contact_input" id="poids" name="poids" >
    <label class="contact" for="groupement"><strong>Groupement* :</strong></label>
    <input type="text" class="contact_input" id="groupement" name="groupement" required>
    <div style="display:inline-block;margin-left:-18em;">
        <label class="contact" for="promo"><strong>En promotion* :</strong></label>
        <input class=contact_input" type="radio" name="promo" value="0" checked> Non
        <input class=contact_input" type="radio" name="promo" value="1"> Oui
    </div>
    <br>
    <div style="display:inline-block;margin-left:-18em;" >
        <label class="contact" for="actif"><strong>Actif* :</strong></label>
        <input type="radio" name="actif" value="0" > Non
        <input type="radio" name="actif" value="1" checked> Oui
    </div>
    <div class="form_row" >
        <button type="submit"  name="createProduit" id="btnCompte">Créer le produit</button>
    </div>
</form>
