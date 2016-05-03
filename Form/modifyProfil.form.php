<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 02/05/2016
 * Time: 13:53
 */

echo "<form action='index.php' method='post' style='width:550px;margin-left:200px;' class='formCreation'>";
$user = $_SESSION['Utilisateur'];
?>

<label class="contact" for="name"><strong>Nom de société :</strong></label>
<input type="text" class="contact_input" id="name" name="name" value="<?php echo $user->getNomSociete(); ?>"required>
<label class="contact" for="toContact"><strong>Personne de contact :</strong></label>
<input type="text" class="contact_input" id="toContact" name="toContact" value="<?php echo $user->getContact(); ?>" required>
<label class="contact" for="gsm"><strong>Téléphone :</strong></label>
<input type="text" class="contact_input" id="gsm" name="gsm" value="<?php echo $user->getTelephone(); ?>">
<label class="contact" for="mail"><strong>Mail :</strong></label>
<input type="email" class="contact_input" id="mail" name="mail" value="<?php echo $user->getMail(); ?>" required>
<label class="contact" for="adresse"><strong>Adresse :</strong></label>
<input type="text" class="contact_input" id="adresse" name="adresse" value="<?php echo $user->getAdresse(); ?>"required>
<label class="contact" for="ville"><strong> Ville  :</strong></label>
<input type="text" class="contact_input" id="ville" name="ville" value="<?php echo $user->getVille(); ?>"required>
<label class="contact" for="code"><strong>Code postal :</strong></label>
<input type="number" class="contact_input" id="code" name="code" value="<?php echo $user->getCode(); ?>"required>
<label class="contact" for="mdp"><strong>Nouveau Mot de passe :</strong></label>
<input type="password" class="contact_input" id="txtNewPassword" name="mdp" onchange="checkPasswordMatch();">
<label class="contact" for="mdpverif"><strong>Vérification du mot de passe :</strong></label>
<input type="password" class="contact_input" id="txtConfirmPassword" name="mdpverif" onchange="checkPasswordMatch();" >
<label for="error" class="alert alert-danger" id="contact" style=" display:none;">Les mots de passe ne correspondent pas</label>
<div class="form_row">
    <button type="submit"  name="modifyAccount" id="btnCompte">Modifier le compte</button>
</div>
</form>

