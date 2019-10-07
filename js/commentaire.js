window.addEventListener("load", function(){


    let btnCom = document.querySelector(".btnCom");

    btnCom.addEventListener("click", function(){
        let text = document.querySelector(".commentaire").value;
        let idUser = document.querySelector(".idUser").value;
        let idOeuvre = document.querySelector(".idOeuvre").value;
        let user = document.querySelector(".user").value;
        let aData = { "text" : text, "id_user" : idUser, "id_oeuvre" : idOeuvre, "nom_connexion" : user};
        let newDATA = JSON.stringify(aData);
        let sectionCom = document.querySelector(".test");


        if(text.value != ""){
            
            xhr = new XMLHttpRequest();
           

            xhr.open("POST", "/art-pub-mtl/api/commentaire");
            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    let com =JSON.parse(xhr.responseText);
                    console.log(com);
                    let p1 = document.createElement("P");
                    let p2 = document.createElement("P");
                    let div = document.createElement("DIV");
                    p1.textContent = com["nom_connexion"];
                    p2.textContent = com["texte"];
                    sectionCom.appendChild(div);
                    div.appendChild(p1);
                    div.appendChild(p2);
                    
                }
            }
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(newDATA);

        }
        else{
            console.log("vide");
        }
    })
})