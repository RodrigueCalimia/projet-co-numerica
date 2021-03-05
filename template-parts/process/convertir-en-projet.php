<!-- Page du processus de création d'un devis -->
<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_projets contenant les devis
    $lesDevis = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_devis'));
        // récupération des données de la table wp_projets contenant les devis
        $lesProjets = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_projets'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
    // récupération des champs du formulaire
    if ($_POST) {
        $numFormation   =$_POST['numDevis'];
     echo " <script>console.log(".$numFormation.");</script> ";
        $statutDevis    ='EN ATTENTE DE REALISATION';
        // ajout des données dans la table
        $wpdb->update('wp_devis', 
            array(
                'STATUT_DEVIS'  =>$statutDevis
            ),
            array(
                'NUM_FORM'      =>$_POST['numDevis']
            )
        );
      //  $numProjet          =$_POST['num_projet'];
     //   $libForm            =$_POST['lib_form'];
     //   $societe            =$_POST['societe'];
     //   $statutProjet       =$_POST['statut_projet'];
     //   $datesForm          =$_POST['dates_form'];
     //   $nbStagiaires       =$_POST['nb_stagiaires'];
        // ajout des données dans la table
        $wpdb->insert('wp_projets', 
            array(
                  'NUM_PROJET'        =>$numFormation               
              //  'LIB_FORM'          =>$libForm,
              //  'SOCIETE'           =>$societe,
              //  'STATUT_PROJET'     =>$statutProjet,
              //  'DATES_FORM'        =>$datesForm,
              //  'NB_STAGIAIRES'     =>$nbStagiaires
            )
        );
        echo "<script>alert('Le devis n° ".$numFormation." a bien été converti en projet !');</script>";
        echo "<script>window.location = '" .site_url("/creer-un-projet")."'</script>";
    }
?>
<?php get_header()?>
<div class="main">
    <h1>Projet</h1>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-projet" role="tabpanel" aria-labelledby="nav-projet-tab">
                <div class="col-md-6">
                    <!-- Zone du choix du lieu de formation -->
                    <label for="validationServer01" class="form-label">Numéro de devis</label>
                    <!-- récupération des lieux de formation -->
                    <form action="" method="POST">
                        <select class="form-select" aria-label="Default select example" onchange="change_valeur();" id="listeFormation" name="numDevis" required>
                            <option selected></option>
                            <?php foreach ($lesDevis as $leDevis):
                                $numDevis = $leDevis->NUM_FORM;
                                $numDevisExist = "non";
                                    foreach ($lesProjets as $leProjet):
                                        $numProjet = $leProjet->NUM_PROJET;
                                            if($numDevis==$numProjet){
                                                $numDevisExist="oui";
                                            }
                                    endforeach;   
                                    if($numDevisExist=="non"){
                                ?> 
                                <option value="<?php echo  $leDevis->NUM_FORM ;?>"><?php echo  $leDevis->NUM_FORM ;?></option>
                            <?php  }  endforeach;?>
                        </select>
                        <br/>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary" type="submit">Convertir en projet</button>
                        </div>
                    </form>
                </div>
                <div class="table">
                    <table class="table table-striped table-hover">
                        <!-- dénomination des titres du tableau -->
                        <thead>
                            <tr>
                                <th>N° Projet</th>
                                <th>Libellé</th>
                                <th>Société</th>
                                <th>Statut</th>
                                <th>Dates de formation</th>
                                <th>Nb stagiaires</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- alimentation des lignes du tableau -->   
                        <tbody>
                            <?php foreach ($lesProjets as $leProjet): 
                              $statutProjet = $leProjet->STATUT_PROJET;
                              if($statutProjet!="EN ATTENTE"){
                            ?>
                                <tr>
                                    <td><?php echo  $leProjet->NUM_PROJET ;?></td>
                                    <td><?php echo  $leProjet->LIB_FORM ;?></td>
                                    <td><?php echo  $leProjet->SOCIETE;?></td>
                                    <td><?php echo  $leProjet->STATUT_PROJET;?></td>
                                    <td><?php echo  $leProjet->DATES_FORM;?></td>
                                    <td><?php echo  $leProjet->NB_STAGIAIRES;?></td>
                                    <td>
                                    <?php
                                        $statutProjet = $leProjet->STATUT_PROJET;
                                        if($statutProjet=="EN COURS"){
                                    ?>
                                        <span title="Modifier le projet" >
                                            <a href="#" >
                                                <i class="bi bi-pencil-square" ></i>
                                            </a>
                                        </span>
                                    <?php } else { 
                                    ?>
                                        <span title="Visulaiser le projet" >
                                            <a href="#" >
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } } endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
</div>

<script>
    function ConvertProjet() {
        window.location = '../creer-un-projet';
    }
</script>

<script>
    function change_valeur() {
        select = document.getElementById("listeFormation");
        choice = select.selectedIndex;
        valeur = select.options[choice].value;
        texte = select.options[choice].text;
        
        <?php foreach ($formations as $formation):?> 
            if (valeur==$formation->ID_FORMATION) {
                document.getElementById('validationServer02').value = $formation->OBJ_FORMATION;
                document.getElementById('validationServer03').value = $formation->OBJ_PRO_FORMATION;
                document.getElementById('validationServer04').value = $formation->PARCOUR_PEDA_PREVI;
            }
                        <?php endforeach;?>
    }
</script>
<?php get_footer(); ?>