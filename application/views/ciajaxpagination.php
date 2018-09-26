<?php
$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;

if(is_array($results) && !empty($results)):
	foreach($results as $data) :?>

		<div class="col m6 s12">
			<div class="article_voiraussi hoverable" onclick="document.location='<?= base_url("blog/displayarticle/$data->id") ?>'">
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