<?php 
    /*include "../vues/commun/entete.php";*/
?>
<div class="container">
    <?php 
      /*include "../vues/commun/navigation.php"; */
    ?>
    <div class="contenu">
        <h1>Formulaire ajouter un artiste</h1>
        <form action="" method="POST">
            Nom : <input type="text" name="nom" /><br>
            Prenom : <input type="text" name="prenom" /><br>
            Nom Collectif : <input type="text" name="nomCollectif" /><br>
            Biographie : <input type="text" name="biographie" /><br>
            <input type="hidden" name="action" value=''/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>
</div>
<?php 
    /*include "../vues/commun/pied.php";*/
?>