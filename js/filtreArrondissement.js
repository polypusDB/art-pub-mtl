window.addEventListener("load", function(){
    let arrondissement = document.querySelectorAll(".arrondissement");
    let materiaux = document.querySelectorAll(".materiaux");
    


    /*
    *   EVENT POUR LES ARRONDISSEMENTS
    */
    let arr = [];
    for(let i=0; i<arrondissement.length;  i++){
        arrondissement[i].addEventListener("click", function(){
            let nArr = "";
            nArr = arrondissement[i].dataset.id
            // GestionFiltre(nArr);
            ajoutFiltreArrondissement(nArr);
        });
    }


   /*
    *   EVENT POUR LES MATÉRIAUX
    */
    let mat = [];
    for(let i=0; i<materiaux.length;  i++){
        materiaux[i].addEventListener("click", function(){
            let nMat = "";
            nMat = materiaux[i].dataset.id
            ajoutFiltreMateriaux(nMat);
        });
    }


    function ajoutFiltreArrondissement(nArr){
        /*
        * Arrondissement
        */
       
       if(arr.includes(nArr) == false){
           arr.push(nArr);
       }
       else{
           arr.splice(arr.indexOf(nArr), 1);
       }
    //    console.log("arrondissement : "+arr);
       GestionFiltre(arr, mat);
    }


    function ajoutFiltreMateriaux(nMat){

    if(mat.includes(nMat) == false){
        mat.push(nMat);
    }
    else{
        mat.splice(mat.indexOf(nMat), 1);
    }
    // console.log("materiaux : " + mat);
    GestionFiltre( arr, mat);

    }


    function GestionFiltre(arr = [], mat = []){


        let arrondissementb = {};
        for(let y = 0; y<arr.length; y++){
            arrondissementb[y]= {
                id: arr[y]
            };
        }

        let materiaux = {};
        for(let z = 0; z<mat.length; z++){
            materiaux[z]= {
                id_mat: mat[z]
            };
        }
        
        let aData={};
        aData.arrondissements = arrondissementb;
        aData.categorie = "";
        aData.materiaux = materiaux;
 
        let jsonData = JSON.stringify(aData);
        filtrer(jsonData);
    }





        // ajax ici
    function filtrer(data){
        xhr = new XMLHttpRequest();
        xhr.open("POST", "/art-pub-mtl/api/filtre");
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                let oeuvres  = JSON.parse(xhr.responseText);
                console.log(oeuvres);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(data);
    }
});