window.addEventListener("load", function(){
    /**
     * gestion des commentaires en ks
     */
    let btnCom = document.querySelector(".btnCom");
    if(btnCom != null){
        var sectionCom = document.querySelector(".list-comment");
        btnCom.addEventListener("click", function(){
            console.log("yo");
            let zoneTexte = document.querySelector(".commentaire");
            commenter();
            zoneTexte.value = "";
        })

        window.addEventListener("keydown", function(evt){
            if(evt.key == "Enter"){
                commenter();
            }
        })

        /**
         * function pour l'apparrition du commentaire et injection dans la bd
         */
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
                        let i = document.createElement("I");
                        let iDeux = document.createElement("I");
                        i.classList.add("fab");
                        i.classList.add("fa-font-awesome-flag");
                        i.dataset.signaler = "true";
                        iDeux.dataset.supprimer = "true";
                        iDeux.classList.add("fas");
                        iDeux.classList.add("fa-trash");
                        div.dataset.idCommentaire = com["id_commentaire"];
                        i.dataset.idcommentairesig = com["id_commentaire"];
                        p4.dataset.idcommentairesup = com["id_commentaire"];
                        p1.textContent = com["nom_connexion"];
                        p2.textContent = com["texte"];
                        sectionCom.appendChild(div);
                        p3.appendChild(i);
                        p4.appendChild(iDeux);
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


/**
 * add event listener pour suprimer et signaler les commentaires
 */
        sectionCom.addEventListener("click", function(evt){
            if(evt.target.dataset.signaler){
                evt.target.parentNode.classList.add("signalerON");
                console.log(evt.target.dataset.idcommentairesig);
                signalerCommentaire(evt.target.dataset.idcommentairesig);
            }
            if(evt.target.dataset.supprimer){
                suprimerCommentaire(evt.target.parentNode.dataset.idcommentairesup);
                let divParent = evt.target.parentElement.parentElement;
                divParent.remove();
            }
        })


        
    }

    /**
     * signale les commentaire
     * @param {string} id 
     */

    function signalerCommentaire(id){
        xhr = new XMLHttpRequest();
        xhr.open("GET", "/art-pub-mtl/api/commentaire/signaler/"+id);
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
            }
        }
        xhr.send(id);

    }

    /**
     * suprimer les commentaire
     * @param {string} id 
     */
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