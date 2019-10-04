window.addEventListener("load", function(){


    let btnCom = document.querySelector(".btnCom");

    btnCom.addEventListener("click", function(){
        let text = document.querySelector(".commentaire").value;
        let idUser = document.querySelector(".idUser").value;
        let idOeuvre = document.querySelector(".idOeuvre").value;
        let aData = []
        aData.push(text);
        aData.push(idUser);
        aData.push(idOeuvre);

        let newDATA = JSON.stringify({"text" : text, "idUser" : idUser, "idOeuvre": idOeuvre});
        console.log(newDATA);
        let success = document.querySelector(".test");


        if(text.value != ""){
            if(window.XMLHttpRequest){
                xhr = new XMLHttpRequest();
            } else {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhr.open("POST", "OeuvreControlleur.class.php");
            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    console.log(xhr.responseText);
                    success.innerHTML = xhr.responseText;
                }
            }
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            console.log(aData);
            xhr.send(newDATA);
            return xhr;
        }
        else{
            console.log("vide");
        }
    })
})