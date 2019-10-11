<div class="contenu-form admin">
    <a href="/art-pub-mtl/api/oeuvreAdmin">Retour à la liste</a>
    <h1>Formulaire de modification d'une oeuvre</h1>
<<<<<<< HEAD
    <?php
        extract($aData);
        // var_dump($aData);
    ?>
    <form action="/art-pub-mtl/api/oeuvreAdmin/mod/insert" method="POST">
        <fieldset>
            <legend>Caractéristiques principales :</legend>
            Titre : <input type="text" name="titre" value="<?=$titre ?>"/>
            Dimension (m) : <input type="text" name="dimension" value="<?=$dimension ?>"/>
            Matériel (français) : <input type="text" name="materiaux_francais" value="<?=$materiaux_francais ?>"/>
            Material (english) : <input type="text" name="materiaux_anglais" value="<?=$materiaux_anglais ?>"/>
            Technique (français) : <input type="text" name="technique_francais" value="<?=$technique_francais?>"/>
            Technical (english) : <input type="text" name="technique_anglais" value="<?=$technique_anglais ?>"/>
            Support:
            <select name="id_support">
                <option value="choix">Choisir un type de support</option>
                <?php 
                    if(!empty($liste_support)){
                        foreach($liste_support as $type_support){
                            if($type_support['id_support'] != $id_support)
                            {
                                echo "<option value='" . $type_support['id_support'] . "'> " . $type_support['nom_francais']. "</option>";                               
                            }
                            else
                            {
                                echo "<option value='" . $type_support['id_support'] . "' selected='selected'> " . $type_support['nom_francais']. "</option>";
                            }
                        }
                    }
                ?>
            </select>            
            Support (français) : <input type="text" name="support_nom_francais" value=""/>
            Support (english) : <input type="text" name="support_nom_anglais" value=""/>

            Description (français) :
            <textarea rows="4" cols="50" name="description" value="<?=$description ?>"></textarea>
            Description (english) :
            <textarea rows="4" cols="50" name="description_anglais" value="<?=$description_anglais ?>"></textarea>
            Catégorie :
            <select name="id_categorie">
                <option value="choix">Choisir une catégorie</option>                
                <?php 
                    if(!empty($liste_categorie)){
                        foreach($liste_categorie as $categorie){
                            if($categorie['id_categorie'] != $id_categorie)
                            {
                                echo "<option value='" . $categorie['id_categorie'] . "'> " . $categorie['nom_francais']."</option>";                                
                            }
                            else
                            {
                                echo "<option value='" . $categorie['id_categorie'] . "' selected='selected'> " . $categorie['nom_francais']."</option>";
                            }

                        }
                    }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Artiste :</legend>
            <!-- <div class="chercherForm">
                <i class="fas fa-search"></i>
                <input type="search" placeholder="Chercher une artiste" name="chercher_artiste">
            </div>
            ou -->
            <select name="id_artiste">
                <option value="choix">Choisir un artiste</option>
                <?php 
                    if(!empty($liste_artiste)){
                        foreach($liste_artiste as $artiste){
                            if($artiste['id_artiste'] != $id_artiste)
                            {
                                echo "<option value='" . $artiste['id_artiste'] . "'> " . $artiste['nom'] . " " . $artiste['prenom'] . " " . $artiste['nom_collectif'] . "</option>";                                
                            }
                            else
                            {
                                echo "<option value='" . $artiste['id_artiste'] . "' selected='selected'> " . $artiste['nom'] . " " . $artiste['prenom'] . " " . $artiste['nom_collectif'] . "</option>";                              
                            }
                        }
                    }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Endroit :</legend>
            Parc : <input type="text" name="parc" value="<?=$parc ?>"/>
            Batiment : <input type="text" name="batiment" value="<?=$batiment ?>"/>
            Adresse : <input type="text" name="adresse" value="<?=$adresse ?>"/>
            Latitude : <input type="text" name="coordonnee_latitude" value="<?=$coordonnee_latitude ?>"/>
            Longitude : <input type="text" name="coordonnee_longitude" value="<?=$coordonnee_longitude ?>"/>
            Arrondissement :
            <select name="id_arrondissement">
                <option value="choix">Choisir un arrondissement</option>                
                <?php 
                    if(!empty($liste_arrondissement)){
                        foreach($liste_arrondissement as $arrondissement){
                            if($arrondissement['id_arrondissement'] != $id_arrondissement)
                            {
                                 echo "<option value='" . $arrondissement['id_arrondissement'] . "'> " . $arrondissement['nom_arrondissement'] . "</option>";                               
                            }
                            else
                            {
                                echo "<option value='" . $arrondissement['id_arrondissement'] . "' selected='selected'> " . $arrondissement['nom_arrondissement'] . "</option>";
                            }
                        }
                    }
                ?>
            </select>
        </fieldset>
            <!--Télécharger une image-->
        <!-- <fieldset>
            <legend>Image :</legend>
            <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
            <input name="uploadedfile" type="file" />
        </fieldset> -->
            <!--Fin Télécharger une image-->

            <input type="hidden" name="id_oeuvre" value='<?=$id_oeuvre ?>'/> <!-- mettre l'id ici -->
            <input type="submit" value="Modifier"/>
        <div>
        <?php

        if($msgErreur != ""){
            echo $msgErreur;
        }
        ?>
        </div>   
            

=======
    <form action="/art-pub-mtl/api/oeuvreAdmin/mod" method="POST">
    <fieldset>
        <legend>Caractéristiques principales :</legend>
        Titre : <input type="text" name="titre" />
        Dimension (m) : <input type="text" name="dimension" />
        Matériel (français) : <input type="text" name="mateFR" />
        Material (english) : <input type="text" name="mateEN" />
        Technique (français) : <input type="text" name="techFR" />
        Technical (english) : <input type="text" name="techEN" />
        Support (français) : <input type="text" name="suppFR" />
        Support (english) : <input type="text" name="suppEN" />
        Description (français) :
        <textarea rows="4" cols="50" name="descFR"></textarea>
        Description (english) :
        <textarea rows="4" cols="50" name="descEN"></textarea>
        Catégorie :
        <select name="categorie">
            <option value="choix">Choisir une catégorie</option>
            <?php 
                if(!empty($liste)){
                    foreach($liste as $li){
                        echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                    }
                }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <legend>Artiste :</legend>
        <div class="chercherForm">
            <i class="fas fa-search"></i>
            <input type="search" placeholder="Chercher une artiste">
        </div>
        ou
        <select name="artiste">
            <option value="choix">Choisir une artiste</option>
            <?php 
                if(!empty($liste)){
                    foreach($liste as $li){
                        echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                    }
                }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <legend>Endroit :</legend>
        Parc : <input type="text" name="parc" />
        Batiment : <input type="text" name="batiment" />
        Adresse : <input type="text" name="adresse" />
        Latitude : <input type="text" name="latitude" />
        Longitude : <input type="text" name="longitude" />
        Arrondisement :
        <select name="categorie">
            <option value="choix">Choisir un arrondisement</option>
            <?php 
                if(!empty($liste)){
                    foreach($liste as $li){
                        echo "<option value='" . $li['Id'] . "'> " . $li['Nom'] . "</option>";
                    }
                }
            ?>
        </select>
    </fieldset>
        <!--Télécharger une image-->
    <fieldset>
        <legend>Image :</legend>
        <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
        <input name="uploadedfile" type="file" />
    </fieldset>
        <!--Fin Télécharger une image-->
            
        <input type="hidden" name="id" value=''/> <!-- mettre l'id ici -->
        <input type="submit" value="Modifier"/>
>>>>>>> 147cffc67d49fa43239b1724230226dfcc829926
    </form>
</div>

