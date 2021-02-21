<?php
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomPersonne             =$_POST['nom_personne'];
        $prenomPersonne          =$_POST['prenom_personne'];
        $emailPersonne           =$_POST['email_personne'];
        $telPersonne             =$_POST['tel_personne'];
        $kabisPersonne           =$_POST['kabis_personne'];
   //     $cvPersonne              =$_POST['cv_personne'];
    //    $typePersonne            =$_POST['type_personne'];
        // ajout des données dans la table
        $wpdb->insert('wp_personnes', 
            array(
                'NOM_PERSONNE'                   =>$nomPersonne,
                'PRENOM_PERSONNE'                =>$prenomPersonne,
                'EMAIL_PERSONNE'                 =>$emailPersonne,
                'TEL_PERSONNE'                   =>$telPersonne,
                'KABIS_PERSONNE'                 =>$kabisPersonne,
              //  'CV_PERSONNE'                    =>$cvPersonne,
            )
        );

        echo "<script>window.location = '" .site_url("/les-personnes")."'</script>";
    }
?>

<div class="main">
    <h1>Ajouter un membre</h1>
    <form class="row" method="POST">
        <div class="col-md-6">
            <label for="validationServer01" class="form-label">Nom</label>
            <input type="text" name="nom_personne" class="form-control" id="validationServer01" required>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer02" class="form-label">Prénom</label>
            <input type="text" name="prenom_personne" class="form-control" id="validationServer02" required>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer03" class="form-label">Email</label>
            <input type="text" name="email_personne" class="form-control" id="validationServer03" value="" required>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer04" class="form-label">Téléphone</label>
            <input type="text" name="tel_personne" class="form-control" id="validationServer04" value="" required>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer05" class="form-label">Kabis</label>
            <input type="text" name="kabis_personne" class="form-control" id="validationServer05" value="" required>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer06" class="form-label">CV</label>
            <button class="btn btn-primary" type="button">Télécharger</button>
            <div class="valid-feedback">
            
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationServer07" class="form-label">Type</label>
            <select name="type_personne" class="form-control" id="validationServer07" value="">
            <div class="valid-feedback">
            
            </div>
        </div>

        <div class="col-md-6">
            <input class="btn btn-primary" type="submit" value="ajouter"></input>
        </div>
    </form>
</div>
