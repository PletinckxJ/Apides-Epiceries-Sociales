<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 04/05/2016
 * Time: 13:48
 */

if (!isset($_GET['page'])) {
?>
<form action="" method="post">
        <label for="userName">Votre e-mail :  </label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="E-mail lié à votre compte" required>
        <br><br>
            <button type="submit" class="btn btn-default" style="width:350px" name="formulaire" id="formulaire">Récupérer mon mot de passe</button>
    <br><br>
</form>
<?php
} else if (isset($_POST['OK']) && $_POST['OK']) { ?>
    <form action="" method="post">
    <label for="error" class="alert alert-danger"  style=" display:none;float:left;margin-left:4em;margin-bottom:1em;">Les mots de passe ne correspondent pas</label><br>
    <label for="mdp">Nouveau Mot de passe :</label>
    <input type="password" class="form-control" id="txtNewPassword" name="mdp" onchange="checkPasswordMatch();" required>
    <br><br>
    <label  for="mdpverif">Vérification du mot de passe :</label>
    <input type="password"class="form-control" id="txtConfirmPassword" name="mdpverif" onchange="checkPasswordMatch();" required>
    <br><br>
    <button type="submit" class="btn btn-default" style="width:200px;" name="formulaire" id="btnCompte">Changer mon mot de passe</button>
    <br><br>
</form>
<br>

<?php } else if (isset($_GET['page']) && $_GET['page'] == 'code') { ?>
    <form action="" method="post">
        <label for="code">Code de récupération :  </label>
        <br><br><input type="text" class="form-control" id="code" name="code" placeholder="Code reçu par mail" required>
        <br><br>
        <div align="center" class="g-recaptcha" data-sitekey="6Le2CR8TAAAAADkBy2vFKPogbnuFWx0KQPFcVLd1"></div><br><br>
        <button type="submit" class="btn btn-default" style="width:200px;" name="formulaire" id="formulaire">Changer mon mot de passe</button>
        <br><br>
    </form>
    <br>
    <?php } ?>