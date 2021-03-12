<?php
    // récupération du cookie indiquant si les donées sont liées à une entreprise ou OPCO
    $typeEntOpcoPage = $_COOKIE["TypeEntOpco"];
    // connexion à la BBD WP
    global $wpdb;
    // traitement du formulaire
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomCommercial  =$_POST['nom_commercial'];
        $adresse        =$_POST['adresse-entreprise-opco'];
        $codePostal     =$_POST['code_postal-entreprise-opco'];
        $ville          =$_POST['ville-entreprise-opco'];
        $siret          =$_POST['siret-entreprise-opco'];
        $naf            =$_POST['naf-entreprise-opco'];  
        // ajout des données dans la table
        $wpdb->insert('wp_entreprises_opco', 
            array(
                'TYPE_ENT_OPCO'     =>$typeEntOpcoPage,
                'NOM_ENT_OPCO'      =>$nomCommercial,
                'ADRESSE_ENT_OPCO'  =>$adresse,
                'CP_ENT_OPCO'       =>$codePostal,
                'VILLE_ENT_OPCO'    =>$ville,
                'SIRET_ENT_OPCO'    =>$siret,
                'NAF_ENT_OPCO'      =>$naf,
            )
        );
        echo "<script>alert('L\'".$typeEntOpcoPage." ".$nomCommercial." a bien été créée !');</script>";
        echo "<script>window.location = '" .site_url("/administration")."'</script>";
    }
?>

<?php get_header()?>
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <form class="row" method="POST" enctype="multipart/form-data">
        <?php get_template_part( 'template-parts/forms/form', 'entreprise-opco');?>
    </form>
</div>
<?php get_footer(); ?>
