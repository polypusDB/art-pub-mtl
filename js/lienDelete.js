window.addEventListener("load", function(){

    let btnLienSup = document.querySelectorAll(".btnSup");
    for(let i = 0; i< btnLienSup.length; i++){
        btnLienSup[i].addEventListener("click", function(evt){
            let rep = confirm("Êtes vous certain de voulloir supprimer cet élément?");
            if(rep == false){
                evt.preventDefault();
            }
        })
    }
})