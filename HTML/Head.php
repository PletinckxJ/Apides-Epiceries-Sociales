<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:25
 */

ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Apides Centrale</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

    <link rel="stylesheet" type="text/css" href="../Style/style.css" />
    <link rel="stylesheet" type="text/css" href="../Style/privateCSS.css" />

    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="../Style/iecss.css" />

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
    <script src="../Style/bootstrap-3.3.6-dist/js/bootstrap.min.js"
    <script type=text/javascript" class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js/readURL.js"></script>
    <script type="text/javascript" src="../js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="../js/boxOver.js"></script>
    <script type="text/javascript" src="../js/verifPassword.js"></script>
    <script type="text/javascript" src="../js/verifyRegistre.php"></script>
    <script type="text/javascript" src="../js/pagination.js";></script>
    <script type="text/javascript" src="../js/dynamicSearch.js"></script>
    <script type="text/javascript" class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "pagingType": "full_numbers",
                "language": {
                    "lengthMenu" : "Afficher _MENU_ résultats par page",
                    "zeroRecords" : "Aucun résultat trouvé, désolé",
                    "info" : "Affichage de la page _PAGE_ sur _PAGES_",
                    "infoEmpty" :"Aucun résultat trouvable",
                    "infoFiltered" : "(filtré sur un total de _MAX_ résultats)",
                    "search" : "Rechercher",
                    "paginate" : {
                        'first': "Début",
                        "last": "Fin",
                        "next": "Suivant",
                        "previous": "Précedent"
                    },
                    "loadingRecords" : "En chargement...",
                    "processing" : "En cours...",
                    "aria" : {
                        "sortAscending": ": Activer pour triage ascendant",
                        "sortDescending": ": Activer pour triage descendant"
                    }

                    }
                });

            } );
    </script>

    <script type="text/javascript" src="../js/verifyRegistre.php"></script>
   </head>

<body>

