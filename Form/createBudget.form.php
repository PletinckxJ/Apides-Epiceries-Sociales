<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 15:19
 */

?>

<form action="index.php?page=createBudget" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Situation familiale :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <label class="contact" for="montant"><strong>Montant :</strong></label>
    <input type="number" class="contact_input" id="montant" name="montant" required>
    <div class="form_row">
        <button type="submit"  name="creerBudget" id="btnCompte">Créer le budget</button>
    </div>
</form>
