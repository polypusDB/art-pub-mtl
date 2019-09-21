<div class="container">
    <div class="contenu-form">
        <h1>Formulaire ajouter une oeuvre</h1>
        <form action="/art-pub-mtl/api/oeuvre/ajouter/insert" method="POST">
            Titre : <input type="text" name="titre" /><br>
            Dimension : <input type="text" name="dimension" /><br>
            <!-- Matériaux (séparé les matériaux par des points-virgule) : <input type="text" name="materiaux" /><br>
            Technique  (séparé les technique par des points-virgule) : <input type="text" name="technique" /><br>-->
            Description : <input type="text" name="description" /><br>
            Catégorie :
            <select name="id_categorie">
                <!-- <option value="choix">Choisir</option> -->
                <?php 
                    if(!empty($liste_categorie)){
                        foreach($liste_categorie as $categorie){
                            echo "<option value='" . $categorie['id_categorie'] . "'> " . $categorie['nom_francais'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Support:
            <select name="id_support">
                <!-- <option value="choix">Choisir</option> -->
                <?php 
                    if(!empty($liste_support)){
                        foreach($liste_support as $type_support){
                            echo "<option value='" . $type_support['id_support'] . "'> " . $type_support['nom_francais'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Arrondissement:
            <select name="id_arrondissement">
                <!-- <option value="choix">Choisir</option> -->
                <?php 
                    if(!empty($liste_arrondissement)){
                        foreach($liste_arrondissement as $arrondissement){
                            echo "<option value='" . $arrondissement['id_arrondissement'] . "'> " . $arrondissement['nom'] . "</option>";
                        }
                    }
                ?>
            </select>
            <br>
            Parc : <input type="text" name="parc" /><br>
            Bâtiment : <input type="text" name="batiment" /><br>
            Adresse : <input type="text" name="adresse" /><br>
            Coordonnee latitude : <input type="text" name="coordonnee_latitude" /><br>
            Coordonnee longitude : <input type="text" name="coordonnee_longitude" /><br>

            <!--Télécharger une image-->
            <!--Image : 
            <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
            <input name="uploadedfile" type="file" />
            <!--Fin Télécharger une image-->
            <br>
            <input type="hidden" name="action" value=''/>
            <input type="submit" value="Ajouter"/>
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
