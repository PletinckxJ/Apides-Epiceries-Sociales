

<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12-04-16
 * Time: 15:00
 */


require "../Library/Function/Require.lib.php";

$bm = new BeneficiaireManager(connexionDb());
$tabBenef = $bm->getAllBeneficiaire();
$count = count($tabBenef);
?>
function verifyReg() {
    if (checkAll()) {
        document.getElementById("numReg").style.borderColor = "#E34234";
        $("#btnCompte").prop("disabled", true);
        $('label[for="error"]').show();
    } else {
        document.getElementById("numReg").style.borderColor = "#00FF00";
        $("#btnCompte").prop("disabled",false);
        $('label[for="error"]').hide();
    }
}
function checkAll() {
<?php
    echo "var countBen = $count ;";
    foreach ($tabBenef as $elem) {
        echo "if (checkRegistreExist('".$elem->getNumeroRegistre()."')) { return true; }";
    }
?>
    return false;
}

function checkRegistreExist(existingReg) {
var inputRegistre = $("#numReg").val();
    if (inputRegistre.toLowerCase() == existingReg.toLowerCase()) {
        return true;
    } else {
        return false;
    }
}