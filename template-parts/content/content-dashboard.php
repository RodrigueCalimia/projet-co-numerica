<?php 
/* 
    Page contenant la liste de tous les projets
    issues de la base de données WordPress
*/
?>
<!--
<style type="text/css">
    .search {
        width:100%;
        
        margin-left:0px;
    }
    .input_search {
        margin-left:00px;
        height:30px;
        width:200px;
        font-size:22px;
    }
    .head {
        
        height:40px;
        font-size:25px;
        background-color:;
    }
    .tableau {
        margin: auto;
        display:flex;
        width: 70%;
        flex-direction:column;
        padding:10px;
        background-color:;
    }
    table {
        border:1px solid black;
    }
    td {
        border:solid;
        border-width: thin;
        border-right-width:1px;
        text-align:center;
        height:40px;
    }
    th {
        border:0.5px solid black;
        text-align:center;
        height:40px;
    }
    .couleur {
        background-color:#D1D2D4;
    }
    .couleur2 {
        background-color:#B0B3B7;
    }
</style>
-->
<?php 
    global $wpdb; 
    $resultats = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_client'));
    $formations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formation'));
    $wpdb -> print_error ();

foreach ($resultats as $page) {
    $page->ID;
    $page->client_name;
}
foreach ($formations as $format) {
    $format->ID;
    $format->client_name;
}
?>
<div class="search">
    <h1>Tableau de bord</h1>
    <div class="tableau">
    <input class="input_search"/>
    <br/>
    <table cellspacing="0">
        <tbody>
            <tr>
                <th>PROJET</th>
                <th>CLIENT</th>
                <th>FORMATION</th>
                <th>DATE</th>
                <th>MONTANT</th>
                <th>STATUT</th>
            </tr>
            <tr>
                <td class="couleur"><?php echo  $page->client_name ;?></td>
                <td class="couleur"><?php echo  $page->client_name ;?></td>
                <td class="couleur"><?php echo $format->formation_name;?></td>
                <td class="couleur">buterffly</td>
                <td class="couleur">buterffly</td>
                <td class="couleur">buterffly</td>
            </tr>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
    </table>
    <div>
</div>