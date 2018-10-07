<?php 
$lng = $this->lang->lang();
$description='description_' . $lng;
$crew_lg = 'crew_'.$lng;
$type_lg = 'type_'.$lng;
?>

<div class="row">
	<div class="col l8 offset-l2 s12">
		<div class="col s10 offset-s1 titre_plane ">
			<h1 class="center aircraft_h1 red-text text-darken-5"><?= $single_aircraft->manufacturer->name . ' ' . $single_aircraft->model ?></h1>
			<hr/>
			<h2 class="left aircraft_h2"><?= $single_aircraft->category->category ?></h2>
			<h2 class="right aircraft_h2 valign-wrapper">
				<?= $single_aircraft->manufacturer->name ?>
				<?= img('flag/'.$single_aircraft->manufacturer->flag, $single_aircraft->manufacturer->flag . ' flag', "right flagpro min-fleet-flag") ?>
			</h2>
		</div>
	</div>
</div>

<div class="parallax-container" style="min-height:500px !important;">
    <div class="parallax"><?= img($single_aircraft->photo_exter, 'blog', "" )?></div>
</div>

<div id="focus-content" class="container" style="padding-top: 2rem; padding-bottom: 4rem;">
	<div class="row">
		<div class="col s12">
			<h2><?= t('fleet_lang_single_title') . mb_strtoupper($single_aircraft->manufacturer->name . ' ' . $single_aircraft->model); ?></h2>
			<h3><p><?= $single_aircraft->$description ?></p></h3>
			<div class="card" style="margin-top: 3rem;">		
				<div class="card-tabs">
					<ul class="tabs">
						<li class="tab"><a href="#description-tab" class="active"><?= t('fleet_lang_single_tab_features'); ?></a></li>
						<li class="tab"><a href="#photos-tab"><?= t('fleet_lang_single_tab_photos'); ?></a></li>
					</ul>
				</div>
				
				<div class="card-content grey lighten-4 col s12">					
					<div id="description-tab">
						<div class="card-content">
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_manufacturer'); ?></strong> : </div><div class="col s6 left-align"><span><?= mb_strtoupper($single_aircraft->manufacturer->name); ?></span></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_model'); ?></strong> : </div><div class="col s6 left-align"><span><?= mb_strtoupper($single_aircraft->model); ?></span></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_origin'); ?></strong> : </div><div class="col s6 left-align"><span><?= img('flag/'.$single_aircraft->manufacturer->flag, $single_aircraft->manufacturer->flag . ' flag', "flagpro min-fleet-flag") ?></span></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_type'); ?></strong> : </div><div class="col s6 left-align"><span><?= $single_aircraft->type->$type_lg; ?></span></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_category'); ?></strong> : </div><div class="col s6 left-align"><span><?= $single_aircraft->category->category; ?></span></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_speed'); ?></strong> : </div><div class="col s6 left-align"><?= speed_cvt($single_aircraft->cruise_speed, $lng); ?></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_range'); ?></strong> : </div><div class="col s6 left-align"><?= range_cvt($single_aircraft->aircraft_range, $lng); ?></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_capacity'); ?></strong> : </div><div class="col s6 left-align"><?= t('fleet_lang_single_feat_capacity', $single_aircraft->passengers); ?></div>
							<div class="col s6 right-align"><strong><?= t('fleet_lang_single_feat_crew'); ?></strong> : </div><div class="col s6 left-align"><?= $single_aircraft->crew->$crew_lg?></div>
						</div>
					</div>

					<div id="photos-tab">
						<div class="custom-card-tabs col s2" style="display: flex;">
							<ul class="custom-tabs">
								<li class="tab active"><a href="#photo1"><?= img($single_aircraft->photo_exter)?></a></li>
								<li class="tab" ><a href="#photo2"><?= img($single_aircraft->photo_inter)?></a></li>
								<li class="tab"><a href="#photo3"><?= img($single_aircraft->photo_plan)?></a></li>
							</ul>
						</div>
						<div class="card-content grey lighten-4 col s10">
							<div id="photo1" class="photo-card" style="display: block;"><?= img($single_aircraft->photo_exter, '',  'materialboxed')?></div>
							<div id="photo2" class="photo-card"><?= img($single_aircraft->photo_inter, '',  'materialboxed')?></div>
							<div id="photo3" class="photo-card"><?= img($single_aircraft->photo_plan, '',  'materialboxed')?></div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

