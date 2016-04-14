<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:28
 */

$mm = new MarqueManager(connexionDb());
$tabMarque = $mm->getAllMarque();
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
    foreach ($tabMarque as $elem) {
        echo "<tr><td>".$elem->getLibelle()."</td>
            <td id='actions'><a href='index.php?page=modifyMarque&id=" . $elem->getId() . "' title='Modifier la marque'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier la marque' /></a></td></tr>";
    }

    echo "</tbody>";
    ?>
    <tfoot>
    <tr>
        <th><a href="index.php?page=createMarque"><button>Créer une nouvelle marque</button></a></th>
        <th></th>
    </tr>
    </tfoot>
<?php
echo "</table>";
echo "</div>";

?>