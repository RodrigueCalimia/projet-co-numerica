<?php 
    // récupération des données de la table wp_type_personne contenant les types des personnes
    $lesTypesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_type_personne'));
?>
<div class="row">
    <div class="col-md-6">
        <label for="nom_personne" class="form-label">Nom</label>
        <input type="text" name="nom_personne" class="form-control" id="nom_personne" required>
    </div>
    <div class="col-md-6">
        <label for="prenom_personne" class="form-label">Prénom</label>
        <input type="text" name="prenom_personne" class="form-control" id="prenom_personne" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="email_personne" class="form-label">Email</label>
        <input type="text" name="email_personne" class="form-control" id="email_personne" value="" required>
    </div>
    <div class="col-md-6">
        <label for="tel_personne" class="form-label">Téléphone</label>
        <input type="text" name="tel_personne" class="form-control" id="tel_personne" value="" required>
    </div>
</div>
<div class="row">
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
                ?> 
                    <option><?php echo  $typePersonne;?></option>
            <?php endforeach;?>
        </select>
    </div>
</div>
<div class="row">
    <div class="input-group mb-3 col-md-6">
        <label class="input-group-text" for="cv_personne">CV</label>
        <input type="file" class="form-control" id="cv_personne" name="cv_personne">
    </div>
</div>
<div class="col-md-6">
    <button type="button" class="btn btn-secondary" onclick="ShowListeUtilisateurs()">Annuler</button>
</div>
<div class="col-md-6 btn-justify-content-end">
    <button type="submit" class="btn btn-primary">Ajouter</button>
</div>

<script>
    function ShowListeUtilisateurs() {
        window.location = '../administration';
    }
</script>
