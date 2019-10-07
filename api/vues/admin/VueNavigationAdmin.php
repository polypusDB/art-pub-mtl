<ul>
    <li><a href="/art-pub-mtl/api/admin">Tableau de bord</a></li>
    <li>Profils</li>
    <li class="dropdown-btn">Oeuvres <i class="fas fa-sort-down"></i></li>
    <li class="dropdown-container">
        <a href="/art-pub-mtl/api/oeuvreAdmin">Liste des Oeuvres</a>
        <a href="/art-pub-mtl/api/oeuvreAdmin/ajouter">Ajouter des Oeuvres</a>
    </li>
    <li class="dropdown-btn">Artistes <i class="fas fa-sort-down"></i></li>
    <li class="dropdown-container">
        <a href="/art-pub-mtl/api/artisteAdmin">Liste des Artistes</a>
        <a href="/art-pub-mtl/api/artisteAdmin/ajouter">Ajouter des Artistes</a>
    </li>
    <li><a href="">Parcours</a></li>
</ul>

<!-- <script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        console.log(dropdownContent);
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    } 

        
</script> -->