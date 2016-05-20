<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/05/2016
 * Time: 08:29
 */

?>
<link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
<div class="container">
<div class="jumbotron">
<h1> Contacter l'administrateur</h1>
    <p> Complétez le formulaire ci-dessous pour envoyer un message à l'administrateur</p>
</div>
</div>
<form action='index.php' method='post' style='width:700px;margin-left:200px;padding-bottom:50px;' class='formCreation'>
<label class="contact" for="name"><strong style="font-size : 14px;">Titre du message :</strong></label>
<input type="text" class="contact_input" id="name" name="name" style="height:30px;width:350px" required>
<label class="contact" for="desc"><strong style="font-size : 14px;">Message :</strong></label><br>
<textarea name="desc" class="contact_textarea" style="margin-left:1em;width:350px;height:250px;max-width:683px;" required></textarea>
    <div class="form_row">
        <button type="submit"  name="sendmess" id="btnCompte">Envoyer</button><br><br>
    </div>
    <?php
    echo sendContact();
    ?>
</form>

