window.addEventListener("load", function(){
    let selectArr = document.querySelector(".sArrondissement");
    console.log(selectArr.value);


    selectArr.addEventListener("change", function(){
        console.log(selectArr.value);
    })
})