<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:29
 */

$tm = new TVAManager(connexionDb());
$tabTVA = $tm->getAllTVA();
echo "<div id='tableContent' style='overflow-x:auto;'>";
echo "<table align='center' id='example'>";
?>
    <thead>
    <tr>
        <th>Taux </th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($tabTVA as $elem) {
        echo "<tr><td>".$elem->getTexteTVA()."</td>
            <td id='actions'><a href='index.php?page=modifyTVA&id=" . $elem->getId() . "' title='Modifier la TVA'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier la TVA' /></a></td></tr>";
    }

    echo "</tbody>";
    ?>
    <tfoot>
    <tr>
        <th><a href="index.php?page=createTVA"><button>Créer une nouvelle TVA</button></a></th>
        <th></th>
    </tr>
    </tfoot>
<?php
echo "</table>";
echo "</div>";

?>