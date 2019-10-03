    <div class="contenu">
        <h1>Bienvenue
        <?php
            echo $_SESSION["utilisateur"]["nom_connexion"];
        ?> 
        !
        </h1>
        <div class="home-info">
            <div class="infoIco"></div>
            <div class="infoTexte">
                <h2>Mon Information</h2>
                <p>
                <?php
                    echo $_SESSION["utilisateur"]["prenom"];
                    echo " ";
                    echo $_SESSION["utilisateur"]["nom"];
                ?>
                </p>
                <p>
                <?php
                    echo $_SESSION["utilisateur"]["courriel"];
                ?>
                </p>
            </div>
            <a href="">
                <div class="infobt">Voir mon profil</div>
            </a>
        </div>
        <div class="home-cont">
            <section>
                <h3><a href="">Artistes</a></h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                    </table>
                </div>
            </section>
            <section>
                <h3><a href="">Oeuvres</a></h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                        <tr>
                            <td>Titre</td>
                            <td>Editer</td>
                        </tr>
                    </table>
                </div>
            </section>
            <section>
                <h3><a href="">Parcours</a></h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Titre</td>
                            <td>Categorie</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>Nom</td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>
       



             
        
    <?php
        include "VuePiedAdmin.php";
    ?>
    </div>
    
</div>


