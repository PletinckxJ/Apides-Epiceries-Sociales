<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 08:58
 */

$bm = new BeneficiaireManager(connexionDb());
    $tabBenef = $bm->getAllBeneficiaire();
    echo "<div id='tableContent' style='overflow-x:auto;'>";
    echo "<table align='center' id='example'>";
        ?>
        <thead>
        <tr>
            <th>Nom </th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Numéro de registre</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
<?php
foreach ($tabBenef as $elem) {
    echo "<tr><td>" . $elem->getNom() . "</td><td>".$elem->getPrenom()."</td><td><a href='mailto:" . $elem->getMail() . "'>" . $elem->getMail() . "</a></td>
              <td>".$elem->getNumeroRegistre()."</td>
            <td id='actions'><a href='index.php?page=showBenef&id=" . $elem->getId() . "' title='Voir les informations de cet utilisateur'>
            <img src='../../Style/images/eye-24-512.png' height='32' width='32' alt='Voir les informations' /></a>
            <a href='index.php?page=modifyBenef&id=" . $elem->getId() . "' title='Modifier le profil de cet utilisateur'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le profil' /></a></td></tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";

?>