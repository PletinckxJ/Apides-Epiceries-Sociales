<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/04/2016
 * Time: 10:20
 */
$dm = new DevisManager(connexionDb());
$pm = new ProduitManager(connexionDb());
$am = new AchatManager(connexionDb());
$devis = $dm->getDevisById($_GET['id']);
$um = new UserManager(connexionDb());
$user = $um->getUserById($dm->getDevisUser($devis->getId()));
$tabAchat = $am->getAllAchatsFromDevis($devis);
$_SESSION['CurrentDevis'] = $devis;
if ($user->getId() != $_SESSION['Utilisateur']->getId() && $_SESSION['Utilisateur']->getDroit()->getId() == 3 ) {
    header('Location :../Deconnexion');
}
?>
<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>
<div class="facture">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../Style/cartTable.css" rel="stylesheet">
    <script src="../js/devis.js"></script>
<div id="tabs" style="border: none; background-color : #f7f3f3;">
    <ul style="border: none; border-bottom : solid 1px black;  background-color : #f7f3f3; background-image:none;">
        <li><a href="#tabs-1" style="border: none; width:480px;"><?php if($devis->getCloture() == 0) { if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "Modifier le devis";} else { echo "Cloturer le devis";}} else { echo "Visualiser le devis";}?> </a></li>
        <?php  if ($devis->getCloture() == 1 and file_exists("../Devis/pdf/revision-".$devis->getId().".pdf")) { ?>
        <li><a href="#tabs-2" style="border: none; width:240px;"> Facture initiale</a></li>
        <li><a href="#tabs-3" style="border: none; width:240px;"> Facture r�vis�e</a></li>
        <?php } else { ?>
        <li><a href="#tabs-2" style="border: none; width:480px;">Affichage de la facture actuelle</a></li>
        <?php } ?>
    </ul>
    <div id="tabs-1" style="border: none; width:1000px; background-color : #f7f3f3;">

        <div class="container">
            <table id="cart" class="table table-hover table-condensed" style="<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "margin-left:-2em;width:85%"; } else { echo "margin-left:-1em;width:100%"; }?>;">
                <caption><h3 align="center">Liste des produits du devis</h3></caption>
                <thead>
                <tr>
                    <th style="width:50%">Produit</th>
                    <th style="width:10%">Prix</th>
                    <?php if ($devis->getCloture() == 0) { ?>
                        <th style="width:8%">Quantit�</th>
                        <th style="width:15%" class="text-center"><?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "Modifications"; } else { echo "Rectifications";} ?></th>
                    <?php } else { echo "<th style='width:23%'  class='text-center'>Quantit�</th><th  class='hidden-xs'></th>";} ?>
                    <th style="width:22%" class="text-center">Sous-total</th>
                    <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                        <th style="width:5%"></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $somme = 0;
                foreach ($tabAchat as $elem) {
                    $prix = round($elem->getProduit()->getPrixHTVA() + ($elem->getProduit()->getPrixHTVA() * $elem->getProduit()->getTVA()->getCoef()), 2);
                    $somme = $somme + ($prix*$elem->getQuantite());
                    ?>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img
                                        src="../Style/images/produits/<?php echo $elem->getProduit()->getId(); ?>.png"
                                        alt="..." class="img-responsive"/></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin"><?php echo $elem->getProduit()->getProduit(); ?></h4>

                                    <p> <?php echo $elem->getProduit()->getFournisseur()->getLibelle() . " - " . $elem->getProduit()->getMarque()->getLibelle(); ?></p>

                                    <p> Groupage id�al : <?php echo $elem->getProduit()->getGroupement(); ?></p>

                                </div>
                            </div>
                        </td>
                        <td data-th="Price" id="price_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix; ?>�
                        </td>
                        <td data-th="Quantity" class="text-center"
                                   id="quantity_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $elem->getQuantite(); ?>
                        </td>

                        <?php if ($devis->getCloture() == 0) { ?>
                        <td data-th="Rectification">
                            <input type="number" min="1" <?php if ($_SESSION['Utilisateur']->getDroit()->getId() != 3) { ?>max="<?php echo $elem->getQuantite(); ?>"<?php } ?> class="form-control text-center"
                                   id="<?php echo $elem->getProduit()->getId(); ?>"
                                   name="<?php echo $elem->getProduit()->getId(); ?>" grade="<?php echo $_SESSION['Utilisateur']->getDroit()->getId(); ?>" value="<?php echo $elem->getQuantite(); ?>"
                                   >
                        </td>
                        <?php } else echo "<td></td>"; ?>
                        <td data-th="Subtotal" class="text-center"
                            id="subtotal_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix*$elem->getQuantite(); ?> �
                        </td>

                        <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                            <td class="actions" data-th="">
                                <button title="Supprimer le produit" class="btn btn-danger btn-sm"
                                        <?php if (count($tabAchat) != 1) { ?>
                                            onclick="deleteProduit(<?php echo $elem->getProduit()->getId() . "," . $devis->getId(); ?>);">
                                        <?php } else {
                                            echo "id='confirmSuppr' produit='".$elem->getProduit()->getId()."' devis='".$devis->getId()."'>";
                                         } ?>
                                    <i class="fa fa-trash-o"></i></button>
                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total </strong></td>
                </tr>
                <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                <tr>
                    <td>
                    <label for="prod">Ajouter un produit : </label>
                    <input style="width:480px;" id="prod">
                    </td>
                    <td><button class="btn btn-success btn-sm" id="addprod" title="Ajouter le produit" style="margin-top:2.7em;" onclick="addProduit(<?php echo $devis->getId(); ?>);"><span class="glyphicon glyphicon-plus"></span></button></td>
                    <td></td><td></td><td></td><td></td>

                </tr>
                <?php } ?>
                <tr>
                    <td><a href=<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "../Compte"; } else { echo "../Administration/index.php?page=devis";} ?> class="btn btn-warning"><i class="fa fa-angle-left"></i> Retourner dans les devis</a>
                    </td>


                    <?php if ($devis->getCloture() == 0 ) { ?>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?> �</strong></td>
                    <td><a class="btn btn-success btn-block" href="<?php echo $_GET['id']; ?>" id="confirmClot"><?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {echo "Modifier";} else { echo "Cl�turer";} ?> <i class="fa fa-angle-right"></i></a></td>
                    <?php } else if ($devis->getCloture() == 1) { ?>

                        <td colspan='2' class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?> �</strong></td>
                        <td class="hidden-xs"></td>
                    <td><a class="btn btn-danger btn-block  disabled">Devis clotur�</a></td>
                    <?php } ?>
                    <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId())
                        echo "<td></td>";
                    ?>

                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php  if ($devis->getCloture() == 1 and file_exists("../Devis/pdf/revision-".$devis->getId().".pdf")) { ?>
        <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
            <iframe src='../Devis/pdf/<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%' style='height:1000px'></iframe>
        </div>
        <div id="tabs-3" style="border: none; background-color : #f7f3f3;">
            <iframe src='../Devis/pdf/revision-<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%' style='height:1000px'></iframe>
        </div>
    <?php } else { ?>
    <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
        <iframe src='../Devis/pdf/<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%' style='height:1000px'></iframe>
    </div>
    <?php } ?>
</div>
</div>
<div id="dialog" title="Confirmation requise">
    <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
        echo "Modifier la commande ?";
    } else {
        echo "Cl�turer la commande ?";
    }
?>
</div>
<script>
    $(function() {
        $( "#prod" ).autocomplete({
            source: '../Library/Function/prodList.php',
            max : 10,
        });
    });


</script>
<div id="dialog2" title="Confirmation require">
    La suppression de ce produit �tant le dernier de votre devis, supprimera le devis, �tes-vous certain ?
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>