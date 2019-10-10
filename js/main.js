window.addEventListener("load", function(){ 

    //Cacher ou Afficher les forms d'inscription et de connexion
    let bt_inscript = document.querySelector(".btInscription");
    let bt_connexion = document.querySelector(".btConnexion");

    bt_inscript.addEventListener("click", function(e){
        document.querySelector(".formInscription").classList.remove("cacher"); 
        document.querySelector(".formConnexion").classList.toggle("cacher");
    });

    bt_connexion.addEventListener("click", function(e){
        document.querySelector(".formConnexion").classList.remove("cacher");
        document.querySelector(".formInscription").classList.toggle("cacher"); 
    });
    
});