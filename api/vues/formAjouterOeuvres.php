<div class="container">
    <div class="contenu-form">
        <h1>Formulaire ajouter une oeuvre</h1>
        <form action="" method="POST">
            Titre : <input type="text" name="titre" /><br>
            Dimension (m) : <input type="text" name="dimension" /><br>
            Material (a,b,c) : <input type="text" name="material" /><br>
            Technique : <input type="text" name="technique" /><br>
            Categorie :
            <select name="categorie">
                <option value="choix">Choisir</option>
                <?php 
                    if(!empty($liste)){
                        foreach($liste as $li){
                            echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Support:
            <select name="support">
                <option value="choix">Choisir</option>
                <?php 
                    if(!empty($liste)){
                        foreach($liste as $li){
                            echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Endroit:
            <select name="endroit">
                <option value="choix">Choisir</option>
                <?php 
                    if(!empty($liste)){
                        foreach($liste as $li){
                            echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Description : <input type="text" name="description" /><br>

            <!--Télécharger une image-->
            Image : 
            <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
            <input name="uploadedfile" type="file" />
            <!--Fin Télécharger une image-->
            <br>
            <input type="hidden" name="action" value=''/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>
</div>
