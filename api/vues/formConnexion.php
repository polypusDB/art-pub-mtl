<div class="container">
    <div class="contenu-form">
        <?php
            //si je ne suis pas authentifié, on affiche le formulaire de login
            if(!isset($_SESSION["login"]))
            {            
        ?>  
        <div class="formConnexion <?php
            if($action == "inscription"){
                echo "cacher";
            }
        ?>">
            <h1>Formulaire de Connexion</h1>
            <form action="/art-pub-mtl/api/connection/login" method="POST">	
                <div>
                    <label for="name">Nom d'usager:</label>
                    <input type="text" id="name" name="user">
                </div>
                <div>
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp">
                </div>
                <div>
                    <input type="submit" id="envoyer" value="ENVOYER">
                </div>
                <div>
                    <label id="texte-mdp">Vous n'avez pas encore de compte ? <span class="btInscription">Créez-en un !</span></label>
                </div>
                <?php
                    if(isset($msg) && $msg != "")
                    {   
                        echo "<p>$msg</p>";
                        
                    }
                ?>
            </form>
        </div>

        <div class="formInscription <?php
            if($action == "connexion"){
                echo "cacher";
            }
        ?>">
            <h1>Formulaire d'inscription</h1>
            <form class="form2" action="/art-pub-mtl/api/connection/inscription" method="POST">	
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
                <div>
                    <label id="texte-mdp">Vous avez un compte ? <span class="btConnexion">Se conecter !</span></label>
                </div>
                <?php
                    if(isset($msg) && $msg != "")
                    {   
                        echo "<p>$msg</p>";
                        
                    }
                ?>
            </form>
        </div>

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
