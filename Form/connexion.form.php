<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07-04-16
 * Time: 12:03
 */

?>

<form action="index.php" method="post">
        <label for="userName">Nom d'utilisateur :  </label>
            <input type="text" class="form-control" id="userName" name="userName" placeholder="Votre nom d'utilisateur" required>
        <br><br>
        <label for="mdp">Mot de passe :</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez votre mot de passe" required>
        <br><br>
            <button type="submit" class="btn btn-default" name="formulaire" id="formulaire">Se Connecter</button>
        <br><br>
            <a href="./mdpOublie.page.php"> Mot de passe oublié ? </a>
</form>

