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

        echo "<script>window.location = '" .site_url("/les-personnes")."'</script>";
    }
?>

<div class="main">
    <h1>Ajouter un membre</h1>
    <form class="row" method="POST">
        <div class="col-md-6">
            <label for="nom_personne" class="form-label">Nom</label>
            <input type="text" name="nom_personne" class="form-control" id="nom_personne" required>
        </div>
        <div class="col-md-6">
            <label for="prenom_personne" class="form-label">Prénom</label>
            <input type="text" name="prenom_personne" class="form-control" id="prenom_personne" required>
        </div>
        <div class="col-md-6">
            <label for="email_personne" class="form-label">Email</label>
            <input type="text" name="email_personne" class="form-control" id="email_personne" value="" required>
        </div>
        <div class="col-md-6">
            <label for="tel_personne" class="form-label">Téléphone</label>
            <input type="text" name="tel_personne" class="form-control" id="tel_personne" value="" required>
        </div>
        <div class="col-md-6">
            <label for="kabis_personne" class="form-label">Kabis</label>
            <input type="text" name="kabis_personne" class="form-control" id="kabis_personne" value="" required>
        </div>
        <div class="col-md-6">
            <label for="type_personne" class="form-label">Type</label>
            <select name="type_personne" class="form-control" id="type_personne" value="">
                <option></option>
                <?php foreach ($lesTypesPersonnes as $leTypePersonne):
                    // stockage des données dans une varaible
                    $idTypePersonne = $leTypePersonne->ID_TYPE_PERSONNE;
                    $typePersonne   = $leTypePersonne->TYPE_PERSONNE;
                    if($typePersonne == "Interlocuteur administratif"){
                        ?> 
                        <option selected><?php echo  $typePersonne;?></option>
                        <?php } else { ?>
                        <option><?php echo  $typePersonne;?></option>
                <?php } endforeach;?>
            </select>
        </div>
        <div class="input-group mb-3 col-md-6">
            <label class="input-group-text" for="cv_personne">CV</label>
            <input type="file" class="form-control" id="cv_personne">
        </div>

        <div class="col-md-6">
            <input class="btn btn-primary" type="submit" value="ajouter"></input>
        </div>
    </form>
</div>
