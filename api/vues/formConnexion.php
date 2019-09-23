

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
				<input type="password" id="mdp" name="mdp">
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
		<?php
            }
            else
            {
                //on affiche le lien de logout
				echo "<h3>Vous êtes déjà connecté!</h3>"; 
				echo "<a href=''>Se Déconnecter </a>";                            
            }  
        ?>
	</div>
</div>
