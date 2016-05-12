<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 02/05/2016
 * Time: 13:48
 */
if (isset($_POST['modifyAccount']))
    $tabError = modifyProfilUser();
?>
<div class="crumb_navigation"> Navigation: <span class="current">Home</span></div>
<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>
<div class="facture">
    <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
    <div id="tabs" style="border: none; background-color : #f7f3f3;">
        <ul style="border: none; border-bottom : solid 1px black;  background-color : #f7f3f3; background-image:none;">


            <li><a href="#tabs-1" style="border: none; width:465px;"><h4 align="center"> Mes devis </h4></a></li>
            <li><a href="#tabs-2" style="border: none; width:465px;"><h4 align="center">Mon compte</h4></a></li>
            <?php } else { ?>
                <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
                <div class="container">
                    <div class="jumbotron">
                        <h1> Votre profil</h1>

                        <p> Modifiez le formulaire ci-dessous afin d'apporter des modifications à votre compte</p>
                    </div>
                </div>
            <?php } ?>
        </ul>
        <div id="tabs-2" style="border: none; width:966.12px; background-color : #f7f3f3;">
            <?php include("../Form/modifyProfil.form.php"); ?>
            <?php
            if (!empty($tabError)) {
                foreach ($tabError as $elem) {
                    echo "<p class='alert alert-danger' > $elem </p>";
                }
            }
            ?>
        </div>
        <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
        <div id="tabs-1" style="border: none; background-color : #f7f3f3;">
            <?php
            $dm = new DevisManager(connexionDb());
            $um = new UserManager(connexionDb());
            $tabDevis = $dm->getAllDevisFromUser($_SESSION['Utilisateur']);
            $cloture = "";
            echo "<div id='tableContent' style='overflow-x:auto;'>";
            echo "<table align='center' id='example'>";
            ?>
            <thead>
            <tr>
                <th>Numéro de devis</th>
                <th>Date d'émission</th>
                <th>Cloture</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($tabDevis as $elem) {
                if ($elem->getCloture() == 0) {
                    $cloture = "En cours";
                } else {
                    $cloture = "Cloturé";
                }

                $user = $um->getUserById($dm->getDevisUser($elem->getId()));
                echo "<tr><td>" . $elem->getNumeroDevis() . "</td><td>" . date('d/m/Y', strtotime($elem->getDateEmission())) . "</td><td>" . $cloture . "</td>
            <td><a href='../Devis/index.php?id=" . $elem->getId() . "' title='Opérations sur ce devis'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Opérations sur ce devis' /></a></td></tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            ?>
        </div>
    </div>
<?php } ?>

</div>