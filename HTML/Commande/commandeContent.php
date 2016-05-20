<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/05/2016
 * Time: 10:30
 */
if ($_SESSION['Utilisateur']->getDroit()->getId() != 3) {
    header("Location :../Compte");
}
?>
<div class="facture">
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <div class="container">
        <div class="jumbotron">
            <h1> Vos devis</h1>

            <p> Profitez de la liste complète de vos devis</p>
        </div>
    </div>
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
            <th style="text-align:center;">Numéro de devis</th>
            <th style="text-align:center;">Date d'émission</th>
            <th style="text-align:center;">Etat d'avancement</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($tabDevis as $elem) {
            if ($elem->getCloture() == 0) {
                $cloture = "Ouvert";
            } else if ($elem->getCloture() == 1) {
                $cloture = "Cloturé";
            } else if ($elem->getCloture() == 2) {
                $cloture = "En cours d'achat";
            } else if ($elem->getCloture() == 3) {
                $cloture = "En cours de livraison";
            } else {
                $cloture = "Facturé";
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

