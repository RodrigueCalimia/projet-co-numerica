<?php
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomSite        =$_POST['nom_site'];
        $adresseSite    =$_POST['adresse_site'];
        $cpSite         =$_POST['code_postal_site'];
        $villeSite      =$_POST['ville_site'];
        // ajout des données dans la table
        $wpdb->insert('wp_sites', 
            array(
                'NOM_SITE'          =>$nomSite,
                'ADRESSE_SITE'      =>$adresseSite,
                'CODE_POSTAL_SITE'  =>$cpSite,
                'VILLE_SITE'        =>$villeSite,
            )
        );
        echo "<script>alert('Le site ".$nomSite." a bien été créé !');</script>";
        echo "<script>window.location = '" .site_url("/les-sites-numerica")."'</script>";
    }
?>

<form class="row" method="POST">
    <?php get_template_part( 'template-parts/forms/form', 'site');?>
</form>
