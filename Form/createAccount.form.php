<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:36
 */

?>
<form action="index.php?page=users&option=createAccount" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Nom de société* :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <label class="contact" for="toContact"><strong>Personne de contact* :</strong></label>
    <input type="text" class="contact_input" id="toContact" name="toContact" required>
    <label class="contact" for="gsm"><strong>Téléphone :</strong></label>
    <input type="text" class="contact_input" id="gsm" name="gsm">
    <label class="contact" for="mail"><strong>Mail* :</strong></label>
    <input type="email" class="contact_input" id="mail" name="mail" required>
    <label class="contact" for="adresse"><strong>Adresse* :</strong></label>
    <input type="text" class="contact_input" id="adresse" name="adresse" required>
    <label class="contact" for="ville"><strong>Ville* :</strong></label>
    <input type="text" class="contact_input" id="ville" name="ville" required>
    <label class="contact" for="code"><strong>Code postal* :</strong></label>
    <input type="number" class="contact_input" id="code" name="code" required>
    <label class="contact" for="mdp"><strong>Mot de passe* :</strong></label>
    <input type="password" class="contact_input" id="txtNewPassword" name="mdp" onchange="checkPasswordMatch();"required>
    <label class="contact" for="mdpverif"><strong>Vérification du mot de passe* :</strong></label>
    <input type="password" class="contact_input" id="txtConfirmPassword" name="mdpverif" onchange="checkPasswordMatch();" required>
    <label for="error" class="contact" style="color:Red; display:none;width:350px;">Les mots de passe ne correspondent pas</label>
    <div class="form_row">
        <button type="submit"  name="formulaire" id="btnCompte">Créer le compte</button>
    </div>
</form>
