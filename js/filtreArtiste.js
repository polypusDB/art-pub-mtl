window.addEventListener("load", function(){
    if(document.querySelector(".searchArtiste") != null){
        let btnRecherche = document.querySelector(".btnRecherche");
        let barreRecherche = document.querySelector(".searchArtiste");
        let artistePresent = 20;
        var bool = false;

        btnRecherche.addEventListener("click", function(){
            let recherche = barreRecherche.value;
            if(recherche != ""){
                gestionFiltre(artistePresent, recherche);
            }
            else{
                console.log("le champ recherche est vide");
            }
            
        })


        let navHeight = window.screen.height;
        let footer = document.querySelector("footer");
        let scrollPos;
        
        window.addEventListener("scroll", function(){
            scrollPos = window.scrollY + navHeight;
            if(scrollPos >= footer.offsetTop){
                if(bool == false){
                    bool = true;
                    artistePresent = artistePresent + 20;
                    let newRecherche = barreRecherche.value;
                    gestionFiltre(artistePresent, newRecherche);
                }
            }
        })
        
    }

    function gestionFiltre(artistePresent, recherche){
        
        let aData={};
        aData.filtre = "userArtiste";
        aData.recherche = recherche;
        aData.limit = artistePresent;
        let jsonData = JSON.stringify(aData);
        filtrer(jsonData);
    }


    function filtrer(data){
        xhr = new XMLHttpRequest();
        xhr.open("POST", "/art-pub-mtl/api/filtre");
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                bool = false;
                let artistes  = JSON.parse(xhr.responseText);
                afficherListe(artistes);
                
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }


    function afficherListe(artistes){
        let template = document.querySelector(".liste_Artiste");
        let parent = this.document.querySelector(".parent");
        parent.innerHTML = "";
        artistes.forEach(function(artiste){
            let unArtiste  = template.cloneNode(true);
            for(let prop in artiste){
                let regExp = new RegExp("{{"+prop+"}}", "g");
                unArtiste.innerHTML = unArtiste.innerHTML.replace(regExp, artiste[prop]);
            }
            let nouveauNoeud = document.importNode(unArtiste.content, true)
            parent.append(nouveauNoeud);
        })
    }


})