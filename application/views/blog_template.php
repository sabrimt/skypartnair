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
					<a href="#!" class="dropdown-button" data-activates="dropdown-cat" data-hover="false"># <?= t('blog_lang_side_category_title'); ?><i class="material-icons">&#xE5C5;</i></a>
					<ul id="dropdown-cat" class="dropdown-content">
						<li><a href="<?=site_url('blog')?> "><?= t('blog_lang_side_category_all'); ?></a></li>
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
					<p><?= t('blog_lang_side_followus') ?></p>
					<?= img('icons/round-facebook.svg', 'suivez nous facebook', "" )?> 
					<?= img('icons/round-instagram.svg', 'suivez nous instagram', "" )?>
					<?= img('icons/round-linkedin.svg', 'suivez nous likedin', "" )?>
					<?= img('icons/round-twitter.svg', 'suivez nous twitter', "" )?> 
					<?= img('icons/round-google-plus.svg', 'suivez nous google plus', "" )?> 
				</div>
			</div>
			<section id="focus-content">
			

      			<?= $view ?>

		
			</section>
		</div>
      <!-- *************** BLOC DE DROITE ********************* -->
		<div class="col s12 l3 center-align">
			<div class="row" style="margin-top:2rem;">
				<div class="col s10 offset-s1 hide-on-med-and-down">
					<div class="card onready-anim right-slide-anim" style="margin-top:-150px;transition-delay: .5s;">
						<div class="card-image">
							<?= img('fond_blog.jpg', 'affretement jet privé', "photo-petite responsive-img" )?> 
							<span class="card-title"><?= t('blog_lang_side_intro_title') ?></span>
						</div>
						<div class="card-content grey darken-3 grey-text text-lighten-3">
							<p><?= t('blog_lang_side_intro_content') ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="categories-list row hide-on-med-and-down" style="margin-top:2rem;">
				<div class="col s10 offset-s1">
					<strong><?= t('blog_lang_side_category_title') ?></strong>
				</div>
				<div class="side-categories col s10 offset-s1">
					<?php
						$i=1;
						foreach ($categos as $catego):
					?>
					<p style="padding:0; margin:0;"><a href="<?= site_url('blog/listdisplay/'. $catego->id) ?>"># <?= $catego->$category ?></a></p>
						<?php
						if(++ $i >6 )
						break;
						endforeach; ?>
					<p style="padding:0; margin:0;"><a href="<?=site_url('blog')?> "><?= t('blog_lang_side_category_all'); ?></a></p>
				</div>
			</div>
			<div class="row hide-on-med-and-down" style="margin-top:2rem;">
				<div class="col s12">
					<p><strong><?= t('blog_lang_side_followus') ?></strong></p>
					<?= img('icons/round-facebook.svg', 'suivez nous facebook', "" )?> 
					<?= img('icons/round-instagram.svg', 'suivez nous instagram', "" )?>
					<?= img('icons/round-linkedin.svg', 'suivez nous likedin', "" )?>
					<?= img('icons/round-twitter.svg', 'suivez nous twitter', "" )?> 
					<?= img('icons/round-google-plus.svg', 'suivez nous google plus', "" )?> 
				</div>
			</div>
			<div id="social-block" class="row" style="margin-top:2rem;">
				<div class="col s8 offset-s2">
					<p><strong><?= t('blog_lang_side_instagram'); ?></strong></p>
					<!-- LightWidget WIDGET -->
					<iframe src="//lightwidget.com/widgets/e8fa16644d5659a388cf912785f4cc90.html" scrolling="no" allowtransparency="true" padding="5" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
				</div>
			</div>
			<div class="row" style="margin-top:2rem;">
				<div class="fb-page" 
					 data-href="https://www.facebook.com/SKYPartnair/" 
					 data-tabs="timeline" 
					 data-width="240" 
					 data-small-header="false" 
					 data-adapt-container-width="true" 
					 data-hide-cover="false" 
					 data-show-facepile="true">
					<blockquote cite="https://www.facebook.com/SKYPartnair/" class="fb-xfbml-parse-ignore">
						<a href="https://www.facebook.com/SKYPartnair/">SKY Partnair</a>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>