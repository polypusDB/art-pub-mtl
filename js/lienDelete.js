window.addEventListener("load", function(){
    /**
     * liens pour deleter les oeuvres
     */
    if(document.querySelector(".MessageOeuvre")){
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
    
    
    
    
        btnOui.addEventListener("click", function(){
            let idOui = btnOui.dataset.id;
            location.replace("/art-pub-mtl/api/oeuvreAdmin/sup/"+idOui)
        })
    
        btnNon.addEventListener("click", function(){
            message.classList.remove("ouvert");
        })
    }
})