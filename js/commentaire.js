window.addEventListener("load", function(){


    let btnCom = document.querySelector(".btnCom");

    btnCom.addEventListener("click", function(){
        let text = document.querySelector(".commentaire").value;
        let idUser = document.querySelector(".idUser").value;
        let idOeuvre = document.querySelector(".idOeuvre").value;
        let user = document.querySelector(".user").value;
        let aData = { "text" : text, "id_user" : idUser, "id_oeuvre" : idOeuvre, "nom_connexion" : user};
        console.log(aData);
        let newDATA = JSON.stringify(aData);
        console.log(newDATA);
        let success = document.querySelector(".test");


        if(text.value != ""){
            
            xhr = new XMLHttpRequest();
           

            xhr.open("POST", "/art-pub-mtl/api/commentaire");
            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    console.log(xhr.responseText);
                    success.innerHTML = xhr.responseText;
                }
            }
            xhr.setRequestHeader('Content-Type', 'application/json');
            console.log(aData);
            xhr.send(newDATA);
        }
        else{
            console.log("vide");
        }
    })
})