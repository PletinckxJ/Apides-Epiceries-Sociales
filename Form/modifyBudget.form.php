<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 15:23
 */
?>
<form action="index.php?page=modifyBudget&id=<?php echo $id; ?>" method="post" class="formCreation">
    <label class="contact" for="name"><strong>Situation familiale :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" value="<?php echo $budget->getSituationFam(); ?>" required>
    <label class="contact" for="montant"><strong>Montant :</strong></label>
    <input type="number" class="contact_input" id="montant" name="montant" value="<?php echo $budget->getBudgetMens(); ?>" required>
    <div class="form_row">
        <button type="submit"  name="modifBudget" id="btnCompte">Modifier le budget</button>
    </div>
</form>