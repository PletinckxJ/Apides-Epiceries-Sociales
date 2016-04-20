<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 09:17
 */

$pm = new ProduitManager(connexionDb());
$tabProduit = $pm->getAllProduit();
echo "<div id='tableContent' style='overflow-x:auto;'>";
echo "<table align='center' id='example'>";
?>
<thead>
<tr>
    <th>Nom </th>
    <th>Fournisseur</th>
    <th>Prix TVAC (€)</th>
    <th>Prix de vente (€)</th>
    <th></th>
</tr>
</thead>

<tbody>
<?php
foreach ($tabProduit as $elem) {
    $prix = round(($elem->getPrixHTVA() + ($elem->getPrixHTVA()* $elem->getTVA()->getCoef())), 2);
    $vente = round($prix/2,1);
    echo "<tr><td>" . $elem->getProduit()." | ".$elem->getPoids()."</td><td>".$elem->getFournisseur()->getLibelle()."</td><td>" . $prix . "</td>
              <td>".$vente."</td>
            <td id='actions'><a href='index.php?page=showProduit&id=" . $elem->getId() . "' title='Voir les informations de cet produit'>
            <img src='../../Style/images/eye-24-512.png' height='32' width='32' alt='Voir les informations' /></a>
            <a href='index.php?page=modifyProduit&id=" . $elem->getId() . "' title='Modifier le profil de ce produit'>
            <img src='../../Style/images/Edit_user.png' height='32' width='32' alt='Modifier le profil' /></a></td></tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";

?>
