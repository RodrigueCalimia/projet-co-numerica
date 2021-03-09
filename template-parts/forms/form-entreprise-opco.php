<div class="row">
    <div class="col-md-6">
        <label for="typeEntrepriseOPCO" class="form-label">Type</label>
        <select class="form-select" aria-label="Default select example" id="typeEntrepriseOPCO" value="">
            <option selected>Entreprise</option>
            <option>OPCO</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="nom_commercial" class="form-label">Nom commercial</label>
        <input type="text" name="nom_commercial" class="form-control" id="nom_commercial" required>
    </div>
</div>
<div class="col-12">
    <label for="adresse-entreprise-opco" class="form-label">Adresse</label>
    <input type="text" name="adresse-entreprise-opco" class="form-control" id="adresse-entreprise-opco" required>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="code_postal-entreprise-opco" class="form-label">Code postal</label>
        <input type="number" name="code_postal-entreprise-opco" class="form-control" id="code_postal-entreprise-opco" min="0" required>
    </div>
    <div class="col-md-6">
        <label for="ville-entreprise-opco" class="form-label">Ville</label>
        <input type="text" name="ville-entreprise-opco" class="form-control" id="ville-entreprise-opco" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="siret-entreprise-opco" class="form-label">Siret</label>
        <input type="text" name="siret-entreprise-opco" class="form-control" id="siret-entreprise-opco" required>
    </div>
    <div class="col-md-6">
        <label for="naf-entreprise-opco" class="form-label">NAF</label>
        <input type="text" name="naf-entreprise-opco" class="form-control" id="naf-entreprise-opco" required>
    </div>
</div>
<div id="conteneur-btn">
    <button type="submit" class="btn btn-primary btn-right">Ajouter</button>
</div>