
<!-- CONTENU GENERAL -->
<?php 
$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;
$description='description_' . $lng;
$content='content_' . $lng;?>

	
<div class="row">
	<div id="single-post" class="col l10 offset-l1 s12 white">
		<h1 class="single-post-title"><?= $article->$title ?></h1>
		<?= img($article->picture_1, $article->$title, "materialboxed single-post-image" )?> 
		<p style="margin-bottom:0">
			<small>
				<?= t('blog_lang_post_date_long', [
					'<strong>'.date_cvt($article->article_date, $lng).'</strong>',
					'<a href="'.site_url('blog/listdisplay/'. $article->article_category_id).'">'.$article->category->$category.'</a>'
				]); ?>
			</small>
		</p>
		<hr/>
		<p class="post-content">
			<?= $article->$content ?>
		</p>
	</div>
</div>

<div class="row  animated-title animated-blocks" style="position: relative;">
	<h3 class="red-text text-darken-5 top-slide-anim show-slide-anim"><?= t('blog_lang_single_same_category_title', strtoupper($article->category->$category)); ?></h3>
	<?php foreach ($voiraussi as $other): ?>
		<a href="<?= base_url("/blog/displayarticle/$other->id") ?>" class="left-slide-anim show-slide-anim" style="display: block;">
		<div class="col s12 l4 article_item">
				<div class="card hoverable">
					<div class="card-image">
						<?= img($other->picture_1, 'affretement jet privé', "photoblog" )?>
						<span class="card-title"><?= $other->$title ?></span>
					</div>
					<div class="card-content">
						<p><small><?= t('blog_lang_post_date', [$other->article_date, $other->category->$category]); ?></small></p>
						<p><?= $other->$description ?></p>
					</div>
				</div>
			</div>	
		</a>
	<?php	endforeach; ?>
</div>
