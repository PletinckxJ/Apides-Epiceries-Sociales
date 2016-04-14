<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:28
 */

$fm = new FournisseurManager(connexionDb());
$tabFournisseur = $fm->getAllFournisseur();
echo "<div id='tableContent' style='overflow-x:auto;'>";
echo "<table align='center' id='example'>";
?>
    <thead>
    <tr>
        <th>Nom </th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($tabFournisseur as $elem) {
        echo "<tr><td>".$elem->getLibelle()."</td>
            <td id='actions'><a href='index.php?page=modifyFournisseur&id=" . $elem->getId() . "' title='Modifier le fournisseur'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le fournisseur' /></a></td></tr>";
    }

    echo "</tbody>";
    ?>
    <tfoot>
    <tr>
        <th><a href="index.php?page=createFournisseur"><button>Créer un nouveau fournisseur</button></a></th>
        <th></th>
    </tr>
    </tfoot>
<?php
echo "</table>";
echo "</div>";

?>