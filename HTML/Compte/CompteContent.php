<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 02/05/2016
 * Time: 13:48
 */
?>
<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
<script>
$(function() {
    $( "#tabs" ).tabs();
});
</script>
<div class="facture">
<div id="tabs" style="border: none; background-color : #f7f3f3;">
    <ul style="border: none; border-bottom : solid 1px black;  background-color : #f7f3f3; background-image:none;">
        <li><a href="#tabs-1" style="border: none; width:240px;"> Mon compte</a></li>
        <li><a href="#tabs-2" style="border: none; width:240px;"> Mes devis</a></li>
</ul>
<div id="tabs-1" style="border: none; width:1000px; background-color : #f7f3f3;">
    <?php include("../Form/modifyAccount.form.php"); ?>
</div>
    <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
        <?php
        $dm = new DevisManager(connexionDb());
        $um = new UserManager(connexionDb());
        $tabDevis = $dm->get;
        $cloture = "";
        echo "<div id='tableContent' style='overflow-x:auto;'>";
        echo "<table align='center' id='example'>";
        ?>
        <thead>
        <tr>
            <th>Numéro de devis </th>
            <th>Date d'émission</th>
            <th>Utilisateur</th>
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
            echo "<tr><td>" . $elem->getNumeroDevis()."</td><td>".date('d/m/Y', strtotime($elem->getDateEmission()))."</td><td>".$user->getNomSociete()."</td><td>" . $cloture . "</td>
            <td><a href='../Devis/index.php?id=" . $elem->getId() . "' title='Opérations sur ce devis'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Opérations sur ce devis' /></a></td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        ?>
    </div>
</div>
</div>