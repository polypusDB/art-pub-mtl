window.addEventListener("load", function(){
      

    if(document.querySelector(".modArtiste") || document.querySelector(".ajoutArtiste")){
        let parent = document.querySelector(".message");
        let btn = document.querySelector(".btn");
        let messageErreur = document.createElement("P");


        btn.addEventListener("click", function(evt){

            parent.innerHTML = "";

            messageErreur.textContent = "";
            if(document.querySelector("[name='nom_collectif']").value == ""){
                // document.querySelector("[name='nom_collectif']").classList.add("vide");
                if(document.querySelector("[name='nom']").value == "" && document.querySelector("[name='prenom']").value == ""){
                    messageErreur.textContent = "Vous devez remplir le champ nom collectif ou nom et prenom.\n";
                    document.querySelector("[name='nom']").classList.add("vide");
                    document.querySelector("[name='prenom']").classList.add("vide");
                    document.querySelector("[name='nom_collectif']").classList.add("vide");
                }
                else if(document.querySelector("[name='nom']").value == "" || document.querySelector("[name='prenom']").value == ""){
                    if(document.querySelector("[name='nom']").value == ""){
                        messageErreur.textContent += "Vous devez remplir le champ nom \n";
                        document.querySelector("[name='nom']").classList.add("vide");
                    }
                    if(document.querySelector("[name='prenom']").value == ""){
                        messageErreur.textContent += "Vous devez remplir le champ prénom \n";
                        document.querySelector("[name='prenom']").classList.add("vide");
                    }
                }
            }
            if(document.querySelector("[name='biographie']").value == ""){
                document.querySelector("[name='biographie']").classList.add("vide");
                messageErreur.textContent += "Vous devez remplir le champ biographie.\n";
            }


            if(document.querySelector("[name='nom_collectif']").value != ""){
                document.querySelector("[name='nom_collectif']").classList.remove("vide");
            }
            if(document.querySelector("[name='nom']").value != ""){
                document.querySelector("[name='nom']").classList.remove("vide");
            }
            if(document.querySelector("[name='prenom']").value != ""){
                document.querySelector("[name='prenom']").classList.remove("vide");
            }
            if(document.querySelector("[name='biographie']").value != ""){
                document.querySelector("[name='biographie']").classList.remove("vide");
            }



            if(messageErreur.textContent != ""){
                parent.appendChild(messageErreur);
                evt.preventDefault();
            }

            
        })
    }
})