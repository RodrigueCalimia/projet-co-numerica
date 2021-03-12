<?php
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomSite        =$_POST['nom_site'];
        $adresseSite    =$_POST['adresse_site'];
        $cpSite         =$_POST['code_postal_site'];
        $villeSite      =$_POST['ville_site'];
        // ajout des données dans la table
        $wpdb->update('wp_sites', 
            array(
                'NOM_SITE'          =>$nomSite,
                'ADRESSE_SITE'      =>$adresseSite,
                'CODE_POSTAL_SITE'  =>$cpSite,
                'VILLE_SITE'        =>$villeSite,
            ),
            array('ID_SITE'  =>$_GET['idSite'])
        );
        echo "<script>alert('Le site ".$nomSite." a bien été mise à jour !');</script>";
        echo "<script>window.location = '" .site_url("/administration")."'</script>";
    }
?>
<?php get_header()?>
<div class="main">   
    <h1><?php the_title()?></h1>
    <div class="container form-dim-width">
        <form class="row justify-content-between" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="nom_site" class="form-label">Libellé du site</label>
                <input type="text" name="nom_site" class="form-control" id="nom_site" value="<?php echo $_GET['nomSite'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="adresse_site" class="form-label">Adresse</label>
                <input type="text" name="adresse_site" class="form-control" id="adresse_site" value="<?php echo $_GET['adresseSite'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="code_postal_site" class="form-label">Code postal</label>
                <input type="number" name="code_postal_site" class="form-control" id="code_postal_site" value="<?php echo $_GET['codePostalSite'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="ville_site" class="form-label">Ville</label>
                <input type="text" name="ville_site" class="form-control" id="ville_site" value="<?php echo $_GET['villeSite'];?>" required>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-secondary" onclick="ShowListeSites()">Annuler</button>
            </div>
            <div class="col-md-6 btn-justify-content-end">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</div>

<script>
    function ShowListeSites() {
        window.location = '../administration';
    }
</script>
<?php get_footer(); ?>