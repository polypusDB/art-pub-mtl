window.addEventListener("load", function()
{
    /**
     * détecte la largeur de la fenetre et met la bonne classe.
     */
    window.addEventListener("resize", function()
    {
        let classe = "desktop";

        if(window.innerWidth < 667){
            classe = "mobile";
        }
        else if(window.innerWidth < 768){
            classe = "tablette";
        }
        
        let body = document.querySelector("body");
        body.classList.remove("mobile");
        body.classList.remove("tablette");
        body.classList.remove("desktop");
        
        body.classList.add(classe);
    });
});