<?php $lng = $this->lang->lang();
$crew_lg = 'crew_'.$lng;
$type_lg = 'type_'.$lng;
?>
<!-- PARALLAX -->
<div class="parallax-container" style="min-height:450px !important;">
    <div class="parallax"><?= img("parallax4.jpg", 'blog', "" )?>
		<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="white" points="0,0 65,0 65,101 0,101"/>
			<polygon fill="white" points="64.9,0 75,101 64.9,101"/>
			<polygon fill="white" points="75,101 85,0 85,101"/>
			<polygon fill="white" points="84.9,0 100,0 100,101 84.9,101"/> -->
<!--			<a href="#" class="svg-link-elt" style="cursor:pointer;">
				<polygon fill="white" points="67,0 82.9,0 75,78"/>
			</a>-->
		<!-- </svg> -->
	</div>
</div>
<div class="arrow_box"></div>
<section id="focus-content" class="row fleet-list">
	<div class="col l8 s12 offset-l2" style="padding-left:2rem; margin-bottom: 2rem;">
		<h1 class="red-text text-darken-4">LA FLOTTE MKPARTNAIR</h1>
		<h2>Nos meilleurs ventes flash avec les meilleurs avions du monde etc etc .... </h2>
		<p>blabla blabla blabla blabla blabla blabla blabla blabla 
			blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla </p>
	</div>
<!--	<i class="material-icons center js-scrollTo" href="#focus-content" style="cursor: pointer;">&#xE5DB;</i>-->
	<div class="row">
		<div class="filter-btn col l10 s12 offset-l1">
			<h4 class="col m3 blue-text text-darken-5"><span>AFFINER<i class="material-icons">&#xE5C5;</i></span></h4>
		</div>
		<?= form_open('', array('id'=>"fleet-filter-form",
								'class' => 'col l10 s12 offset-l1')) ?>
		<input name="ajax" type="text" value="1" hidden="hidden">
		<div class="input-field fleet-type-form-cont col s3">
			<?= form_input(array("type" => "checkbox",
								"class"=>"input-change-elt validate",
								"name"=>"jet-type",
								"id"=>"jet-type",
								"value"=> "1",
								$jet_checked=> '',
			)) ?>
			<label for="jet-type">Jets privés</label>
			<?= form_input(array("type" => "checkbox",
								"class"=>"input-change-elt validate",
								"name"=>"charter-type",
								"id"=>"charter-type",
								"value"=> "2",
								$charter_checked=>'' ,
			)) ?>
			<label for="charter-type">Avions de ligne</label>
<!--			<input id="on" name="state-d" type="radio" checked="">
			<label for="on" onclick="">ON</label>

			<input id="na" name="state-d" type="radio" checked="checked">
				<label for="na" onclick="">N/A</label>

			<input id="off" name="state-d" type="radio">
			<label for="off" onclick="">OFF</label>-->
		</div>
		<div id="manufacturer" class="input-field valign-wrapper col s3">
			<i class="material-icons prefix">&#xE539;</i>
			<select name="manufacturer" class="input-change-elt">
				<option selected value="">Constructeur
				</option>
				<?php foreach($manufact_list as $manufacturer): ?>
				<option class="circle right" data-icon="<?= base_url("assets/img/flag/$manufacturer->flag") ?>" value="<?= $manufacturer->id ?>" <?= set_select('manufacturer', $manufacturer->id) ?>><?= $manufacturer->name ?>
				</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="input-field valign-wrapper col s3">
			<i class="material-icons prefix">&#xE7EF;</i>
			<select id="passengers" name="passengers" class="input-change-elt">
				<option selected value="">Capacité
				</option>
				<?php
				$p=$min_passengers;
				while($p<=$max_passengers):
					if(( $p<10 && $p%2==0 )
					||( $p<26 && $p>=10 && $p%5==0 )
					||( $p>26 && $p<=150 && $p%50==0 )
					||( $p>150 && $p%100==0 )
					):?>
				<option <?= set_select('passengers', $p) ?>><?= $p ?>
				</option>
				<?php
					endif;
					$p++;
				endwhile; ?>
			</select>
		</div>
		<div class="input-field valign-wrapper col s3">
			<i class="material-icons prefix">&#xE192;</i>
			<select id="range" name="range" class="input-change-elt">
				<option selected value="">Autonomie
				</option>
				<?php
				$r=floor($min_range/100)*100;
				while($r<=$max_range):
					if(( $r<800 && $r%100==0 )
					||( $r<=5000 && $r>=1000 && $r%1000==0 )
					||( $r>5000 && $r%5000==0 )
				):?>
				<option value="<?=$r?>"><?= range_cvt($r, $lng) ?>
				</option>
				<?php
					endif;
					$r+=100;
				endwhile; ?>
			</select>
		</div>
		<?= form_close() ?>
	</div>
		
    <div id="fleet-list-ajax" class="col s10 offset-s1">
        <ul class="move-list list-container">
		<h4><?= $nb_aircrafts ?> appareils</h4>
            <?php 
            foreach ($aircrafts as $aircraft):
				$type_class = strtolower($aircraft->type->type_en) === "private jet" ? ' jet-type ': ' charter-type ';
            ?>
            <li class="row valign-wrapper move-item grey lighten-3 fleet-item hoverable">
				<div class="col s4 fleet-manu">
					<div class="col s6">
						<?= img('flag/'.$aircraft->manufacturer->flag, $aircraft->manufacturer->flag . ' flag', "min-fleet-flag") ?>
						<span><?= $aircraft->manufacturer->name ?></span>
					</div>
					<div class="col s6 center">
						<span><?= $aircraft->model ?></span>
					</div>
                </div>
				<div class="col s3 fleet-type-container center">
					<?= img($aircraft->photo_bonus, $aircraft->type->$type_lg, "center rcrft-type-img$type_class") ?>
					<div class="fleet-img-pop hoverable" onclick="document.location='<?= base_url('fleet/showAircraft/$aircraft->id') ?>'">
						<span class="arrow"></span>
						<?= img($aircraft->photo_exter, '', "") ?>
						<i class="material-icons">&#xE8B6;</i>
					</div>
				</div>
				<div class="col s2 center">
					<small class="info-legend">Autonomie</small>
					<i class="material-icons">&#xE192;</i>
					<strong><?= $aircraft->aircraft_range ?></strong>
				</div>
				<div class="col s2 center">
					<small class="info-legend">Capacité max</small>
					<i class="material-icons">&#xE7EF;</i>
					<strong><?= $aircraft->passengers ?></strong>
				</div>
				<div class="right-align right col s2">
					<a class="btn waves-effect waves-light blue darken-5 wite-text" href="<?= base_url("fleet/showAircraft/" . $aircraft->id) ?>" style="padding-left: 1.2rem; padding-right: 1.2rem;">Détails</a>
				</div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>