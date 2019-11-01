<section class="contenu usager">
    <?php
        extract($aData);
    ?>
    <div class="infoTexte">
        <h1>Bienvenue</h1>
        <h2>Mes informations</h2>
        <p>Nom d'usager : <?=$nom_connexion ?>
        <p>Nom : <?=$nom ?>
        <p>Prénom : <?=$prenom ?>
        <p>Adresse courriel : <?=$courriel ?>
    </div>
</section>