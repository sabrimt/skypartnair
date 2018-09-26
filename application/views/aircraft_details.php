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
			<?= img('flag/'.$single_aircraft->manufacturer->flag, $single_aircraft->manufacturer->flag . ' flag', "right flagpro min-fleet-flag ") ?>
			<h2 class="right aircraft_h2"><?=$single_aircraft->manufacturer->name  ?></h2>
		</div>
	</div>
</div>
<div class="parallax-container" style="min-height:500px !important;">
    <div class="parallax"><?= img($single_aircraft->photo_exter, 'blog', "" )?></div>
</div>
	<div class="container">
		<div class="row">
			<div class="col s12 l9">
				<h2>DESCRIPTION DE L'AVION</h2>
				<div class="card">
					<div class="card-content">
					  <p><?= $single_aircraft->$description ?></p>
					  <p>Equipage généralement constaté : <?= $single_aircraft->crew->$crew_lg?></p>
					</div>
					<div class="card-tabs">
					  <ul class="tabs tabs-fixed-width">
						<li class="tab"><a href="#test4">Capacité</a></li>
						<li class="tab"><a class="active" href="#test5">Autonomie</a></li>
						<li class="tab"><a href="#test6">Vitesse</a></li>
					  </ul>
					</div>
					<div class="card-content grey lighten-4">
					  <div id="test4"><?= $single_aircraft->passengers ?></div>
					  <div id="test5"><?= $single_aircraft->aircraft_range ?></div>
					  <div id="test6"><?= $single_aircraft->cruise_speed ?></div>
					</div>
				  </div>
<!--				<div class="col l10 offset-l1 s12" style="margin-top:2rem;">
					<h2 class="">DESCRIPTION DE L'AVION</h2>
					<p class="article_content">
						<?= $single_aircraft->$description ?>
					</p>
				</div>-->
			</div>
			<div class="col s12 l3">
				<h2>Photos</h2>
				<div class="col s12">
					<h2 class="valign-wrapper" style="margin-top:0;">
<!--						<i class="material-icons prefix ">&#xE3B0;</i>-->
						</h2>
					<img class="materialboxed" width="100%" style="margin-bottom:1rem;" src="<?= base_url('assets/img/' . $single_aircraft->photo_exter)?>">
					<img class="materialboxed" width="100%" style="margin-top:1rem;" src="<?= base_url('assets/img/' . $single_aircraft->photo_inter)?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 l12">
<!--			<h2 style="margin-bottom:0;">PLAN</h2>-->
				<div class="col s12">
					<img class="materialboxed" width="100%;" src="<?= base_url('assets/img/' . $single_aircraft->photo_plan)?>">
				</div>
			</div>

	</div>

