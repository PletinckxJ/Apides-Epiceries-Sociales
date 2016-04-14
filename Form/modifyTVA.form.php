<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 16:42
 */
?>
<form action="index.php?page=modifyTVA&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Taux (%) :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo ($tva->getCoef() * 100); ?>" required>
    <div class="form_row">
        <button type="submit"  name="modifTVA" id="btnCompte">Modifier la TVA</button>
    </div>
</form>