<section class="contenu uneOeuvre flex flex-col">
    <div class="retour">
		<i class="fas fa-arrow-circle-left"></i>
		<a href="/art-pub-mtl/api/admin/artistes">Retour à la liste</a>
	</div>
<?php
    extract($aData);
    ?>
		 <section>
            <section class="oeuvre artiste-detail">
                <header class="nom-artiste">
                    <h2><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; }?></h2>
                </header>
				<h2>Oeuvres produites par cet artiste :</h2>
				<?php
					foreach($oeuvres as $oeuvre){
						extract($oeuvre)
						?>
						<a class="artiste_detail" href = "/art-pub-mtl/api/oeuvre/<?= $id_oeuvre?>"><?=$titre ?></a><br>
					<?php
					}
				?>
				<a class="btnSup" href="/art-pub-mtl/api/artistes/sup/<?=$id_artiste ?>">Supprimer</a>
                <a class="btnMod" href="artistes/mod/<?=$id_artiste ?>">Modifier</a>
            </section>

        </section>
</section>
			