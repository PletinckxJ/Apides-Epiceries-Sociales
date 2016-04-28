<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:04
 */
?>
<form action="index.php?page=createMarque" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Marque* :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <div class="form_row">
        <button type="submit"  name="creerMarque" id="btnCompte">Créer la marque</button>
    </div>
</form>