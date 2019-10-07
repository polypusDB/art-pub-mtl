<div class="container">
    <div class="contenu-form">
        <a href="/art-pub-mtl/api/artisteAdmin">Retour à la liste</a>
        <h1>Formulaire modifier un artiste</h1>
        <?php
            extract($aData);
            // var_dump($aData);
        ?>
        <form action="/art-pub-mtl/api/artisteAdmin/mod/insert" method="POST">
            Nom : <input type="text" name="nom" value="<?=$nom ?>"/><br>
            Prenom : <input type="text" name="prenom" value="<?=$prenom ?>"/><br>
            Nom Collectif : <input type="text" name="nom_collectif" value="<?=$nom_collectif ?>"/><br>
            Biographie : <input type="text" name="biographie"value="<?=$biographie ?>" /><br>
            <input type="hidden" name="id" value='<?=$id_artiste ?>'/>
            <input type="submit" value="Modifier"/>
            <div>
            <?php
            if($msgErreur != ""){
                echo $msgErreur;
            }
            ?>
            </div>
        </form>

    </div>
</div>