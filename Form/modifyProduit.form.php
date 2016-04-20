<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 13:41
 */

?>

<form enctype='multipart/form-data' action="index.php?page=modifyProduit&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Nom :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $produit->getProduit();?>"required>
    <label class="contact" for="image" ><strong>Image: </strong></label>
    <input name="image" size="30" type="file" onchange="readURL(this);" accept="image/x-png, image/gif, image/jpeg" /><br>
    <img id="show" style="padding-left : 10em; max-height: 200px; max-width: 150px" src="../Style/images/produits/<?php echo $id.".png" ?>" alt="your image" /> <br>
    <label class="contact" for="fournisseur"><strong>Fournisseur :</strong></label>

    <select name='fournisseur' id='fournisseur' class="contact_input">
        <?php

        foreach($tabFourni as $elem) {
            if ($elem->getId() == $produit->getFournisseur()->getId()) {
                echo "<option value='" . $elem->getId() . "' selected>" . $elem->getLibelle() . "</option>";

            } else {
                echo "<option value='" . $elem->getId() . "'>" . $elem->getLibelle() . "</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="section"><strong>Section :</strong></label>

    <select name='section' id='section' class="contact_input">
        <?php

        foreach($tabSection as $elem) {
            if ($elem->getId() == $produit->getSection()->getId())  {
                echo "<option value='" . $elem->getId() . "' selected>" . $elem->getLibelle() . "</option>";

            } else {
                echo "<option value='" . $elem->getId() . "'>" . $elem->getLibelle() . "</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="marque"><strong>Marque :</strong></label>

    <select name='marque' id='marque' class="contact_input">
        <?php

        foreach($tabMarque as $elem) {
            if ($elem->getId() == $produit->getMarque()->getId()) {
                echo "<option value='". $elem->getId() ."' selected>". $elem->getLibelle() ."</option>";

            } else {
                echo "<option value='" . $elem->getId() . "'>" . $elem->getLibelle() . "</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="tva"><strong>TVA :</strong></label>

    <select name='tva' id='tva' class="contact_input">
        <?php

        foreach($tabTVA as $elem) {
            if ($elem->getId() == $produit->getTVA()->getId()) {
                echo "<option value='". $elem->getId() ."' selected>". $elem->getTexteTVA() ."</option>";

            } else {
                echo "<option value='" . $elem->getId() . "'>" . $elem->getTexteTVA() . "</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="code"><strong>Code produit :</strong></label>
    <input type="number" class="contact_input" id="code" name="code" value="<?php echo $produit->getCodeProduit(); ?>"required>
    <label class="contact" for="ean"><strong>EAN :</strong></label>
    <input type="number" class="contact_input" id="ean" name="ean" value="<?php echo $produit->getEAN(); ?>" required>
    <label class="contact" for="dlv"><strong>DLV :</strong></label>
    <input type="text" class="contact_input" id="dlv" name="dlv"  value="<?php echo $produit->getDLV(); ?>">
    <label class="contact" for="prix"><strong>Prix HTVA (€):</strong></label>
    <input type="number" class="contact_input" id="prix" name="prix"  value="<?php echo $produit->getPrixHTVA(); ?>" required>
    <label class="contact" for="poids"><strong>Poids (kg/l) :</strong></label>
    <input type="text" class="contact_input" id="poids" name="poids" value="<?php echo $produit->getPoids(); ?>" >
    <label class="contact" for="groupement"><strong>Groupement :</strong></label>
    <input type="text" class="contact_input" id="groupement" name="groupement" value="<?php echo $produit->getGroupement(); ?>">
    <div style="display:inline-block;margin-left:-18em;">
        <label class="contact" for="promo"><strong>En promotion :</strong></label>
        <?php if ($produit->getPromo() != 1) {
            echo "<input  type='radio' name='promo' value='0' checked> Non";
            echo "<input  type='radio' name='promo' value='1'> Oui";
        } else {
            echo "<input  type='radio' name='promo' value='0' > Non";
            echo "<input  type='radio' name='promo' value='1' checked> Oui";
        }
        ?>
    </div>
    <br>
    <div style="display:inline-block;margin-left:-18em;" >
        <label class="contact" for="actif"><strong>Actif :</strong></label>
        <?php if ($produit->getProduitActif() != 1) {
            echo "<input  type='radio' name='actif' value='0' checked> Non";
            echo "<input  type='radio' name='actif' value='1'> Oui";
        } else {
            echo "<input  type='radio' name='actif' value='0' > Non";
            echo "<input  type='radio' name='actif' value='1' checked> Oui";
        }
        ?>
    </div>
    <div class="form_row" >
        <button type="submit"  name="modifProduit" id="btnCompte">Modifier le produit</button>
    </div>
</form>