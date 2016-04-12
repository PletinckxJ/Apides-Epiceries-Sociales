<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12-04-16
 * Time: 11:16
 */
$rm = new ReferentManager(connexionDb());
$tabReferent = $rm->getAllReferent();
$bm = new BudgetManager(connexionDb());
$tabBudget = $bm->getAllBudget();
?>

<form action="index.php?page=benef&option=create" method="post" class="formCreation">
    <label class="contact" for="referent"><strong>Grade :</strong></label>

    <select name='referent' id='referent' class="contact_input">
        <?php

        foreach($tabReferent as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="name"><strong>Nom :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <label class="contact" for="prenom"><strong>Prénom :</strong></label>
    <input type="text" class="contact_input" id="prenom" name="prenom" required>
    <label class="contact" for="address"><strong>Adresse :</strong></label>
    <input type="text" class="contact_input" id="address" name="address">
    <label class="contact" for="code"><strong>Code postal :</strong></label>
    <input type="text" class="contact_input" id="code" name="code"  required>
    <label class="contact" for="ville"><strong>Ville :</strong></label>
    <input type="text" class="contact_input" id="ville" name="ville"  required>
    <label class="contact" for="mail"><strong>Mail :</strong></label>
    <input type="email" class="contact_input" id="mail" name="mail" required>
    <label class="contact" for="gsm"><strong>Gsm :</strong></label>
    <input type="text" class="contact_input" id="gsm" name="gsm" required>
    <label class="contact" for="numReg"><strong>Numéro de registre national :</strong></label>
    <input type="text" class="contact_input" id="numReg" name="numReg" onchange="verifyReg();"  required>
    <label class="contact" for="budget"><strong>Budget :</strong></label>

    <select name='budget' id='budget' class="contact_input">
        <?php
        foreach($tabBudget as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getSituationFam()." | ".$elem->getBudgetMens() ." €</option>";
        }
        ?>
    </select>
    <label class="contact" for="note" style="margin-right:2em;"><strong>Note :</strong></label>
    <textarea name="note" id="note" style="width:253px; height:36px; float:left;"></textarea>
    <label for="error" class="contact" style="color:Red; display:none;width:350px;">Le numéro de registre existe déjà</label>
    <div class="form_row" >
        <button type="submit"  name="createBenef" id="btnCompte">Créer le bénéficiaire</button>
    </div>
</form>
