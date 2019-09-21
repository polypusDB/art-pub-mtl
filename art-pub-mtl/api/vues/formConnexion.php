

<div class="container">
    <div class="contenu-form">
		<?php
            //si je ne suis pas authentifié, on affiche le formulaire de login
            if(!isset($_SESSION["login"]))
            {            
        ?>  
        <h1>Formulaire de Connexion</h1>
        <form action="/art-pub-mtl/api/connection/login" method="POST">	
			<div>
				<label for="name">Login:</label>
				<input type="text" id="name" name="user">
			</div>
			<div>
				<label for="mdp">Mot de passe:</label>
				<input type="mdp" id="mdp" name="mdp">
			</div>
			<div>
				<input type="submit" id="envoyer" value="ENVOYER">
			</div>		
		</form>
		<?php
            }
            else
            {
                //on affiche le lien de logout
				echo "<h3>Vous êtes déjà connecté!</h3>"; 
				echo "<a href=''>Se Déconnecter </a>";                            
            }  
            
            if(isset($msgErreur))
            {   
                echo "<p>$msgErreur</p>";
                
            }
        ?>
	</div>
</div>
