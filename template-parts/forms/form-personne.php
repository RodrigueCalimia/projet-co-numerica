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
