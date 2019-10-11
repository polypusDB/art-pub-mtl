window.addEventListener("load", function(){ 
    //Menu Principal
    // on selectione l'icone menu-burger pour le donner à .menu une class .ouvert
    let menu_burger = document.querySelector(".menu-burger");
    menu_burger.addEventListener("click", function(e){
        let menu = document.querySelector(".menu");
        menu.classList.toggle("ouvert");

        let menuAdmin = document.querySelector(".menuadmin");
        menuAdmin.classList.toggle("ouvert");
    });

    // chaque fois qu'il fait "resize" la class .ouvert est effacée
    window.addEventListener("resize", function(e){
        document.querySelector(".menu").classList.remove("ouvert");    
        document.querySelector(".menuadmin").classList.remove("ouvert");          
    });

    // https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_navbar_hide_scroll
    // une facon de faire le menu-scroll
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.querySelector(".entete").style.top = "0";
        } else {
            document.querySelector(".entete").style.top = "-10px";
            document.querySelector(".menu").classList.remove("ouvert");
        }
        prevScrollpos = currentScrollPos;
    }
    
});