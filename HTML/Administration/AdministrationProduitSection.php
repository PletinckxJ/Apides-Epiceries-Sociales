<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 14:29
 */

$sm = new SectionManager(connexionDb());
$tabSection = $sm->getAllSection();
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
    foreach ($tabSection as $elem) {
        echo "<tr><td>".$elem->getLibelle()."</td>
            <td id='actions'><a href='index.php?page=modifySection&id=" . $elem->getId() . "' title='Modifier la section'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier la section' /></a></td></tr>";
    }

    echo "</tbody>";
    ?>
    <tfoot>
    <tr>
        <th><a href="index.php?page=createSection"><button>Créer une nouvelle section</button></a></th>
        <th></th>
    </tr>
    </tfoot>
<?php
echo "</table>";
echo "</div>";

?>