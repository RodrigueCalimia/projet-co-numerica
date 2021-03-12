<?php
    $idCoutFonct = 1;
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $coutAdminFormation         =$_POST['coutAdminFormation'];
        $coutComptabilite           =$_POST['coutComptabilite'];
        $coutServiceInformatique    =$_POST['coutServiceInformatique'];
        // vérification si les données sont supérieures à 0
        if ($coutAdminFormation > 0){
            // ajout des données dans la table
            $wpdb->update('wp_cout_admin_formation', 
                array(
                    'COUT_ADMIN_FORMATION'      =>$coutAdminFormation
                ),
                array('ID_COUT_ADMIN_FORMATION'  =>$_COOKIE['cookie_id_cout_admin'])
            );
            echo "<script>alert('Le paramètre -Coût adminsitratif formation- a bien été mise à jour !');</script>";
        } else {
            echo "<script>alert('Le paramètre -Coût adminsitratif formation- n'a pas pu être mise à jour. Vérifier qu'il est bien supérieur à 0 et recommencez.');</script>";
        }
        if ($coutComptabilite > 0){
            // ajout des données dans la table
            $wpdb->update('wp_cout_comptabilite', 
                array(
                    'COUT_COMPTA'      =>$coutComptabilite
                ),
                array('ID_COUT_COMPTA'  =>$_COOKIE['cookie_id_cout_compta'])
            );
            echo "<script>alert('Le paramètre -Coût comptabilité- a bien été mise à jour !');</script>";
        } else {
            echo "<script>alert('Le paramètre -Coût comptabilité- n'a pas pu être mise à jour. Vérifier qu'il est bien supérieur à 0 et recommencez.');</script>";
        }
        if ($coutServiceInformatique > 0){
            // ajout des données dans la table
            $wpdb->update('wp_cout_service_informatique', 
                array(
                    'COUT_SERVICE_INFORMATIQUE'      =>$coutServiceInformatique
                ),
                array('ID_COUT_SERVICE_INFORMATIQUE'  =>$_COOKIE['cookie_id_cout_service'])
            );
            echo "<script>alert('Le paramètre -Coût service informatique- a bien été mise à jour !');</script>";
        } else {
            echo "<script>alert('Le paramètre -Coût service informatique- n'a pas pu être mise à jour. Vérifier qu'il est bien supérieur à 0 et recommencez.');</script>";
        }
        echo "<script>window.location = '" .site_url("/administration")."'</script>";
    }
?>

<?php get_header()?>
<div class="main">   
    <h1><?php the_title()?></h1>
    <div class="container form-dim-width">
        <form class="row justify-content-between" method="POST" enctype="multipart/form-data">
            <?php get_template_part( 'template-parts/forms/form', 'couts-fonctionnement');?>
        </form>
    </div>
</div>
<?php get_footer(); ?>