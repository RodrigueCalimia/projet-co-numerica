
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <div class="d-grid gap-2 d-md-block">
        <button class="btn btn-outline-primary" type="button" onclick="openListeSites()">Les Sites Numerica</button>
        <button class="btn btn-outline-primary" type="button">Button</button>
    </div>
</div>

<script>
    function openListeSites() {
        window.location = '../les-sites-numerica';
    }
</script>