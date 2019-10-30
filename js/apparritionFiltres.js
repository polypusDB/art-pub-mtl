window.addEventListener("load", function(){

    
    if(document.querySelector(".filtres")){
        let titreArron = document.querySelector(".titreArron");
        let divArron = document.querySelector(".filtresArr");


        let divCat = document.querySelector(".filtresCat");
        let titreCat = document.querySelector(".titreCat");

        let divMat = document.querySelector(".filtresMat");
        let titreMat = document.querySelector(".titreMat");

        titreArron.addEventListener("click", function(){
            divArron.classList.toggle("cacher");
        })

        titreCat.addEventListener("click", function(){
            divCat.classList.toggle("cacher");
        })

        titreMat.addEventListener("click", function(){
            divMat.classList.toggle("cacher");
        })
    }
})