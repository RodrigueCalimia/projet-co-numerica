<?php/*
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
    }*/
?>

<form class="row" method="POST">
    <div class="col-md-6">
        <label for="nom_site" class="form-label">Libellé du site</label>
        <input type="text" name="nom_site" class="form-control" id="nom_site" required>
    </div>
    <div class="col-md-6">
        <label for="adresse_site" class="form-label">Adresse</label>
        <input type="text" name="adresse_site" class="form-control" id="adresse_site" required>
    </div>
    <div class="col-md-6">
        <label for="code_postal_site" class="form-label">Code postal</label>
        <input type="number" name="code_postal_site" class="form-control" id="code_postal_site" min="0"  required>
    </div>
    <div class="col-md-6">
        <label for="ville_site" class="form-label">Ville</label>
        <input type="text" name="ville_site" class="form-control" id="ville_site" required>
    </div>
    <div id="conteneur-btn">
        <button type="submit" class="btn btn-primary btn-right">Ajouter</button>
    </div>
</form>
