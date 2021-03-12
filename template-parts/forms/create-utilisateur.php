<?php
    global $wpdb;
        
    if(isset($_FILES['cv_personne'])){
        $dossier = 'wp-content/themes/projet-co-numerica/fichiers/';
        $nameFile = "CV-".$prenomPersonne."-".$nomPersonne;
        $fichier = $_FILES['cv_personne']['name'];
        //echo "<script>console.log($fichier);</script>";
        //echo "le fichier : ".$fichier;
        //on utilise la fonctionmove_uploaded_file() 
        if(move_uploaded_file($_FILES['cv_personne']['tmp_name'], $dossier.$fichier))
        //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
        }
        else 
        //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }
    }

    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomPersonne    =$_POST['nom_personne'];
        $prenomPersonne =$_POST['prenom_personne'];
        $emailPersonne  =$_POST['email_personne'];
        $telPersonne    =$_POST['tel_personne'];
        $kabisPersonne  =$_POST['kabis_personne'];
        $typePersonne   =$_POST['type_personne'];
        // ajout des données dans la table
        $wpdb->insert('wp_personnes', 
            array(
                'NOM_PERSONNE'      =>$nomPersonne,
                'PRENOM_PERSONNE'   =>$prenomPersonne,
                'EMAIL_PERSONNE'    =>$emailPersonne,
                'TEL_PERSONNE'      =>$telPersonne,
                'TYPE_PERSONNE'     =>$typePersonne,
                'KABIS_PERSONNE'    =>$kabisPersonne,
                'ID_FORMATEUR'      =>0,
                'ID_STAGIAIRE'      =>0,
                'ID_ENT_OPCO'       =>0,
                'CV_PERSONNE'       =>$fichier,
                'ROLE_ADMIN_WP'     =>false,
                'ROLE_ADMIN_SOLUTION'     =>false,
                'ROLE_ADMROLE_GESTIONNAIREIN_WP'     =>false,
                'ROLE_ADMROLE_ASSISTANTEIN_WP'     =>false,
                'ROLE_FINANCE'     =>false,
                'ROLE_FORMATEUR'     =>false,
                'ROLE_CLIENT'     =>false,
                'ROLE_SUBROGATEUR'     =>false,
            )
        );
        echo "<script>alert('".$prenomPersonne." ".$nomPersonne." a bien été créé !');</script>";
        echo "<script>window.location = '" .site_url("/administration")."'</script>";
    }
?>

<?php get_header()?>
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <form class="row" method="POST" enctype="multipart/form-data">
        <?php get_template_part( 'template-parts/forms/form', 'utilisateur');?>
    </form>
</div>
<?php get_footer(); ?>
