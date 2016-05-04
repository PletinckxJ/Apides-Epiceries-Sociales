<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 04/05/2016
 * Time: 10:18
 */


if (!$_POST['OK']) {
?>

<form action="" method="post">
    <label for="userName">Code de validation :  </label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Code reçu par mail" required>
    <br><br>
    <div align="center" class="g-recaptcha" data-sitekey="6Le2CR8TAAAAADkBy2vFKPogbnuFWx0KQPFcVLd1"></div><br><br>
    <button type="submit" class="btn btn-default" style="width:200px;" name="formulaire" id="formulaire">Valider l'inscription</button>
    <br><br>
</form>
<br>

<?php } else { ?>

<form action="" method="post">
    <label for="error" class="alert alert-danger"  style=" display:none;float:left;margin-left:4em;margin-bottom:1em;">Les mots de passe ne correspondent pas</label><br>
    <label for="mdp">Nouveau Mot de passe :</label>
    <input type="password" class="form-control" id="txtNewPassword" name="mdp" onchange="checkPasswordMatch();" required>
    <br><br>
    <label  for="mdpverif">Vérification du mot de passe :</label>
    <input type="password"class="form-control" id="txtConfirmPassword" name="mdpverif" onchange="checkPasswordMatch();" required>
    <br><br>
    <button type="submit" class="btn btn-default" style="width:200px;" name="formulaire" id="btnCompte">Finaliser l'inscription</button>
    <br><br>
</form>
<br>

<?php } ?>