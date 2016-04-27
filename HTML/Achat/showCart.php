<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/04/2016
 * Time: 08:38
 */

?>

<div class="facture">

    <?php
    $am = new AchatManager(connexionDb());
    $tabAchat = $am->getAllAchatFromUser($_SESSION['Utilisateur']);

    ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../Style/cartTable.css" rel="stylesheet">
    <script src="../js/cart.js"></script>
    <div class="container">
        <table id="cart" class="table table-hover table-condensed" style="width:85%;">
            <caption > <h3 align="center">Liste des achats</h3></caption>
            <thead>
            <tr>
                <th style="width:50%">Produit</th>
                <th style="width:10%">Prix</th>
                <th style="width:8%">Quantité</th>
                <th style="width:22%" class="text-center">Sous-total</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $somme = 0;
            foreach($tabAchat as $elem) {
                $prix = round($elem->getProduit()->getPrixHTVA() + ($elem->getProduit()->getPrixHTVA() * $elem->getProduit()->getTVA()->getCoef()),2);
                $somme = $somme + $prix
            ?>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="../Style/images/produits/<?php echo $elem->getProduit()->getId(); ?>.png" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin"><?php echo $elem->getProduit()->getProduit(); ?></h4>
                            <p> <?php echo $elem->getProduit()->getFournisseur()->getLibelle();?></p>
                            <p> Groupage idéal : <?php echo $elem->getProduit()->getGroupement(); ?></p>

                        </div>
                    </div>
                </td>
                <td data-th="Price" id="price_<?php echo $elem->getProduit()->getId();?>"><?php echo $prix; ?> €</td>
                <td data-th="Quantity">
                    <input type="number" class="form-control text-center" id="<?php echo $elem->getProduit()->getId(); ?>" name="<?php echo $elem->getProduit()->getId(); ?>" value="1" onchange="recalculate(<?php echo $elem->getProduit()->getId();?>);">
                </td>
                <td data-th="Subtotal" class="text-center" id="subtotal_<?php echo $elem->getProduit()->getId();?>"><?php echo $prix; ?> €</td>
                <td class="actions" data-th="">
                    <button title="Supprimer le produit" class="btn btn-danger btn-sm" onclick="deleteAchat(<?php echo $elem->getProduit()->getId().",".$_SESSION['Utilisateur']->getId();?>);"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
                <?php } ?>
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong >Total </strong></td>
            </tr>
            <tr>
                <td><a href="../Produits" class="btn btn-warning"><i class="fa fa-angle-left"></i> Retourner au magasin</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong id="total">Total :  <?php echo $somme; ?> €</strong></td>
                <td><a class="btn btn-success btn-block" id="confirmLink">Continuer <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<div id="dialog" title="Confirmation requise">
    Lancer la commande ?
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>
