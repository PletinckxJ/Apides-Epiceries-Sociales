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


    foreach ($tabUser as $elem) {
        //if ($elem->getId() != 1 && $elem->getId() != $_SESSION['Utilisateur']->getId()) {
            echo "<tr><td>" . $elem->getNomSociete() . "</td><td><a href='mailto:" . $elem->getMail() . "'>" . $elem->getMail() . "</a></td> <td id='actions'>";
            if ($elem->getDroit()->getId() != 1 && $_SESSION['Utilisateur']->getDroit()->getId() != 1 || $_SESSION['Utilisateur']->getDroit()->getId() == 1) {
                echo "<a href='index.php?page=modifyUser&id=" . $elem->getId() . "' title='Modifier le profil de cet utilisateur'>
                <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le profil' /></a></td></tr>";
            } else {
                echo "<img src='../../Style/images/administrator_256.png' height='32' width='32' alt='Administrateur du site' title='Administrateur du site' /></a></td></tr>";
            }
        //}
    }


    echo "</tbody>";
    echo "</table>";
    echo "</div>";

?>

