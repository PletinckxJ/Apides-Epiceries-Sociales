<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11-04-16
 * Time: 08:23
 */

    $um = new UserManager(connexionDb());
    $tabUser = $um->getAllUser();
    echo "<div id='tableContent' style='overflow-x:auto;'>";
    echo "<table align='center' id='example'>";
?>
<thead>
<tr>
    <th>Nom de la société</th>
    <th>Adresse Mail</th>
    <th></th>
</tr>
</thead>

<tbody>
<?php
    $i = 1;
while ($i != 26) {
    foreach ($tabUser as $elem) {
        if ($elem->getId() != 1 && $elem->getId() != $_SESSION['Utilisateur']->getId()) {
            echo "<tr><td>" . $elem->getNomSociete() . "</td><td><a href='mailto:" . $elem->getMail() . "'>" . $elem->getMail() . "</a></td>
            <td id='actions'><a href='index.php?page=showUser&id=" . $elem->getId() . "' title='Voir les informations de cet utilisateur'>
            <img src='../../Style/images/eye-24-512.png' height='32' width='32' alt='Voir les informations' /></a>
            <a href='index.php?page=modifyUser&id=" . $elem->getId() . "' title='Modifier le profil de cet utilisateur'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le profil' /></a></td></tr>";
        }
    }
    $i++;
}
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
?>


