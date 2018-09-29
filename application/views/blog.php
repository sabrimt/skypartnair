<?php 
// CONTENU GENERAL 

$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;
$description='description_' . $lng;
$content='content_' . $lng;?>

<div id="fb-root"></div>
<div class="parallax-container" style="min-height:370px !important;">
    <div class="parallax"><?= img("voyage-colibri.jpg", 'blog', "" )?></div>
</div>
<div class="container" >
	<div class="row">
		<div class="col s12 l9">
			<div class="col s12 hide-on-large-only">
				<div class="categories-drop-list col s6">
					<a href="#!" class="dropdown-button" data-activates="dropdown-cat" data-hover="false"># Catégories<i class="material-icons">&#xE5C5;</i></a>
					<ul id="dropdown-cat" class="dropdown-content">
						<li><a href="<?=site_url('blog')?> "> # Toutes les catégories</a></li>
						<?php
							$i=1;
							foreach ($categos as $catego):
						?>
						<li><a href="<?= site_url('blog/listdisplay/'. $catego->id) ?>"># <?= $catego->$category ?></a></li>
							<?php
							if(++ $i >6 )
							break;
						endforeach; ?>
					</ul>
				</div>
				<div class="social-scroll col s6 center-align js-scrollTo" href="#social-block">
					<p>Suivez nous</p>
					<?= img('icons/round-facebook.svg', 'suivez nous facebook', "" )?> 
					<?= img('icons/round-instagram.svg', 'suivez nous instagram', "" )?>
					<?= img('icons/round-linkedin.svg', 'suivez nous likedin', "" )?>
					<?= img('icons/round-twitter.svg', 'suivez nous twitter', "" )?> 
					<?= img('icons/round-google-plus.svg', 'suivez nous google plus', "" )?> 
				</div>
			</div>
			<h2 class="center-align red-text text-darken-5"><span style="border-bottom: 2px solid #9B3532; padding: 0 2rem 0.7rem 2rem;">A LA UNE</span></h2>
			<div class="row">
				<?php
				foreach ($artitre as $artit):
				?>

				<div class="col s12 l12">
					<div class="card horizontal hoverable hide-on-small-only">
						<div class="card-image tile">
							<?= img($artit->picture_1, 'affretement jet privé', "principal-art-img photouneblog" )?>
							<div class="text">
								<h1 class="animate-text"><?= $artit->$title ?></h1>
								<h2 class="animate-text"><?= $artit->$description ?> </h2>
								<p class="animate-text"><small>Publié le <?= date_cvt($artit->article_date, $lng) ?> dans <?= $artit->category->$category ?></small></p>
								
								<a href="<?= base_url("blog/displayarticle/$artit->id") ?>" class="btn transparent waves-effect waves-light animate-text">LIRE LA SUITE</a>
							</div>
						</div>
						<div class="card-stacked">
							<div class="card-content" style="max-height: 350px; max-width: 100%; overflow: hidden;">
								<h2><a href="<?= base_url("blog/displayarticle/$artit->id") ?>"><?= $artit->$title ?></a></h2>
								<p><small>Publié le <?= date_cvt($artit->article_date, $lng) ?> dans <strong><?= $artit->category->$category ?></strong></small></p>
<!--								<div  class="principal-art-description">
									<p><?= $artit->$description ?></p>
								</div>-->
								<div class="mce-grad" style="z-index: 3;"></div>
								<blockquote class="mcecontent"><?= $artit->$content ?></blockquote>
							</div>
							<div class="card-action hide-on-large-only">
								<a href="#" class="valign-wrapper  blue-text text-darken-5"><i class="material-icons blue-text text-darken-5">&#xE145;</i>En savoir plus</a>
							</div>
						</div>
					</div>
					<div class="card hoverable article_title_item hide-on-med-and-up">
						<div class="card-image tile">
							<?= img($artit->picture_1, 'affretement jet privé', "photoblog" )?>
							<span class="card-title"><?= $artit->$title ?></span>
							<a href="<?= base_url("blog/displayarticle/$artit->id") ?>" class="btn transparent waves-effect waves-light animate-text">LIRE LA SUITE</a>
<!--								<h2 class="animate-text"><small>Publié le <? $article->article_date ?> dans <? $article->category->$category ?></small></h2>-->
<!--										<a class="btn-floating halfway-fab waves-effect waves-light red darken-4"><i class="material-icons">add</i></a>-->
						</div>
						<div class="card-content">
							<p class="text-transfert"><small>Publié le <?= $artit->article_date ?> dans <strong><?= $artit->category->$category ?></strong></small></p>
							<p><?= $artit->$description ?></p>
						</div>
					</div>
				</div>
				<?php
				endforeach; ?>
			</div>

			<div class="row last-atc-1 animated-title" style="margin-bottom:0; position: relative;">
				<h3 class="red-text text-darken-5 left-slide-anim show-slide-anim">DERNIERS ARTICLES </h3>
				<?php
				foreach ($articles as $article):
				?>
				<div class="col s12 m6 l4 article_item">
						<div class="card hoverable">
							<div class="card-image tile">
								<?= img($article->picture_1, 'affretement jet privé', "photoblog" )?>
								<span class="card-title"><?= $article->$title ?></span>
								<a href="<?= base_url("blog/displayarticle/$article->id") ?>" class="btn transparent waves-effect waves-light animate-text">LIRE LA SUITE</a>
							</div>
							<div class="card-content">
								<p class="text-transfert"><small>Publié le <?= $article->article_date ?> dans <strong><?= $article->category->$category ?></strong></small></p>
								<p><?= $article->$description ?></p>
							</div>
						</div>
					</div>		
				<?php
				endforeach; ?>
			</div>

			<div class="animated-title animated-blocks" style="margin-top:2rem;">
				<h3 class="col s12 red-text text-darken-5 left-slide-anim show-slide-anim">LIRE AUSSI, TOUS LES ARTICLES </h3>
				
				<div class="row" id="ajaxdata">
				<?php
				if(is_array($results) && !empty($results)):
					foreach($results as $data):
					?>
					<div class="col m6 s12">
						<div class="article_voiraussi hoverable" onclick="document.location='<?= base_url('blog/displayarticle/$data->id') ?>'">
							<div class="image-container left">
								<?= img($data->picture_1, "Image principale", "") ?>
							</div>
							<div class="voiraussi-content left">
								<h4><?= $data->$title ?></h4>
								<p><small>Publié le <?= $data->article_date ?> dans <strong><?= $data->category->$category ?></strong></small></p>
							</div>

						</div>
					</div>
					<?php endforeach; ?>
				<ul class="pagination col s12 center" id="ajax_pagingsearc">
					<p><?php echo $links; ?></p>
				</ul>
					<?php else: ?>
					<h3 class="col s12 center">Aucun article supplémentaire</h3>
					<?php endif; ?>
				</div>
			</div>
		</div>
<!-- *************** BLOC DE DROITE ********************* -->
		<div class="col s12 l3 center-align">
			<div class="row" style="margin-top:2rem;">
				<div class="col s10 offset-s1 hide-on-med-and-down">
					<div class="card onready-anim right-slide-anim" style="margin-top:-150px;transition-delay: .5s;">
						<div class="card-image">
							<?= img('fond_blog.jpg', 'affretement jet privé', "photo-petite responsive-img" )?> 
							<span class="card-title">Le Blog MK Partnair</span>
<!--										<a class="btn-floating halfway-fab waves-effect waves-light red darken-4"><i class="material-icons">add</i></a>-->
						</div>
						<div class="card-content grey darken-3 grey-text text-lighten-3">
							<p>Retrouvez ici tous nos articles concernant l'aviation privée, regroupés en 6 rubriques bien guibolées, des conseils, des idées, des astuces... Suivez tous nos conseils !</p>
						</div>
					</div>
				</div>		
<!--							<?= img('petite1.jpg', 'affretement jet privé', "photo-petite responsive-img" )?> 
					<strong>Le Blog MK Partnair</strong>
				</div>		
				<div class="col s12 center-align" style="margin-top:1rem;">
					Retrouvez ici tous nos articles concernant l'aviation privée, regroupés en 6 rubriques bien guibolées, des conseils, des idées, des astuces... Suivez tous nos conseils !
				</div>-->
			</div>
			<div class="categories-list row hide-on-med-and-down" style="margin-top:2rem;">
				<div class="col s10 offset-s1">
					<strong>Catégories</strong>
				</div>
				<div class="col s10 offset-s1">
					<?php
						$i=1;
						foreach ($categos as $catego):
					?>
					<p style="padding:0; margin:0;"><a href="<?= site_url('blog/listdisplay/'. $catego->id) ?>"># <?= $catego->$category ?></a></p>
						<?php
						if(++ $i >6 )
						break;
						endforeach; ?>
					<p style="padding:0; margin:0;"><a href="<?=site_url('blog')?> "> # Toutes les catégories</a></p>
				</div>
			</div>
			<div class="row hide-on-med-and-down" style="margin-top:2rem;">
				<div class="col s12">
					<p><strong>Suivez nous</strong></p>
					<?= img('icons/round-facebook.svg', 'suivez nous facebook', "" )?> 
					<?= img('icons/round-instagram.svg', 'suivez nous instagram', "" )?>
					<?= img('icons/round-linkedin.svg', 'suivez nous likedin', "" )?>
					<?= img('icons/round-twitter.svg', 'suivez nous twitter', "" )?> 
					<?= img('icons/round-google-plus.svg', 'suivez nous google plus', "" )?> 
				</div>
			</div>
			<div id="social-block" class="row" style="margin-top:2rem;">
				<div class="col s8 offset-s2">
					<p><strong>Nos derniers Instagram</strong></p>
					<!-- LightWidget WIDGET -->
					<iframe src="//lightwidget.com/widgets/e8fa16644d5659a388cf912785f4cc90.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
				</div>
			</div>
			<div class="row" style="margin-top:2rem;">
				<div class="fb-page" 
					 data-href="https://www.facebook.com/MKPartnair/" 
					 data-tabs="timeline" 
					 data-width="240" 
					 data-small-header="false" 
					 data-adapt-container-width="true" 
					 data-hide-cover="false" 
					 data-show-facepile="true">
					<blockquote cite="https://www.facebook.com/MKPartnair/" class="fb-xfbml-parse-ignore">
						<a href="https://www.facebook.com/MKPartnair/">MK Partnair</a>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>