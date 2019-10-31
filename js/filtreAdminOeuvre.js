window.addEventListener("load", function(){
    if(document.querySelector(".adminSearchOeuvre") != null){
        let btnRecherche = document.querySelector(".btnRecherche");
        let barreRecherche = document.querySelector(".adminSearchOeuvre");

        btnRecherche.addEventListener("click", function(){
            let recherche = barreRecherche.value;
            if(recherche != ""){
                let aData={};
                aData.filtre = "adminOeuvre";
                aData.recherche = recherche;
                aData.limit = 500;
                let jsonData = JSON.stringify(aData);
                filtrer(jsonData);
            }
        })

        window.addEventListener("keydown", function(evt){
            if(evt.key == "Enter"){
                let recherche = barreRecherche.value;
                let aData={};
                aData.filtre = "adminOeuvre";
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
                let oeuvres  = JSON.parse(xhr.responseText);
                afficherListe(oeuvres);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }



    function afficherListe(oeuvres){
        let parent = this.document.querySelector(".parent");
        if(oeuvres.length > 0){
            let template = document.querySelector(".listeOeuvre");
            topTableau(parent);
            oeuvres.forEach(function(oeuvre){
                let uneOeuvre  = template.cloneNode(true);
                for(let prop in oeuvre){
                    let regExp = new RegExp("{{"+prop+"}}", "g");
                    uneOeuvre.innerHTML = uneOeuvre.innerHTML.replace(regExp, oeuvre[prop]);
                }
                let nouveauNoeud = document.importNode(uneOeuvre.content, true)
                parent.append(nouveauNoeud);
            })
        }
        else{
            parent.innerHTML = "";
            let message = document.createElement("tr");
            message.textContent = "Aucun oeuvre ne correspond à votre recherche";
            parent.appendChild(message);
        }

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