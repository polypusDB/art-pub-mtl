window.addEventListener("load", function(){

    
    if(document.querySelector(".filtres")){
        let titreArron = document.querySelector(".titreArron");
        let divArron = document.querySelector(".filtresArr");

        titreArron.addEventListener("click", function(){
            console.log("allo");
            divArron.classList.toggle("cacher");
        })
    }
})