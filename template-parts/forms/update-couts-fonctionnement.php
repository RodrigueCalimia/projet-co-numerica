<?php
    $idCoutFonct = 1;
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $coutAdminFormation         =$_POST['coutAdminFormation'];
        $coutComptabilite           =$_POST['coutComptabilite'];
        $coutServiceInformatique    =$_POST['coutServiceInformatique'];
        // vérification si les données sont supérieures à 0
        if ($coutAdminFormation > 0 && $coutComptabilite > 0 && $coutServiceInformatique > 0){
            // ajout des données dans la table
            $wpdb->update('wp_cout_fonctionnement', 
                array(
                    'COUT_ADMIN_FORMATION'      =>$coutAdminFormation,
                    'COUT_COMPTA'               =>$coutComptabilite,
                    'COUT_SERVICE_INFORMATIQUE' =>$coutServiceInformatique,
                ),
                array('ID_COUT_FONCT'  =>$idCoutFonct)
            );
            echo "<script>alert('Les paramètres ont bien été mise à jour !');</script>";
        } else {
            echo "<script>alert('Les paramètres n'ont pas pu être mise à jour. Vérifier qu'ils sont bien supérieurs à 0 et recommencez.');</script>";
        }
        echo "<script>window.location = '" .site_url("/couts-de-fonctionnement")."'</script>";
    }
?>

<div class="main">   
    <h1><?php the_title()?></h1>
    <div class="container form-dim-width">
        <form class="row justify-content-between" method="POST" enctype="multipart/form-data">
            <?php get_template_part( 'template-parts/forms/form', 'couts-fonctionnement');?>
        </form>
    </div>
</div>