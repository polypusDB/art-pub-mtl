	<!-- il est temporaire-->
	<head>
        <meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="../../css/main.css" type="text/css" media="screen">
	</head>
	<!-- il est temporaire-->

<section class="contenu listeOeuvres">
	<div class="titreListe">
		<h1>Oeuvres</h1>
	</div>
		<section class="oeuvres flex wrap">
			<?php
			//foreach ($aData as $cle => $oeuvre) {
			//extract($oeuvre);
			?>
				<div class="oeuvre carte">
					<div class="image dummy">
						<a href="oeuvre/<?=$id_oeuvre ?>"><img src="../../img/placeholder_640_480.jpg" alt="Art Public Montreal"></a>
					</div>
					<div class="texte">
						<h2 class="titre">titre</h2>
						<h4>Artiste</h4>
						<p>Lorem ipsum</p>
						<h4>Description</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in odio laoreet, bibendum neque at, pharetra quam. Nunc ac pulvinar dolor. Duis malesuada sapien et viverra fermentum. Duis interdum mi id tempus iaculis. Pellentesque at lectus mollis, accumsan sapien eu, malesuada tellus.</p>
						<h4>Dimension</h4>
						<p>100x100</p>
						<h4>Categorie</h4>
						<p>Consectetur adipiscing</p>
						<h4>Support</h4>
						<p>Proin in odio laoreet</p>
						<h4>Endroit</h4>
						<p>Bibendum neque</p>
			<?php
			//}
			?>
					</div>
				</div>
		</section>
		</section>