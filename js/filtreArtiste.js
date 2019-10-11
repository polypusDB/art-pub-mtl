window.addEventListener("load", function(){
    if(document.querySelector(".searchArtiste") != null){
        let btnRecherche = document.querySelector(".btnRecherche");
        let barreRecherche = document.querySelector(".searchArtiste");
        let artistePresent = 20;

        btnRecherche.addEventListener("click", function(){
            let recherche = barreRecherche.value;
            if(recherche != ""){

                let aData={};
                aData.filtre = "userArtiste";
                aData.recherche = recherche;
                aData.limit = artistePresent;
                let jsonData = JSON.stringify(aData);
                filtrer(jsonData);
            }
        })




        // let navHeight = window.screen.height;
        // let footer = document.querySelector("footer");
        // let scrollPos;
        // let bool = false;
        // window.addEventListener("scroll", function(){
        //     scrollPos = window.scrollY + navHeight;
        //     if(scrollPos >= footer.offsetTop){
        //         if(bool == false){
        //             console.log("bas");
        //             bool = true;
        //             artistePresent = artistePresent + 20;
        //             GestionFiltre(artistePresent);
        //         }
        //     }
        // })
        
    }




    function filtrer(data){
        xhr = new XMLHttpRequest();
        xhr.open("POST", "/art-pub-mtl/api/filtre");
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                let artiste  = JSON.parse(xhr.responseText);
                console.log(artiste);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }

    
})