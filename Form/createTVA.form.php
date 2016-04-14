<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:39
 */
?>
<form action="index.php?page=createTVA" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Taux (%) :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <div class="form_row">
        <button type="submit"  name="creerTVA" id="btnCompte">Créer la TVA</button>
    </div>
</form>