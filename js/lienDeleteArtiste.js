window.addEventListener("load", function(){
    if(document.querySelector(".adminSearchArtiste") != undefined){
        let btnOui = document.querySelector(".oui");
        let btnNon = document.querySelector(".non");
        let btnLienSup = document.querySelectorAll(".btnSup");
        let message = document.querySelector(".fond");
        
        for(let i = 0; i< btnLienSup.length; i++){
            
            btnLienSup[i].addEventListener("click", function(evt){
                message.classList.add("ouvert");
                var id = evt.target.dataset.id
                btnOui.dataset.id = id
            })
        }
    
    btnSup = document.querySelectorAll(".suppArt");
    
    
        btnOui.addEventListener("click", function(){
            let idOui = btnOui.dataset.id;
            location.replace("/art-pub-mtl/api/artisteAdmin/sup/"+idOui)
        })
    
        btnNon.addEventListener("click", function(){
            message.classList.remove("ouvert");
        })
    }



})