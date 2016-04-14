<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:52
 */
?>
<form action="index.php?page=modifyFournisseur&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Fournisseur :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $fournisseur->getLibelle(); ?>" required>
    <div class="form_row">
        <button type="submit"  name="modifFournisseur" id="btnCompte">Modifier le fournisseur</button>
    </div>
</form>