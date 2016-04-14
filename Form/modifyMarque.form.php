<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:04
 */
?>
<form action="index.php?page=modifyMarque&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Marque :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $marque->getLibelle(); ?>" required>
    <div class="form_row">
        <button type="submit"  name="modifMarque" id="btnCompte">Modifier la marque</button>
    </div>
</form>