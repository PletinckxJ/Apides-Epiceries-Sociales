<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/05/2016
 * Time: 12:08
 */
?>
<div class="facture">

    <?php
    $pm = new ProduitManager(connexionDb());
    $tabFav = $pm->getFavoris($_SESSION['Utilisateur']->getId());
    if (count($tabFav) > 0) {
    ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../Style/cartTable.css" rel="stylesheet">
    <script src="../js/favoris.js"></script>
    <div class="container">
        <table id="cart" class="table table-hover table-condensed" style="width:100%;">
            <caption><h3 align="center">Liste de vos favoris</h3></caption>
            <thead>
            <tr>
                <th class="text-center" style="width:70%">Produit</th>
                <th class="text-center" style="width:20%">Prix</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tabFav as $elem) {
                $prix = round($elem->getPrixHTVA() + ($elem->getPrixHTVA() * $elem->getTVA()->getCoef()), 2);
                ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs"><img
                                    src="../Style/images/produits/<?php echo $elem->getId(); ?>.png"
                                    alt="..." class="img-responsive"/></div>
                            <div class="col-sm-10">
                                <h4 class="nomargin"><?php echo $elem->getProduit(); ?></h4>

                                <p> <?php echo $elem->getFournisseur()->getLibelle() . " - " . $elem->getMarque()->getLibelle(); ?></p>

                                <p> Groupage idéal : <?php echo $elem->getGroupement(); ?></p>

                            </div>
                        </div>
                    </td>
                    <td data-th="Price" id="price_<?php echo $elem->getId(); ?>"><?php echo $prix; ?>€
                    </td>
                    <td class="actions" data-th="">
                        <button title="Supprimer le produit" class="btn btn-danger btn-sm"
                                onclick="deleteFav(<?php echo $elem->getId() . "," . $_SESSION['Utilisateur']->getId(); ?>);">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td><a href="../Produits" class="btn btn-warning"><i class="fa fa-angle-left"></i> Retourner au magasin</a>
                </td>
                <td><a href="<? echo $_SESSION['Utilisateur']->getId(); ?>" class="btn btn-success" id="confirmTransfer">Ajouter ces produits à mon panier  <i class="fa fa-angle-right"></i> </a></td>
                <td colspan="1" class="hidden-xs"></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
    <div id="dialog" title="Confirmation requise">
        Ajouter ces produits à votre panier ?
    </div>
    <script type="text/javascript" src="../js/dialogBox.js"></script>

    <?php
} else {
    header("Location :../Produits");
}
?>