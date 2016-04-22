<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:40
 */
$title = getTitle();
?>

<?php include("../HTML/Administration/NavigationAdministration.php"); ?>
<div class="center_content">
    <?php
     echo "<div class='center_title_bar'>".$title."</div>";
    ?>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <?php
            if (!isset($_GET['page']) or $_GET['page'] == "users") {
                if (!isset($_GET['option'])) {
                    include("../HTML/Administration/MemberAdministrationList.php");
                } else if ($_GET['option'] == "createAccount") {
                    include("../Form/createAccount.form.php");
                    if (isset($tabRetour['Error'])) {
                        foreach ($tabRetour['Error'] as $message) {
                            echo $message;
                        }
                    }
                } else {
                    header("Location :../Deconnexion");
                }
            } else if ($_GET['page'] == "modifyUser" && isset($_GET['id']) && membreExistant()) {
                include("../HTML/Administration/AdministrationUserProfil.php");
            } else if ($_GET['page'] == "benef" && !isset($_GET['option'])) {
                include("../HTML/Administration/AdministrationBenefList.php");
            } else if ($_GET['page'] == "benef" && $_GET['option'] == "create") {
                include("../Form/createBeneficiaire.form.php");
                if (isset($_POST['createBenef'])) {
                    echo addBenef();
                }
            } else if ($_GET['page'] == "benef" && $_GET['option'] == "budget") {
                include("../HTML/Administration/AdministrationBenefBudget.php");
            } else if ($_GET['page'] == "modifyBenef" && isset($_GET['id']) && benefExistant()) {
                include("../HTML/Administration/AdministrationBenefProfil.php");
            } else if ($_GET['page'] == "createBudget") {
                include("../Form/createBudget.form.php");
                if (isset($_POST['creerBudget'])) {
                    if (addBudget()) {
                        header("Location: ../Administration/index.php?page=benef&option=budget");
                    } else {
                        echo "<label class='contact' style='color:Red; width:350px;'>Le budget existe déjà</label>";
                    }
                }
            } else if ($_GET['page'] == "modifyBudget" && isset($_GET['id']) && budgetExistant()) {
                include("../HTML/Administration/AdministrationModifyBudget.php");
            } else if ($_GET['page'] == "produit" && !isset($_GET['option'])) {
                include("../HTML/Administration/AdministrationProduitList.php");
            } else if ($_GET['page'] == "produit" && $_GET['option'] == "create") {
                include("../Form/createProduit.form.php");
                if (isset($_POST['createProduit'])) {
                    echo addProduit();
                }
            } else if ($_GET['page'] == "modifyProduit" && isset($_GET['id']) && produitExistant()) {
                include("../HTML/Administration/AdministrationModifyProduit.php");
            } else if ($_GET['page'] == "produit" && $_GET['option'] == "fournisseur") {
                include("../HTML/Administration/AdministrationProduitFournisseur.php");
            } else if ($_GET['page'] == "createFournisseur") {
                include("../Form/createFournisseur.form.php");
                if (isset($_POST['creerFourni'])) {
                    echo addFournisseur();
                }
            } else if ($_GET['page'] == "modifyFournisseur" && isset($_GET['id']) && fournisseurExistant()) {
                include("../HTML/Administration/AdministrationModifyFournisseur.php");

            } else if ($_GET['page'] == "produit" && $_GET['option'] == "section") {
                include("../HTML/Administration/AdministrationProduitSection.php");
            } else if ($_GET['page'] == "createSection") {
                include("../Form/createSection.form.php");
                if (isset($_POST['creerSection'])) {
                    echo addSection();
                }
            } else if ($_GET['page'] == "modifySection" && isset($_GET['id']) && SectionExistant()) {
                include("../HTML/Administration/AdministrationModifySection.php");
            } else if ($_GET['page'] == "produit" && $_GET['option'] == "marque") {
                include("../HTML/Administration/AdministrationProduitMarque.php");
            } else if ($_GET['page'] == "createMarque") {
                include("../Form/createMarque.form.php");
                if (isset($_POST['creerMarque'])) {
                    echo addMarque();
                }
            } else if ($_GET['page'] == "modifyMarque" && isset($_GET['id']) && marqueExistant()) {
                include("../HTML/Administration/AdministrationModifyMarque.php");
            } else if ($_GET['page'] == "produit" && $_GET['option'] == "tva") {
                include("../HTML/Administration/AdministrationProduitTVA.php");
            } else if ($_GET['page'] == "createTVA") {
                include("../Form/createTVA.form.php");
                if (isset($_POST['creerTVA'])) {
                    echo addTVA();
                }
            } else if ($_GET['page'] == "modifyTVA" && isset($_GET['id']) && TVAExistant()) {
                include("../HTML/Administration/AdministrationModifyTVA.php");
            } else {
                header("Location :../Deconnexion");
            }
            ?>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>
<div class="right_content">
    <div class="title_box">Options</div>
    <ul class="left_menu">
        <?php include("../HTML/Administration/AdministrationRightList.php"); ?>
    </ul>
</div>