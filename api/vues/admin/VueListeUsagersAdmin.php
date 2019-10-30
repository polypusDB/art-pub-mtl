<div class="contenu listeArtiste">
    <div class="titreListe">
        <h1 id="ancre">Liste des usagers</h1>
    </div>
    <section>
        <form action="" method="POST">
            <div class="bts-principal">
                <div class="bt-supprimer">
                    <input type="submit" name="supp" value="" />
                </div>
            </div>
            <?php
				if(isset($msgErreur)){
					echo "<div class='msg-erreur'>" . $msgErreur . "</div>";
				}
			?>
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
            <?php
            foreach ($aData as $cle => $usager) {
                extract($usager);
            ?>      
                <tr>
                    <td><input type="checkbox" name="checks[]" value="<?=$id_usager ?>"></td>
                    <td> <h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom ." ". $prenom; } else { echo $nom_connexion; } ?></h2></td>
                    <td><a class="btnSup" href="/art-pub-mtl/api/admin/usagers/sup/<?=$id_usager ?>"><i class="fas fa-trash-alt"></i></a></td>  
                </tr>
            <?php
            }
            ?>
            </table>
        </form>
    </section>
    <?php
        include "VuePiedAdmin.php";
    ?>
</div>


			