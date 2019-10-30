window.addEventListener("load", function(){
    if(document.querySelector(".recherche") != null){
        let arrondissement = document.querySelectorAll(".unArrondissement");
        let materiaux = document.querySelectorAll(".materiaux");
        let categories = document.querySelectorAll(".categorie");
        let barRecherche = document.querySelector(".recherche");
        let oeuvrePresent = 20;
    
    
        let btnFiltre = document.querySelector(".btnFiltre");
        
        let recherche = "";
        barRecherche.addEventListener("keyup", function(){
            if(recherche == barRecherche.value){
                console.log("aucun changement");
            }
            else{
                
                recherche = barRecherche.value
                ajoutFiltreRecherche(recherche);
            }
    
        })
        /*
        *   EVENT POUR LES ARRONDISSEMENTS
        */
        let arr = [];
        arrondissement.forEach(function(arrond){
            arrond.addEventListener("click", function(evt){
                if(evt.target.classList.value == "arrondissement" || evt.target.classList.value == "checkmark"){
                    let nArr = "";
                    nArr = arrond.dataset.id;
                    ajoutFiltreArrondissement(nArr);
                }

            });
        });
    
    
       /*
        *   EVENT POUR LES MATÉRIAUX
        */
        let mat = [];
        for(let i=0; i<materiaux.length;  i++){
            materiaux[i].addEventListener("click", function(evt){
                if(evt.target.classList.value == "materiaux" || evt.target.classList.value == "checkmark"){
                    let nMat = "";
                    nMat = materiaux[i].dataset.id
                    console.log(nMat)
                    ajoutFiltreMateriaux(nMat);
                }
            });
        }
    
    
       /*
        *   EVENT POUR LES CATÉGORIES
        */
        let cat = [];
        for(let i=0; i<categories.length;  i++){
            categories[i].addEventListener("click", function(evt){       
                if(evt.target.classList.value == "categorie" || evt.target.classList.value == "checkmark"){
                    console.log(categories[i]);
                    let nCat = "";
                    nCat = categories[i].dataset.id
                    ajoutFiltreCategorie(nCat);
                }
            });
        }
    
    
        function ajoutFiltreRecherche(recherche){
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
    
        }
    
    
        function GestionFiltre(arr = [], mat = [], cat = [], recherche = "", oeuvrePresent = 20){
            console.log(mat);
    
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
            aData.filtre = "userOeuvre";
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
                    // console.log(xhr.responseText)
                    let oeuvres  = JSON.parse(xhr.responseText);
                    
                    afficherListe(oeuvres);
                    bool = false;
                }
            }
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(data);
        }


        function afficherListe(oeuvres){
            
            let parent = this.document.querySelector(".parent");
            parent.innerHTML = ""
            if(oeuvres.length > 0){
                let template = document.querySelector(".templateOeuvre");
                oeuvres.forEach(function(oeuvre){
                    let uneOeuvre  = template.cloneNode(true);
                    for(let prop in oeuvre){
                        let regExp = new RegExp("{{"+prop+"}}", "g");
                        uneOeuvre.innerHTML = uneOeuvre.innerHTML.replace(regExp, oeuvre[prop]);
                    }
                    let nouveauNoeud = document.importNode(uneOeuvre.content, true)
                    parent.append(nouveauNoeud);
                    oeuvre["Artistes"].forEach(function(artiste){
                        let template2 = document.querySelector(".templateAuteur");
                        let unArtiste  = template2.cloneNode(true);
                        for(let prop in artiste){
                            let regExp = new RegExp("{{"+prop+"}}", "g");
                            unArtiste.innerHTML = unArtiste.innerHTML.replace(regExp, artiste[prop]);
                        }
                        let parent2 = document.querySelector(".Artiste"+oeuvre["id_oeuvre"]);
                        let noeudArtiste = document.importNode(unArtiste.content, true)
    
                        parent2.append(noeudArtiste);
                    })
                })
            }
            else{
                let message = document.createElement("P");
                message.textContent = "Aucun oeuvre ne correspond à votre recherche";
                parent.appendChild(message);
            }
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
                    bool = true;
                    oeuvrePresent = oeuvrePresent + 20;
                    GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);
                }
            }
        })

        btnFiltre.addEventListener("click", function(){
            GestionFiltre(arr, mat, cat, recherche, oeuvrePresent);
        })
    
    }


});