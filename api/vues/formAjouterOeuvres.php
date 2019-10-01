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
            Material (a,b,c) : <input type="text" name="material" />
            Technique : <input type="text" name="technique" />
            Description (français) :
            <textarea rows="4" cols="50" name="descFR"></textarea>
            Description (english) :
            <textarea rows="4" cols="50" name="descEN"></textarea>
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
             
            Description : <input type="text" name="description" /> 
            Description : <input type="text" name="description" /> 

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
