<?php
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomFormation       =$_POST['nom_formation'];
        $objFormation       =$_POST['obj_formation'];
        $objProFormation    =$_POST['obj_pro_formation'];
        $parcPedaPrevi      =$_POST['parc_peda_previ'];
        // ajout des données dans la table
        $wpdb->insert('wp_formations', 
            array(
                'NOM_FORMATION'         =>$nomFormation,
                'OBJ_FORMATION'         =>$objFormation,
                'OBJ_PRO_FORMATION'     =>$objProFormation,
                'PARCOUR_PEDA_PREVI'    =>$parcPedaPrevi,
            )
        );
        echo "<script>alert('La formation ".$nomFormation." a bien été créée !');</script>";
        echo "<script>window.location = '" .site_url("/les-formations")."'</script>";
    }
?>

<form class="row" method="POST">
    <?php get_template_part( 'template-parts/forms/form', 'formation');?>
</form>
    