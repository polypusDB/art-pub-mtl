<!--Temporaire --------->
<?php
 include "VueEntete.php";
 include "VueNavigation.php";
?>
<!--Temporaire --------->

<div class="container">
    <div class="contenu-form">
        <h1>Formulaire ajouter une oeuvre</h1>
        <form action="" method="POST">
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
            Artiste:
            <div class="chercherForm">
                <i class="fas fa-search"></i>
                Chercher une artiste<input type="search" placeholder="Chercher">
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
            <!--Télécharger une image-->
            Image : 
            <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
            <input name="uploadedfile" type="file" />
            <!--Fin Télécharger une image-->
             
            <input type="hidden" name="action" value=''/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>
</div>
