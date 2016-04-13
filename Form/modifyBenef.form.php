<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 11:25
 */


 echo "<form action='index.php?page=modifyBenef&id=$id' method='post' class='formCreation'>";
?>
    <label class="contact" for="referent"><strong>Référent :</strong></label>

    <select name='referent' id='referent' class="contact_input">
        <?php

        foreach($tabReferent as $elem) {
            if ($elem->getId() == $benef->getReferent()->getId()) {
                echo "<option value='" . $elem->getId() . "' selected>" . $elem->getLibelle() . "</option>";
            } else {
                echo "<option value='" . $elem->getId() . "'>" . $elem->getLibelle() . "</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="name"><strong>Nom :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $benef->getNom() ?>" required>
    <label class="contact" for="prenom"><strong>Prénom :</strong></label>
    <input type="text" class="contact_input" id="prenom" name="prenom" value="<?php echo $benef->getPrenom() ?>" required>
    <label class="contact" for="address"><strong>Adresse :</strong></label>
    <input type="text" class="contact_input" id="address" name="address" value="<?php echo $benef->getAdresse() ?>" required>
    <label class="contact" for="code"><strong>Code postal :</strong></label>
    <input type="number" class="contact_input" id="code" name="code"  value="<?php echo $benef->getCodePostal() ?>" required>
    <label class="contact" for="ville"><strong>Ville :</strong></label>
    <input type="text" class="contact_input" id="ville" name="ville" value="<?php echo $benef->getVille() ?>" required>
    <label class="contact" for="mail"><strong>Mail :</strong></label>
    <input type="email" class="contact_input" id="mail" name="mail" value="<?php echo $benef->getMail() ?>" required>
    <label class="contact" for="gsm"><strong>Gsm :</strong></label>
    <input type="text" class="contact_input" id="gsm" name="gsm" value="<?php echo $benef->getGsm() ?>">
    <label class="contact" for="reg"><strong>Numéro de registre national :</strong></label>
    <input type="text" class="contact_input" id="reg" name="reg"  value="<?php echo $benef->getNumeroRegistre() ?>" required>
    <label class="contact" for="budget"><strong>Budget :</strong></label>

    <select name='budget' id='budget' class="contact_input">
        <?php
        foreach($tabBudget as $elem) {
            if ($elem->getId() == $benef->getBudget()->getId()) {
                echo "<option value='" . $elem->getId() . "' selected>" . $elem->getSituationFam() . " | " . $elem->getBudgetMens() . " €</option>";
            } else {
                echo "<option value='". $elem->getId() ."' >". $elem->getSituationFam()." | ".$elem->getBudgetMens() ." €</option>";
            }
        }
        ?>
    </select>
    <label class="contact" for="note" style="margin-right:2em;"><strong>Note :</strong></label>
    <textarea name="note" id="note" style="width:253px; height:36px; float:left;"><?php echo $benef->getNote() ?></textarea>
    <div class="form_row" >
        <button type="submit"  name="modifBenef" id="btnCompte">Modifier le bénéficiaire</button>
    </div>
</form>