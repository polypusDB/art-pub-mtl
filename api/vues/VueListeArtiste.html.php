<section class="contenu listeArtiste">
            <section class="oeuvres-flex-wrap">
						<?php
						foreach ($aData as $cle => $artiste) {
							extract($artiste);
							?>
							<section class="artiste-carte">
			                    <header class="">
			                        <a href="artiste/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $NomCollectif; } ?></h2></a> 
								</header>
								<div class="boutons">
									<a class="btnSup" href="oeuvre/sup/<?=$id_oeuvre ?>">Supprimer</a>
								</div>
			                </section>
							<?php
						}
						?>
					</section>
				
			</section>
			