<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13-04-16
 * Time: 14:27
 */

$bm = new BudgetManager(connexionDb());
$tabBudget = $bm->getAllBudget();
echo "<div id='tableContent' style='overflow-x:auto;'>";
echo "<table align='center' id='example'>";
?>
    <thead>
    <tr>
        <th>Nom </th>
        <th>Montant (€/Mois)</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
<?php
foreach ($tabBudget as $elem) {
    echo "<tr><td>" . $elem->getSituationFam() . "</td><td>".$elem->getBudgetMens()."</td>
            <td id='actions'><a href='index.php?page=modifyBudget&id=" . $elem->getId() . "' title='Modifier le budget'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le budget' /></a></td></tr>";
}

echo "</tbody>";
?>
    <tfoot>
    <tr>
        <th><a href="index.php?page=createBudget"><button>Créer un nouveau budget</button></a></th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
<?php
echo "</table>";
echo "</div>";

?>