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
        
        if ($typeEntOpcoPage == 'Entreprises'):
            echo "<script>window.location = '" .site_url("/les-entreprises")."'</script>";
        elseif ($typeEntOpcoPage == 'OPCO'):
            echo "<script>window.location = '" .site_url("/les-opco")."'</script>";
        endif;
    }
?>

<form class="row" method="POST">
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
