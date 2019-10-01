<!--Temporaire --------->
<?php
 include "VueEntete.php";
 include "VueNavigation.php";
?>
<!--Temporaire --------->

<div class="container">
    <div class="contenu-form">
        <h1>Formulaire d'inscription</h1>
        <form action="" method="POST">	
			<div>
				<label for="name">Nom d'usager:</label>
				<input type="text" id="nom" name="user">
			</div>
			<div>
				<label for="courriel">Courriel:</label>
				<input type="text" id="courriel" name="courriel">
			</div>
            <div>
				<label for="mdp">Mot de Passe:</label>
                <input type="password" id="mdp" name="mdp">
                <label id="texte-mdp">Les mots de passe doivent contenir au moins 8 caractères, majuscules, minuscules et chiffres.</label>
                <input type="checkbox" name="voirMdp" value="voir"> Afficher le mot de passe
			</div>
			<div>
				<input type="submit" id="envoyer" value="ENVOYER">
			</div>
            <?php
                if(isset($msg) && $msg != "")
                {   
                    echo "<p>$msg</p>";
                    
                }
            ?>
		</form>
	</div>
</div>
