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

<div class="facture">

                <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
                <div class="container">
                    <div class="jumbotron">
                        <h1> Votre profil</h1>

                        <p> Modifiez le formulaire ci-dessous afin d'apporter des modifications à votre compte</p>
                    </div>
                </div>



            <?php include("../Form/modifyProfil.form.php"); ?>
            <?php
            if (!empty($tabError)) {
                foreach ($tabError as $elem) {
                    echo "<p class='alert alert-danger' > $elem </p>";
                }
            }
            ?>
        </div>

