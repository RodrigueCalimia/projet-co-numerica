<?php
    global $wpdb;
    // récupération des données de la table
    $lesTypeEntrepriseOpco = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_type_entreprise_opco'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
    // traitement du formulaire
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $typeEntOpco    =$_POST['type-entreprise-opco'];
        $nomCommercial  =$_POST['nom_commercial'];
        $adresse        =$_POST['adresse-entreprise-opco'];
        $codePostal     =$_POST['code_postal-entreprise-opco'];
        $ville          =$_POST['ville-entreprise-opco'];
        $siret          =$_POST['siret-entreprise-opco'];
        $naf            =$_POST['naf-entreprise-opco'];  
        // ajout des données dans la table
        $wpdb->insert('wp_entreprises_opco', 
            array(
                'TYPE_ENT_OPCO'     =>$typeEntOpco,
                'NOM_ENT_OPCO'      =>$nomCommercial,
                'ADRESSE_ENT_OPCO'  =>$adresse,
                'CP_ENT_OPCO'       =>$codePostal,
                'VILLE_ENT_OPCO'    =>$ville,
                'SIRET_ENT_OPCO'    =>$siret,
                'NAF_ENT_OPCO'      =>$naf,
            )
        );
        echo "<script>alert('L\'".$typeEntOpco." ".$nomCommercial." a bien été créée !');</script>";
        echo "<script>window.location = '" .site_url("/les-entreprises")."'</script>";
    }
?>

<form class="row" method="POST">
    <div class="col-md-6">
        <!-- Zone du choix du lieu de formation -->
        <label for="type-entreprise-opco" class="form-label">Type</label>
        <!-- récupération des lieux de formation -->
        <select class="form-select" aria-label="Default select example" id="type-entreprise-opco" name="type-entreprise-opco" required>
            <option selected></option>
            <?php foreach ($lesTypeEntrepriseOpco as $leTypeEntrepriseOpco):?> 
                <option value="<?php echo $leTypeEntrepriseOpco->TYPE_ENT_OPCO;?>"><?php echo  $leTypeEntrepriseOpco->TYPE_ENT_OPCO ;?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="nom_commercial" class="form-label">Nom commercial</label>
        <input type="text" name="nom_commercial" class="form-control" id="nom_commercial" required>
    </div>
    <div class="col-12">
        <label for="adresse-entreprise-opco" class="form-label">Adresse</label>
        <input type="text" name="adresse-entreprise-opco" class="form-control" id="adresse-entreprise-opco" required>
    </div>
    <div class="col-md-6">
        <label for="code_postal-entreprise-opco" class="form-label">Code postal</label>
        <input type="number" name="code_postal-entreprise-opco" class="form-control" id="code_postal-entreprise-opco" min="0" required>
    </div>
    <div class="col-md-6">
        <label for="ville-entreprise-opco" class="form-label">Ville</label>
        <input type="text" name="ville-entreprise-opco" class="form-control" id="ville-entreprise-opco" required>
    </div>
    <div class="col-md-6">
        <label for="siret-entreprise-opco" class="form-label">Siret</label>
        <input type="text" name="siret-entreprise-opco" class="form-control" id="siret-entreprise-opco" required>
    </div>
    <div class="col-md-6">
        <label for="naf-entreprise-opco" class="form-label">NAF</label>
        <input type="text" name="naf-entreprise-opco" class="form-control" id="naf-entreprise-opco" required>
    </div>
    <div id="conteneur-btn">
        <button type="submit" class="btn btn-primary btn-right">Ajouter</button>
    </div>
</form>
