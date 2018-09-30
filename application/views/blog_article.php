
<!-- CONTENU GENERAL -->
<?php 
$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;
$description='description_' . $lng;
$content='content_' . $lng;?>

<div id="fb-root"></div>
<div class="parallax-container" style="min-height:300px !important;">
    <div class="parallax"><?= img("voyage-colibri.jpg", 'blog', "" )?></div>
</div>
	<div class="container">
		<div class="row">
			<div class="col s12 l9">
				<div class="row">
					<div class="col l10 offset-l1 s12 white" style="margin-top:2rem;">
						<h1 class="margin-top:2rem;"><?= $article->$title ?></h1>
						<p style="margin-bottom:0"> <small> Publié le <strong> <?= date_cvt($article->article_date, $lng) ?> </strong> dans la catégorie <strong><?= $article->category->$category ?> </strong> </small></p>
						<hr/>
						<img class="materialboxed" width="100%" src="<?= base_url('assets/img/' . $article->picture_1)?>">
						<p class="article_content">
							<?= $article->$content ?>
						</p>
					</div>
				</div>

					<div class="row" style="margin-bottom:0; position: relative;">
						<h3 class="red-text text-darken-5">LIRE AUSSI DANS LA MÊME CATEGORIE </h3>
						<?php
						$i=0;
						foreach ($voiraussi as $other):
						//if($article->id != $other->id) {
							$i++;
							
						?>
						<a href="<?= base_url("/blog/displayarticle/$other->id") ?>">
						<div class="col s12 l4 article_item">
								<div class="card hoverable">
									<div class="card-image">
										<?= img($other->picture_1, 'affretement jet privé', "photoblog" )?>
										<span class="card-title"><?= $other->$title ?></span>
									</div>
									<div class="card-content">
										<p><small>Publié le <?= $other->article_date ?> dans <strong><?= $other->category->$category ?></strong></small></p>
										<p><?= $other->$description ?></p>
									</div>
								</div>
							</div>	
						</a>
						<?php
						//}
						if ($i==3)
						{break;}
						endforeach; ?>
					</div>
				</div>

<!-- *************** BLOC DE DROITE ********************* -->
				<div class="col s12 l3 center-align">
					<div class="row" style="margin-top:2rem;">
						<div class="col s12">
							<p><strong>Suivez nous</strong></p>
							<?= img('icons/round-facebook.svg', 'affretement jet privé', "logo-rs" )?> 
							<?= img('icons/round-instagram.svg', 'affretement jet privé', "logo-rs" )?>
							<?= img('icons/round-linkedin.svg', 'affretement jet privé', "logo-rs" )?>
							<?= img('icons/round-twitter.svg', 'affretement jet privé', "logo-rs" )?> 
							<?= img('icons/round-google-plus.svg', 'affretement jet privé', "logo-rs" )?> 
						</div>
					</div>
					<div class="row" style="margin-top:2rem;">
						<div class="col s10 offset-s1">
							<strong>Catégories</strong>
						</div>
						<div class="col s10 offset-s1">
							<?php
								$i=1;
								foreach ($categos as $catego):
								?>

							<a href="<?= site_url('blog/listdisplay/'. $catego->id) ?>"> <p style="padding:0; margin:0;"> # <?= $catego->$category ?> </p> </a>
								<?php
								if(++ $i >6 )
								break;
								endforeach; ?>
							<a href="<?=site_url('blog')?> "> <p style="padding:0; margin:0;"> # Toutes les catégories </p> </a>
						</div>
					</div>
					

					<div class="row" style="margin-top:2rem;">
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
