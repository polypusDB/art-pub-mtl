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
                console.log(oeuvres);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }

    
})