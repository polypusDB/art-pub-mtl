window.addEventListener("load", function(){
    let btnCom = document.querySelector(".btnCom");
    if(btnCom != null){
        var sectionCom = document.querySelector(".list-comment");


        btnCom.addEventListener("click", function(){

            commenter();
        })

        window.addEventListener("keydown", function(evt){
            if(evt.key == "Enter"){
                commenter();
            }
        })


        function commenter(){
            let text = document.querySelector(".commentaire").value;
            let idUser = document.querySelector(".idUser").value;
            let idOeuvre = document.querySelector(".idOeuvre").value;
            let user = document.querySelector(".user").value;
            let aData = { "text" : text, "id_user" : idUser, "id_oeuvre" : idOeuvre, "nom_connexion" : user};
            let newDATA = JSON.stringify(aData);
    
            if(aData.text != ""){
                    
                xhr = new XMLHttpRequest();
                   
        
                xhr.open("POST", "/art-pub-mtl/api/commentaire");
                xhr.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        let com =JSON.parse(xhr.responseText);
                        let p1 = document.createElement("P");
                        let p2 = document.createElement("P");
                        let p3 = document.createElement("P");
                        let p4 = document.createElement("P");
                        let div = document.createElement("DIV");
                        div.dataset.idCommentaire = com["id_commentaire"];
                        p3.dataset.idcommentairesig = com["id_commentaire"];
                        p4.dataset.idcommentairesup = com["id_commentaire"];
                        p3.classList.add("signaler");
                        p4.classList.add("suprimer");
                        p1.textContent = com["nom_connexion"];
                        p2.textContent = com["texte"];
                        p3.textContent = "Signaler";
                        p4.textContent = "Suprimer";
                        sectionCom.appendChild(div);
                        div.appendChild(p1);
                        div.appendChild(p2);
                        div.appendChild(p3);
                        div.appendChild(p4);
                    }
                }
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(newDATA);
        
            }
            else{
                /**
                 * si le commentaire est vide on ne fait rien
                 */
            }
        }



        sectionCom.addEventListener("click", function(evt){
            if(evt.target.classList.value == "signaler"){
                evt.target.classList.add("signalerON");
                signalerCommentaire(evt.target.dataset.idcommentairesig);
            }
            if(evt.target.classList.value == "suprimer"){
                suprimerCommentaire(evt.target.dataset.idcommentairesup);
                let divParent = evt.target.parentElement;
                divParent.remove();
            }
        })


        
    }


    function signalerCommentaire(id){
        xhr = new XMLHttpRequest();
        xhr.open("GET", "/art-pub-mtl/api/commentaire/signaler/"+id);
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
            }
        }
        xhr.send(id);

    }


    function suprimerCommentaire(id){
        xhr = new XMLHttpRequest();
        xhr.open("GET", "/art-pub-mtl/api/commentaire/suprimer/"+id);
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
            }
        }
        xhr.send(id);

    }

})