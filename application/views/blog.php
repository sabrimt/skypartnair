<?php 
// CONTENU GENERAL 

$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;
$description='description_' . $lng;
$content='content_' . $lng;?>

<?php
if (isset($artitre) && !empty($artitre)):
?>

	<h2 class="center-align red-text text-darken-5"><span style="border-bottom: 2px solid #9B3532; padding: 0 2rem 0.7rem 2rem;"><?= t('blog_lang_main_blog_title') ?></span></h2>
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
						<p class="animate-text">
							<small>
								<?= t('blog_lang_post_date_long', [
									date_cvt($artit->article_date, $lng),
									$artit->category->$category
								]) ?>
							</small>
						</p>				
						<a href="<?= base_url("blog/displayarticle/$artit->id") ?>" class="btn transparent waves-effect waves-light animate-text"><?= t('blog_lang_post_readmore') ?></a>
					</div>
				</div>

				<div class="card-stacked">
					<div class="card-content" style="max-height: 350px; max-width: 100%; overflow: hidden;">
						<h2><a href="<?= base_url("blog/displayarticle/$artit->id") ?>"><?= $artit->$title ?></a></h2>
						<p>
							<small>
								<?= t('blog_lang_post_date_long', [
									date_cvt($artit->article_date, $lng),
									'<a href="'.site_url('blog/listdisplay/'. $artit->article_category_id).'">'.$artit->category->$category.'</a>'
								]) ?>
							</small>
						</p>
						<div class="mce-grad" style="z-index: 3;"></div>
						<blockquote class="mcecontent"><?= $artit->$content ?></blockquote>
					</div>
					<div class="card-action hide-on-large-only">
						<a href="#" class="valign-wrapper  blue-text text-darken-5"><i class="material-icons blue-text text-darken-5">&#xE145;</i><?= t('blog_lang_post_learnmore') ?></a>
					</div>
				</div>
			</div>


			<div class="card hoverable article_title_item hide-on-med-and-up">
				<div class="card-image tile">
					<?= img($artit->picture_1, 'affretement jet privé', "photoblog" )?>
					<span class="card-title"><?= $artit->$title ?></span>
					<a href="<?= base_url("blog/displayarticle/$artit->id") ?>" class="btn transparent waves-effect waves-light animate-text"><?= t('blog_lang_post_readmore') ?></a>
				</div>
				<div class="card-content">
					<p class="text-transfert"><?= t('blog_lang_post_date', [date_cvt($artit->article_date, $lng), $artit->category->$category]) ?></small></p>
					<p><?= $artit->$description ?></p>
				</div>
			</div>

		</div>
		<?php endforeach; ?>
	</div>

<?php endif ?>


<div class="row last-atc-1" style="margin-bottom:0; position: relative;">
	<h3 class="red-text text-darken-5"><?= t('blog_lang_post_list_title') . (isset($artitre) ? '' : t('blog_lang_post_list_cat_title', strtoupper($articles[0]->category->$category))); ?></h3>
	
	<?php foreach ($articles as $article): ?>
	<div class="col s12 m6 l4 article_item">
			<div class="card hoverable">
				<div class="card-image tile">
					<?= img($article->picture_1, 'affretement jet privé', "photoblog" )?>
					<span class="card-title"><?= $article->$title ?></span>
					<a href="<?= base_url("blog/displayarticle/$article->id") ?>" class="btn transparent waves-effect waves-light animate-text"><?= t('blog_lang_post_readmore') ?></a>
				</div>
				<div class="card-content">
					<p class="text-transfert">
						<small>
							<?= t('blog_lang_post_date', [
								$article->article_date,
								$article->category->$category
							]) ?>
						</small>
					</p>
					<p><?= $article->$description ?></p>
				</div>
			</div>
		</div>		
	<?php endforeach; ?>
</div>


<div class="" style="margin-top:2rem;">
	<h3 class="col s12 red-text text-darken-5"><?= t('blog_lang_post_others_title'); ?></h3>
	
	<div class="row" id="ajaxdata">
	<?php
	if(is_array($results) && !empty($results)):
		foreach($results as $data):
		?>
		<div class="col m6 s12">
			<div class="article_voiraussi hoverable" onclick="document.location='<?= base_url('blog/displayarticle/'.$data->id) ?>'">
				<div class="image-container left">
					<?= img($data->picture_1, "Image principale", "") ?>
				</div>
				<div class="voiraussi-content left">
					<h4><?= $data->$title ?></h4>
					<p><small><?= t('blog_lang_post_date', [$data->article_date, $data->category->$category]) ?></small></p>
				</div>

			</div>
		</div>
		<?php endforeach; ?>
		<ul class="pagination col s12 center" id="ajax_pagingsearc">
			<p><?php echo $links; ?></p>
		</ul>
	<?php else: ?>
		<h3 class="col s12 center"><?= t('blog_lang_post_others_nocontent') ?></h3>
	<?php endif; ?>
	</div>
</div>
