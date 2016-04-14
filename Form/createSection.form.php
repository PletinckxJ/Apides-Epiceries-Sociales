<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 15:15
 */

?>

<form action="index.php?page=createSection" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Section :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <div class="form_row">
        <button type="submit"  name="creerSection" id="btnCompte">Créer la section</button>
    </div>
</form>

