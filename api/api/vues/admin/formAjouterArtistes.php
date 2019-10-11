<div class="contenu-form admin">
    <a href="/art-pub-mtl/api/artisteAdmin">Retour à la liste</a>
    <h1>Formulaire ajouter un artiste</h1>
    <form action="/art-pub-mtl/api/artisteAdmin/ajouter/insert" method="POST">
        Nom : <input type="text" name="nom" /><br>
        Prenom : <input type="text" name="prenom" /><br>
        Nom Collectif : <input type="text" name="nom_collectif" /><br>
        Biographie : <input type="text" name="biographie" /><br>
        <input type="hidden" name="action" value=''/>
        <input type="submit" value="Ajouter"/>
        <div>
        <!-- <?php
        
        if($msgErreur != ""){
            echo $msgErreur;
        }
        ?> -->
        </div>
    </form>
    <?php
    include "VuePiedAdmin.php";
    ?>
</div>
