<div class="col-md-6">
    <label for="nom_formation" class="form-label">Libellé de la formation</label>
    <input type="text" name="nom_formation" class="form-control" id="nom_formation" required>
</div>
<div class="col-md-6">
    <label for="obj_formation" class="form-label">Objectifs de la formation</label>
    <input type="text" name="obj_formation" class="form-control" id="obj_formation" required>
</div>
<div class="col-md-6">
    <label for="validationServer03" class="form-label">Objectifs professionnels de la formation</label>
    <textarea class="form-control" value="" name="obj_pro_formation" id="obj_pro_formation" rows="3" required></textarea>
</div>
<div class="col-md-6">
    <label for="validationServer04" class="form-label">Parcours pédagogique prévisionnel</label>
    <textarea class="form-control" value="" name="parc_peda_previ" id="parc_peda_previ" rows="3" required></textarea>
</div>
<div class="col-md-6">
    <button type="button" class="btn btn-secondary" onclick="ShowListeFormations()">Annuler</button>
</div>
<div class="col-md-6 btn-justify-content-end">
    <button type="submit" class="btn btn-primary">Ajouter</button>
</div>

<script>
    function ShowListeFormations() {
        window.location = '../administration';
    }
</script>
    