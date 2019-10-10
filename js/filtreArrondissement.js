window.addEventListener("load", function(){
    let arrondissement = document.querySelectorAll(".arrondissement");
    let materiaux = document.querySelectorAll(".materiaux");
    let categories = document.querySelectorAll(".categorie");
    let barRecherche = document.querySelector(".recherche");
    let oeuvrePresent = 20;



    
    let recherche = "";
    barRecherche.addEventListener("keyup", function(){
        if(recherche == barRecherche.value){
            console.log("aucun changement");
        }
        else{
            
            recherche = barRecherche.value
            console.log(recherche);
            ajoutFiltreRecherche(recherche);
        }

    })
    /*
    *   EVENT POUR LES ARRONDISSEMENTS
    */
    let arr = [];
    for(let i=0; i<arrondissement.length;  i++){
        arrondissement[i].addEventListener("click", function(){
            let nArr = "";
            nArr = arrondissement[i].dataset.id
            ajoutFiltreArrondissement(nArr);
        });
    }


   /*
    *   EVENT POUR LES MATÉRIAUX
    */
    let mat = [];
    for(let i=0; i<materiaux.length;  i++){
        materiaux[i].addEventListener("click", function(){
            let nMat = "";
            nMat = materiaux[i].dataset.id
            ajoutFiltreMateriaux(nMat);
        });
    }


   /*
    *   EVENT POUR LES CATÉGORIES
    */
    let cat = [];
    for(let i=0; i<categories.length;  i++){
        categories[i].addEventListener("click", function(){
            let nCat = "";
            nCat = categories[i].dataset.id
            ajoutFiltreCategorie(nCat);
        });
    }


    function ajoutFiltreRecherche(recherche){
        GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);
    }

    /*
    * AJOUT FILTRES ARRONDISSEMENTS
    */
    function ajoutFiltreArrondissement(nArr){       
       if(arr.includes(nArr) == false){
           arr.push(nArr);
       }
       else{
           arr.splice(arr.indexOf(nArr), 1);
       }
       GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);
    }

    /*
    * AJOUT FILTRES MATERIAUX
    */
    function ajoutFiltreMateriaux(nMat){

    if(mat.includes(nMat) == false){
        mat.push(nMat);
    }
    else{
        mat.splice(mat.indexOf(nMat), 1);
    }
    GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);

    }

    /*
    * AJOUT FILTRES CATÉGORIES
    */
    function ajoutFiltreCategorie(nCat){

    if(cat.includes(nCat) == false){
        cat.push(nCat);
    }
    else{
        cat.splice(cat.indexOf(nCat), 1);
    }
    GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);

    }


    function GestionFiltre(arr = [], mat = [], cat = [], recherche = "", oeuvrePresent = 20){


        let arrondissementb = {};
        for(let y = 0; y<arr.length; y++){
            arrondissementb[y]= {
                id: arr[y]
            };
        }

        let materiaux = {};
        for(let z = 0; z<mat.length; z++){
            materiaux[z]= {
                id_mat: mat[z]
            };
        }

        let categories = {};
        for(let h = 0; h < cat.length; h++){
            categories[h]= {
                id_cat: cat[h]
            };
        }
        
        let aData={};
        aData.arrondissements = arrondissementb;
        aData.materiaux = materiaux;
        aData.categorie = categories;
        aData.recherche = recherche;
        aData.oeuvrePresent = oeuvrePresent;
 
        // console.log(aData);
        let jsonData = JSON.stringify(aData);
        filtrer(jsonData);
    }





        // ajax ici
    function filtrer(data){
        xhr = new XMLHttpRequest();
        xhr.open("POST", "/art-pub-mtl/api/filtre");
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                let oeuvres  = JSON.parse(xhr.responseText);
                console.log(oeuvres);
                bool = false;
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }






    // test ici
    let navHeight = window.screen.height;
    let footer = document.querySelector("footer");
    let scrollPos;
    let bool = false;
    window.addEventListener("scroll", function(){
        scrollPos = window.scrollY + navHeight;
        if(scrollPos >= footer.offsetTop){
            if(bool == false){
                console.log("bas");
                bool = true;
                oeuvrePresent = oeuvrePresent + 20;
                GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);
            }
        }
    })


});