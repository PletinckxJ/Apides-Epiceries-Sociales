<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 02/05/2016
 * Time: 13:53
 */

echo "<form action='index.php' method='post' class='formCreation'>";
?>
<label class="contact" for="name"><strong>Nom de société :</strong></label>
<input type="text" class="contact_input" id="name" name="name" value="<?php echo $user->getNomSociete(); ?>"required>
<label class="contact" for="toContact"><strong>Personne de contact :</strong></label>
<input type="text" class="contact_input" id="toContact" name="toContact" value="<?php echo $user->getContact(); ?>" required>
<label class="contact" for="gsm"><strong>Téléphone :</strong></label>
<input type="text" class="contact_input" id="gsm" name="gsm" value="<?php echo $user->getTelephone(); ?>">
<label class="contact" for="mail"><strong>Mail :</strong></label>
<input type="email" class="contact_input" id="mail" name="mail" value="<?php echo $user->getMail(); ?>" required>
<label class="contact" for="grade"><strong>Grade :</strong></label>
<label class="contact" for="adresse"><strong>Adresse :</strong></label>
<input type="text" class="contact_input" id="adresse" name="adresse" value="<?php echo $user->getAdresse(); ?>"required>
<label class="contact" for="ville"><strong> Ville  :</strong></label>
<input type="text" class="contact_input" id="ville" name="ville" value="<?php echo $user->getVille(); ?>"required>
<label class="contact" for="code"><strong>Code postal :</strong></label>
<input type="number" class="contact_input" id="code" name="code" value="<?php echo $user->getCode(); ?>"required>
<label class="contact" for="mdp"><strong>Mot de passe :</strong></label>
<input type="password" class="contact_input" id="txtNewPassword" name="mdp" onchange="checkPasswordMatch();"required>
<label class="contact" for="mdpverif"><strong>Vérification du mot de passe :</strong></label>
<input type="password" class="contact_input" id="txtConfirmPassword" name="mdpverif" onchange="checkPasswordMatch();" required>
<label for="error" class="contact" style="color:Red; display:none;width:350px;">Les mots de passe ne correspondent pas</label>
<div class="form_row">
    <button type="submit"  name="modifyAccount" id="btnCompte">Modifier le compte</button>
</div>
</form>