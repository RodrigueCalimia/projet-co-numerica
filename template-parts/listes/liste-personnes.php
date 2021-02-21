<?php 
/* 
    Page contenant la liste de tous les membres
    issues de la base de données WordPress et se trouvant
    dans la table wp_personnes
*/
?>
<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_pesonnes contenant les sites
    $personnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_personnes'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <section>
        <div class="header-section">
            <div class="search">    
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="button" onclick="addPersonne()">Ajouter</button>
            </div>
        </div>
        <div class="table">
            <table class="table table-striped table-hover">
                <!-- dénomination des titres du tableau -->
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Kabis</th>
                        <th>CV</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($personnes as $personne):?>    
                        <tr>
                            <td><?php echo  $personne->NOM_PERSONNE ;?></td>
                            <td><?php echo  $personne->PRENOM_PERSONNE ;?></td>
                            <td><?php echo  $personne->EMAIL_PERSONNE ;?></td>
                            <td><?php echo  $personne->TEL_PERSONNE ;?></td>
                            <td><?php echo  $personne->KABIS_PERSONNE ;?></td>
                            <td><?php echo  $personne->CV_PERSONNE ;?></td>
                            <td class="table-td-action">
                                <span title="Modifier la personne" >
                                    <a href="#" >
                                        <i class="bi bi-pencil-square" ></i>
                                    </a>
                                </span>
                                <span title="Supprimer une personne">
                                    <a href="#">
                                        <i class="bi bi-trash-fill" ></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    function addPersonne() {
        window.location = '../ajouter-un-membre';
    }
</script>