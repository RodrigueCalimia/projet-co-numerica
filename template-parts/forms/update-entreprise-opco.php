<?php
    // déterminiation du type d'entreprise ou OPCO
    // récupération du type d'entreprise ou OPCO
    $typeEntOpco = $_GET['typeEntOpco'];
    // contruction du nom de la page
    $titrePage = '';
    if($typeEntOpco == "Entreprise"){
        $titrePage = "Modifier une Entreprise";
    }elseif ($typeEntOpco == "OPCO") {
        $titrePage = "Modifier une OPCO";
    }
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
        // mise à jour des données dans la table
        $wpdb->update('wp_entreprises_opco', 
            array(
                'NOM_ENT_OPCO'      =>$nomCommercial,
                'ADRESSE_ENT_OPCO'  =>$adresse,
                'CP_ENT_OPCO'       =>$codePostal,
                'VILLE_ENT_OPCO'    =>$ville,
                'SIRET_ENT_OPCO'    =>$siret,
                'NAF_ENT_OPCO'      =>$naf,
            ),
            array('ID_ENT_OPCO'  =>$_GET['idEntOpco'])
        );
        echo "<script>alert('L\'".$typeEntOpco." ".$nomCommercial." a bien été mise à jour !');</script>";
        echo "<script>window.location = '" .site_url("/administration")."'</script>";
    }
?>

<?php get_header()?>
<div class="main">   
    <h1><?php echo ($titrePage) ?></h1>
    <div class="container form-dim-width">
        <form class="row justify-content-between" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="nom_commercial" class="form-label">Nom commercial</label>
                <input type="text" name="nom_commercial" class="form-control" id="nom_commercial" value="<?php echo $_GET['nomEntOpco'];?>" required>
            </div>
            <div class="col-12">
                <label for="adresse-entreprise-opco" class="form-label">Adresse</label>
                <input type="text" name="adresse-entreprise-opco" class="form-control" id="adresse-entreprise-opco" value="<?php echo $_GET['adresseEntOpco'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="code_postal-entreprise-opco" class="form-label">Code postal</label>
                <input type="number" name="code_postal-entreprise-opco" class="form-control" id="code_postal-entreprise-opco" min="0" value="<?php echo $_GET['cpEntOpco'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="ville-entreprise-opco" class="form-label">Ville</label>
                <input type="text" name="ville-entreprise-opco" class="form-control" id="ville-entreprise-opco" value="<?php echo $_GET['villeEntOpco'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="siret-entreprise-opco" class="form-label">Siret</label>
                <input type="text" name="siret-entreprise-opco" class="form-control" id="siret-entreprise-opco" value="<?php echo $_GET['siretEntOpco'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="naf-entreprise-opco" class="form-label">NAF</label>
                <input type="text" name="naf-entreprise-opco" class="form-control" id="naf-entreprise-opco" value="<?php echo $_GET['nafEntOpco'];?>" required>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-secondary" onclick="ShowListeEntreprisesOpco()">Annuler</button>
            </div>
            <div class="col-md-6 btn-justify-content-end">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</div>

<script>
    function ShowListeEntreprisesOpco() {
        window.location = '../administration';
    }
</script>
<?php get_footer(); ?>
