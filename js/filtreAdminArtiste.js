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
                let artistes  = JSON.parse(xhr.responseText);
                console.log(artistes);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }

    
})