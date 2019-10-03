<div class="container">
    <div class="contenu-form">
        <h1>Formulaire ajouter un artiste</h1>
        <form action="/art-pub-mtl/api/artiste/ajouter/insert" method="POST">
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

    </div>
</div>