   <!-- il est temporaire-->
    <head>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="../../css/main.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../../css/formulaires.css" type="text/css" media="screen">
	</head>
	<!-- il est temporaire-->

<div class="container">
    <div class="contenu-form">
		<?php
            //si je ne suis pas authentifié, on affiche le formulaire de login
            if(!isset($_SESSION["login"]))
            {            
        ?>  
        <h1>Formulaire de Connexion</h1>
        <form action="" method="POST">	
			<div>
				<label for="name">Login:</label>
				<input type="text" id="name" name="login">
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
