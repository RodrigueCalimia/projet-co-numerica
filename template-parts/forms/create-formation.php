<?php
    global $wpdb;
    if ($_POST) {
        // récupération des valeurs des champs du formulaire
        $nomFormation       =$_POST['nom_formation'];
        $objFormation       =$_POST['obj_formation'];
        $objProFormation    =$_POST['obj_pro_formation'];
        $parcPedaPrevi      =$_POST['parc_peda_previ'];
        // ajout des données dans la table
        $wpdb->insert('wp_formations', 
            array(
                'NOM_FORMATION'         =>$nomFormation,
                'OBJ_FORMATION'         =>$objFormation,
                'OBJ_PRO_FORMATION'     =>$objProFormation,
                'PARCOUR_PEDA_PREVI'    =>$parcPedaPrevi,
            )
        );
        echo "<script>alert('La formation ".$nomFormation." a bien été créée !');</script>";
        echo "<script>window.location = '" .site_url("/les-formations")."'</script>";
    }
?>

<form class="row" method="POST">
    <div class="col-md-6">
        <label for="nom_formation" class="form-label">Libellé de la formation</label>
        <input type="text" name="nom_formation" class="form-control" id="nom_formation" required>
    </div>
    <div class="col-md-6">
        <label for="obj_formation" class="form-label">Objectifs de la formation</label>
        <input type="text" name="obj_formation" class="form-control" id="obj_formation" required>
    </div>
    <div class="col-md-6">
        <label for="obj_pro_formation" class="form-label">Objectifs professionnels de la formation</label>
        <input type="text" name="obj_pro_formation" class="form-control" id="obj_pro_formation" required>
    </div>
    <div class="col-md-6">
        <label for="parc_peda_previ" class="form-label">Parcours pédagogique prévisionnel</label>
        <input type="text" name="parc_peda_previ" class="form-control" id="parc_peda_previ" required>
    </div>
    <div id="conteneur-btn">
        <button type="submit" class="btn btn-primary btn-right">Ajouter</button>
    </div>
</form>
    