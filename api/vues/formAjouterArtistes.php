    <!-- il est temporaire-->
    <head>
        <meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="../../css/main.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../../css/formulaires.css" type="text/css" media="screen">
	</head>
	<!-- il est temporaire-->

<div class="container">
    <div class="contenu-form">
        <h1>Formulaire ajouter un artiste</h1>
        <form action="" method="POST">
            Nom : <input type="text" name="nom" /><br>
            Prenom : <input type="text" name="prenom" /><br>
            Nom Collectif : <input type="text" name="nomCollectif" /><br>
            Biographie : <input type="text" name="biographie" /><br>
            <input type="hidden" name="action" value=''/>
            <input type="submit" value="Ajouter"/>
        </form>
    </div>
</div>