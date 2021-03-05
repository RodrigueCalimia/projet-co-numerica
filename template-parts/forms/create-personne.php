<?php
    global $wpdb;
    // récupération des données de la table wp_type_personne contenant les types des personnes
    $lesTypesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_type_personne'));
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomPersonne    =$_POST['nom_personne'];
        $prenomPersonne =$_POST['prenom_personne'];
        $emailPersonne  =$_POST['email_personne'];
        $telPersonne    =$_POST['tel_personne'];
        $kabisPersonne  =$_POST['kabis_personne'];
        $cvPersonne     =$_POST['cv_personne'];
        $typePersonne   =$_POST['type_personne'];
        // ajout des données dans la table
        $wpdb->insert('wp_personnes', 
            array(
                'NOM_PERSONNE'      =>$nomPersonne,
                'PRENOM_PERSONNE'   =>$prenomPersonne,
                'EMAIL_PERSONNE'    =>$emailPersonne,
                'TEL_PERSONNE'      =>$telPersonne,
                'KABIS_PERSONNE'    =>$kabisPersonne,
                'CV_PERSONNE'       =>$cvPersonne,
                'TYPE_PERSONNE'     =>$typePersonne,
            )
        );
        echo "<script>alert('".$prenomPersonne." ".$nomPersonne." a bien été créé !');</script>";
        echo "<script>window.location = '" .site_url("/les-personnes")."'</script>";
    }
?>

<form class="row" method="POST">
    <?php get_template_part( 'template-parts/forms/form', 'personne');?>
</form>
