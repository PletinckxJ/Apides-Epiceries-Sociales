<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11-04-16
 * Time: 14:15
 */

echo "<form action='index.php?page=modifyUser&id=$id' method='post' class='formCreation'>";
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
    <select name='grade' id='grade' class="contact_input">
        <?php

            foreach($tabDroit as $elem) {

            if ($elem->getId() == $user->getDroit()->getId()) {
            echo "<option value='". $elem->getId() ."' selected>". $elem->getLibelle() ."</option>";

            } else {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";

            }



            }
        ?>
    </select>
    <label class="contact" for="adresse"><strong>Adresse :</strong></label>
    <input type="text" class="contact_input" id="adresse" name="adresse" value="<?php echo $user->getAdresse(); ?>"required>
    <label class="contact" for="ville"><strong> Ville  :</strong></label>
    <input type="text" class="contact_input" id="ville" name="ville" value="<?php echo $user->getVille(); ?>"required>
    <label class="contact" for="code"><strong>Code postal :</strong></label>
    <input type="number" class="contact_input" id="code" name="code" value="<?php echo $user->getCode(); ?>"required>
    <div class="form_row">
        <button type="submit"  name="modifyAccount" id="btnCompte">Modifier le compte</button>
    </div>
</form>