<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 15:16
 */

?>

<form action="index.php?page=modifySection&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Section :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $section->getLibelle(); ?>" required>
    <div class="form_row">
        <button type="submit"  name="modifSection" id="btnCompte">Modifier la section</button>
    </div>
</form>
