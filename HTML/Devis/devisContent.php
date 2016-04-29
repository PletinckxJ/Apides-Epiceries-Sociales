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
$tabAchat = $am->getAllAchatsFromDevis($devis);
?>
<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>
<div class="facture">
<div id="tabs" style="border: none; background-color : #f7f3f3;">
    <ul style="border: none; border-bottom : solid 1px black;  background-color : #f7f3f3; background-image:none;">
        <li><a href="#tabs-1" style="border: none; width:480px;"><?php if($devis->getCloture() == 0) { echo "Cloturer le devis";} else { echo "Visualiser le devis";}?> </a></li>
        <li><a href="#tabs-2" style="border: none; width:480px;">Affichage de la facture actuelle</a></li>
    </ul>
    <div id="tabs-1" style="border: none; width:1000px; background-color : #f7f3f3;">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
        <link href="../Style/cartTable.css" rel="stylesheet">
        <script src="../js/devis.js"></script>
        <div class="container">
            <table id="cart" class="table table-hover table-condensed" style="margin-left:-2em;width:85%;">
                <caption><h3 align="center">Liste des produits du devis</h3></caption>
                <thead>
                <tr>
                    <th style="width:50%">Produit</th>
                    <th style="width:10%">Prix</th>
                    <th style="width:8%">Quantité</th>
                    <th style="width:15%" class="text-center"> Rectifications </th>
                    <th style="width:22%" class="text-center">Sous-total</th>
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

                                    <p> Groupage idéal : <?php echo $elem->getProduit()->getGroupement(); ?></p>

                                </div>
                            </div>
                        </td>
                        <td data-th="Price" id="price_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix; ?>€
                        </td>
                        <td data-th="Quantity" class="text-center"
                                   id="quantity_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $elem->getQuantite(); ?>
                        </td>
                        <td data-th="Rectification">
                            <input type="number" min="0" max="<?php echo $elem->getQuantite(); ?>" class="form-control text-center"
                                   id="<?php echo $elem->getProduit()->getId(); ?>"
                                   name="<?php echo $elem->getProduit()->getId(); ?>" value="<?php echo $elem->getQuantite(); ?>"
                                   >
                        </td>
                        <td data-th="Subtotal" class="text-center"
                            id="subtotal_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix*$elem->getQuantite(); ?> €
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total </strong></td>
                </tr>
                <tr>
                    <td><a href="../Administration/index.php?page=devis" class="btn btn-warning"><i class="fa fa-angle-left"></i> Retourner dans les devis</a>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?> €</strong></td>
                    <td><a class="btn btn-success btn-block" href="<?php echo $_GET['id']; ?>" id="confirmClot">Clôturer <i
                                class="fa fa-angle-right"></i></a></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
        <iframe src='../Devis/pdf/<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%' style='height:1000px'></iframe>
    </div>
</div>
</div>
<div id="dialog" title="Confirmation requise">
    Clôturer la commande ?
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>