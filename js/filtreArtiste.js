window.addEventListener("load", function(){
    if(document.querySelector(".searchArtiste") != null){
        let btnRecherche = document.querySelector(".btnRecherche");
        let barreRecherche = document.querySelector(".searchArtiste");
        let artistePresent = 20;
        var bool = false;

        btnRecherche.addEventListener("click", function(){
            let recherche = barreRecherche.value;
                gestionFiltre(artistePresent, recherche);

        })

        window.addEventListener("keydown", function(evt){
            if(evt.key == "Enter"){
                let recherche = barreRecherche.value;
                gestionFiltre(artistePresent, recherche);
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
                console.log(xhr.responseText)
                let artistes  = JSON.parse(xhr.responseText);
                afficherListe(artistes);
                
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }


    function afficherListe(artistes){
        let parent = this.document.querySelector(".parent");
        parent.innerHTML = "";
        if(artistes.length>0){
            let template = document.querySelector(".liste_Artiste");
            
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
        else{
            
            let message = document.createElement("P");
            message.textContent = "Aucun artiste ne correspond à votre recherche";
            parent.appendChild(message);
        }
    }


})