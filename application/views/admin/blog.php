<section class="row liste-articles">
	<div class="row">
		<div class="col s10 offset-s1">
			<h1>Gestion BLOG </h1>
			<p>Créer de nouveaux articles en les mettant en forme, modifier, supprimer les articles existants... </p>
		</div> 
	</div>
    <div class="col s10 offset-s1">
		<?php
		if(!(isset($action) && $action == 'Ajout')){
			echo $add_btn??'';
		}
		$s = "";
		if (empty($articles)) {
			?> 
		<h3><strong>Pas d'articles</strong></h3>
			<?php } else {
			if ($nb_article > 1) {
				 $s ="s";
			}
			?> 
		<h3><strong><?= $nb_article ?> article<?=$s?> en ligne</strong></h3>
		<table class="stripped highlight centered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Photo</th>
					<th>Titre</th>
					<th>Catégorie</th>
					<th>Dernière modif</th>
				</tr>
			</thead>
			<tbody>
            <?php
                foreach ($articles as $article):
			?>
				<tr class="list-elt">
					<td>#<?= $article->id ?></td>
					<td><a href="<?= base_url("mkadmin/blog/articlemanager/$article->id") ?>"><?= img($article->picture_1, "Image principale", "fleet-preview-img") ?></a></td>
					<td><a href="<?= base_url("mkadmin/blog/articlemanager/$article->id") ?>"><?= $article->title_fr ?></a></td>
					<td><?= $article->category->category_fr ?></td>
					<td><?= $article->article_date ?></td>
					<td class="action-btn btn-display">
						<a class="edit-btn material-icons blue-grey-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Modifier"
						   href="<?= base_url("mkadmin/blog/articlemanager/$article->id") ?>">&#xE3C9;</a>
						<a class="confirm-delete-btn material-icons deep-orange-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Supprimer"
						   href="" data-link="<?= base_url("mkadmin/blog/deletearticle/$article->id") ?>">&#xE872;</a>
					</td>
						
				</tr>
				
				<!--	MODAL   -->
				<div id="modal-details-<?= $article->id ?>" class="modal col s8  modal-fixed-footer">
					<div class="modal-content">
						<h2 class="h2_modal-details center-align blue-grey-text"><?= $article->title_fr ?></h2>
						<div class="row pictures_modal">
							<div class="col s5">
								<h4 class="center-align"><strong>Photo principale</strong></h4>
								<?= img($article->picture_1, "photo principale", "col s12") ?>
							</div>
							<div class="col s5 offset-s2">
								<h4 class="center-align"><strong>Photo Bonus</strong></h4>
								<?= !empty($article->picture_2) ? img($article->picture_2, "photo bonus", "col s12") : '<p class="center-align red-text">Pas de photo</p>' ?>
							</div>
						</div>
						<div class="row category-infos">
							<div class="col s5 right-align">
								<h4><strong>Catégorie Français</strong></h4>
								<p><?= $article->category->category_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Catégorie</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Catégorie Anglais</strong></h4>
								<p><?= $article->category->category_en ?></p>
							</div>
						</div>
						<div class="row title-infos">
							<div class="col s5 right-align">
								<h4><strong>Titre Français</strong></h4>
								<p><?= $article->title_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Titre</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Titre Anglais</strong></h4>
								<p><?= $article->title_en ?></p>
							</div>
						</div>
						<div class="row content-infos">
							<div class="col s5 right-align">
								<h4><strong>Contenu Français</strong></h4>
								<p><?= $article->content_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Contenu d'article</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Contenu Anglais</strong></h4>
								<p><?= $article->content_en ?></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					  <a href="#!" class="modal-action modal-close waves-effect waves-grey btn-flat">FERMER</a>
					</div>
				</div>
				<!--	END MODAL   -->
					
			<?php endforeach; }?>
			</tbody>
		</table>
		<div class="row">
			<div class="col s6 offset-s3 pagination center">
				<?= $pagination ?>
			</div>
		</div>
    </div>
</section>