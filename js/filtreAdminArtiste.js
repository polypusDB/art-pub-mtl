window.addEventListener("load", function(){


    if(document.querySelector(".adminSearchArtiste") != null){
        let btnRecherche = document.querySelector(".btnRecherche");
        let barreRecherche = document.querySelector(".adminSearchArtiste");


        btnRecherche.addEventListener("click", function(){
            let recherche = barreRecherche.value;
            if(recherche != ""){
                let aData={};
                aData.filtre = "adminArtiste";
                aData.recherche = recherche;
                aData.limit = 500;
                let jsonData = JSON.stringify(aData);
                filtrer(jsonData);
            }
        })
        
    }


    function filtrer(data){
        xhr = new XMLHttpRequest();
        xhr.open("POST", "/art-pub-mtl/api/filtre");
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                var artistes  = JSON.parse(xhr.responseText);
                afficherListe(artistes);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }


    function afficherListe(artistes){
        let template = document.querySelector(".listeArtiste");
        let parent = this.document.querySelector(".parent");
        topTableau(parent);
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


    function topTableau(parent){
        parent.innerHTML = "";
        let thead =document.createElement("THEAD");
        let tr = document.createElement("TR");
        let thVide = document.createElement("TH");
        let thNom = document.createElement("TH");
        let thMod = document.createElement("TH");
        let thSup = document.createElement("TH");


        thNom.textContent = "Nom";
        thMod.textContent = "Modifier";
        thSup.textContent = "Supprimer";

        parent.append(thead);
        thead.append(tr);
        tr.append(thVide);
        tr.append(thNom);
        tr.append(thMod);
        tr.append(thSup);
    }

    
})