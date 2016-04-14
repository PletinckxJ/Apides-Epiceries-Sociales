<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:41
 */
?>
<form action="index.php?page=createFournisseur" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Fournisseur :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <div class="form_row">
        <button type="submit"  name="creerFourni" id="btnCompte">Créer le fournisseur</button>
    </div>
</form>
