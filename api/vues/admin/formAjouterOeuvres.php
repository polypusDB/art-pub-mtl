<?php
    // Champ vide au début.
    $titre = "";
    $dimension = "";
    $materiaux_francais = "";
    $materiaux_anglais = "";
    $technique_francais = "";
    $technique_anglais = "";
    $id_support = "";
    $support_nom_francais = "";
    $support_nom_anglais = "";
    $description = "";
    $id_categorie = "";
    $id_artiste = "";
    $parc = "";
    $batiment = "";
    $adresse = "";
    $coordonnee_latitude = "";
    $coordonnee_longitude = "";
    $id_arrondissement = "";
    
    // Récupère les données d'un formulaire d'ajout mal saisi.
    if(isset($_POST["titre"]))
    {
        $titre = $_POST["titre"];
    }

    if(isset($_POST["dimension"]))
    {
        $dimension = $_POST["dimension"];
    }

    if(isset($_POST["materiaux_francais"]))
    {
        $materiaux_francais = $_POST["materiaux_francais"];
    }

    if(isset($_POST["materiaux_anglais"]))
    {
        $materiaux_anglais = $_POST["materiaux_anglais"];
    }

    if(isset($_POST["technique_francais"]))
    {
        $technique_francais = $_POST["technique_francais"];
    }

    if(isset($_POST["technique_anglais"]))
    {
        $technique_anglais = $_POST["technique_anglais"];
    }

    if(isset($_POST["id_support"]))
    {
        $id_support = $_POST["id_support"];
    }

    if(isset($_POST["support_nom_francais"]))
    {
        $support_nom_francais = $_POST["support_nom_francais"];
    }

    if(isset($_POST["support_nom_anglais"]))
    {
        $support_nom_anglais = $_POST["support_nom_anglais"];
    }

    if(isset($_POST["description"]))
    {
        $description = $_POST["description"];
    }

    if(isset($_POST["id_categorie"]))
    {
        $id_categorie = $_POST["id_categorie"];
    }

    if(isset($_POST["id_artiste"]))
    {
        $id_artiste = $_POST["id_artiste"];
    }

    if(isset($_POST["parc"]))
    {
        $parc = $_POST["parc"];
    }

    if(isset($_POST["batiment"]))
    {
        $batiment = $_POST["batiment"];
    }

    if(isset($_POST["adresse"]))
    {
        $adresse = $_POST["adresse"];
    }

    if(isset($_POST["coordonnee_latitude"]))
    {
        $coordonnee_latitude = $_POST["coordonnee_latitude"];
    }

    if(isset($_POST["coordonnee_longitude"]))
    {
        $coordonnee_longitude = $_POST["coordonnee_longitude"];
    }   

    if(isset($_POST["id_arrondissement"]))
    {
        $id_arrondissement = $_POST["id_arrondissement"];
    }
?>

<div class="contenu-form admin">
    <a href="/art-pub-mtl/api/oeuvreAdmin">Retour à la liste</a>
    <h1>Formulaire ajouter une oeuvre</h1>
    <form action="/art-pub-mtl/api/oeuvreAdmin/ajouter/insert" method="POST" enctype="multipart/form-data">
        <label class="signalerON">* Champs obligatoires</label>
        <fieldset>
            <legend>Caractéristiques principales :</legend>
            Titre : <label class="signalerON">* <?= $listeMsgErreur["titre"] ?></label>
            <input type="text" name="titre"  value="<?= $titre ?>"/>
            Dimension (m) : <input type="text" name="dimension"  value="<?= $dimension ?>"/>
            Matériel (français) : <input type="text" name="materiaux_francais" value="<?= $materiaux_francais ?>"/>
            Material (english) : <input type="text" name="materiaux_anglais"  value="<?= $materiaux_anglais ?>"/>
            Technique (français) : <input type="text" name="technique_francais"  value="<?= $technique_francais ?>"/>
            Technical (english) : <input type="text" name="technique_anglais" value="<?= $technique_anglais ?>"/>
            Support: <label class="signalerON">* <?= $listeMsgErreur["support"] ?></label>
            <select name="id_support">
                <option value="choix">Choisir un type de support</option>
                <?php 
                    if(!empty($liste_support)){
                        foreach($liste_support as $type_support){
                            if($id_support != $type_support['id_support'])
                            {
                                echo "<option value='" . $type_support['id_support'] . "'> " . $type_support['nom_francais'] . "</option>";
                            }
                            else
                            {
                                echo "<option value='" . $type_support['id_support'] . "' selected='selected'> " . $type_support['nom_francais'] . "</option>";
                            }
                        }
                    }
                ?>
            </select>            
            Support (français) : <input type="text" name="support_nom_francais" value="<?= $support_nom_francais ?>"/>
            Support (english) : <input type="text" name="support_nom_anglais" value="<?= $support_nom_anglais ?>"/>

            Description : <label class="signalerON">* <?= $listeMsgErreur["description"] ?></label>
            <textarea rows="4" cols="50" name="description" ><?php echo htmlspecialchars(
    $description, ENT_QUOTES, 'UTF-8') ?></textarea>
            Catégorie : <label class="signalerON">* <?= $listeMsgErreur["categorie"] ?></label>
            <select name="id_categorie">
                <option value="choix">Choisir une catégorie</option>                
                <?php 
                    if(!empty($liste_categorie)){
                        foreach($liste_categorie as $categorie){
                            if($id_categorie != $categorie['id_categorie'])
                            {
                                echo "<option value='" . $categorie['id_categorie'] . "'> " . $categorie['nom_francais'] . "</option>";
                            }
                            else
                            {
                                echo "<option value='" . $categorie['id_categorie'] . "' selected='selected'> " . $categorie['nom_francais'] . "</option>";
                            }
                        }
                    }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label class="signalerON">* <?= $listeMsgErreur["artiste"] ?></label>
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
                            if($id_artiste != $artiste['id_artiste'])
                            {
                                echo "<option value='" . $artiste['id_artiste'] . "'> " . ucfirst(mb_strtolower($artiste['nom'], 'UTF-8')) . " " . ucfirst(mb_strtolower($artiste['prenom'], 'UTF-8')) . " " . ucfirst(mb_strtolower($artiste['nom_collectif'], 'UTF-8')) . "</option>";                               
                            }
                            else
                            {
                                echo "<option value='" . $artiste['id_artiste'] . " 'selected='selected'> " . ucfirst(mb_strtolower($artiste['nom'], 'UTF-8')) . " " . ucfirst(mb_strtolower($artiste['prenom'], 'UTF-8')) . " " . ucfirst(mb_strtolower($artiste['nom_collectif'], 'UTF-8')) . "</option>";
                            }
                            

                        }
                    }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Endroit :</legend>            
            Parc :
            <label class="signalerON">* <?= $listeMsgErreur["parc"] ?></label>
            <input type="text" name="parc" value="<?= $parc ?>"/>
            Batiment : <input type="text" name="batiment" value="<?= $batiment ?>"/>
            Adresse : <input type="text" name="adresse" value="<?= $adresse ?>"/>
            Latitude : <label class="signalerON">* <?= $listeMsgErreur["coordonnee_latitude"] ?></label>
            <input type="text" name="coordonnee_latitude" value="<?= $coordonnee_latitude ?>"/>
            Longitude : <label class="signalerON">* <?= $listeMsgErreur["coordonnee_longitude"] ?></label>
            <input type="text" name="coordonnee_longitude"  value="<?= $coordonnee_longitude ?>"/>
            Arrondissement :
            <label class="signalerON">* <?= $listeMsgErreur["arrondissement"] ?></label>
            <select name="id_arrondissement">
                <option value="choix">Choisir un arrondissement</option>                
                <?php 
                    if(!empty($liste_arrondissement)){
                        foreach($liste_arrondissement as $arrondissement){
                            if($id_arrondissement != $arrondissement['id_arrondissement'])
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
    <?php
    include "VuePiedAdmin.php";
    ?>    
</div>

