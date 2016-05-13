<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/04/2016
 * Time: 08:26
 */

$dm = new DevisManager(connexionDb());
$um = new UserManager(connexionDb());
$tabDevis = $dm->getAllDevis();
$cloture = "";
echo "<div id='tableContent' style='overflow-x:auto;'>";
echo "<table align='center' id='example'>";
?>
    <thead>
    <tr>
        <th>Numéro de devis </th>
        <th>Date d'émission</th>
        <th>Client </th>
        <th>Etat d'avancement</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
<?php
foreach ($tabDevis as $elem) {
    if ($elem->getCloture() == 0) {
        $cloture = "En cours";
    } else if ($elem->getCloture() == 1) {
        $cloture = "Cloturé";
    } else {
        $cloture = "En cours d'achat";
    }

    $user = $um->getUserById($dm->getDevisUser($elem->getId()));
    echo "<tr><td>" . $elem->getNumeroDevis()."</td><td>".date('d/m/Y', strtotime($elem->getDateEmission()))."</td><td>".$user->getNomSociete()."</td><td>" . $cloture . "</td>
            <td><a href='../Devis/index.php?id=" . $elem->getId() . "' title='Opérations sur ce devis'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Opérations sur ce devis' /></a></td></tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";
