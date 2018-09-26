<section class="row">
    <h1 class="col s8 offset-s2 center"><?= $action ?> d'appareil</h1>
    <div class="row">
        <?= validation_errors("<em class='block red lighten-4 red-text col s8 offset-s2 valign-wrapper'><i class='material-icons red-text left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
    </div>
    <?= form_open_multipart('', array('class' => 'rcraft-form appear-form col s10 offset-s1')) ?>
        <div class="row">
<!--			<legend><strong>Modèle :</strong></legend>-->
            <div class="col s12 l7">
				<!-- Champ Modèle-->
                <div class="input-field valign-wrapper">
                    <?= form_label("Modèle", "model", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"		=>"model",
						"id"		=>"model",
						"class"		=>"validate",
						"value"		=> !isset($single_aircraft) ? set_value('model') : $single_aircraft->model,
					)) ?>
				</div>
				<div class="input-field">
					<!-- Selection du constructeur -->
					<select name="manufacturer" class="icon">
						<option disabled selected>Choix du constructeur
						</option>
						<?php foreach($manufacturer_list as $manufacturer): ?>
						<option value="<?= $manufacturer->id ?>"
							<?= isset($single_aircraft)&&$single_aircraft->manufacturer->id==$manufacturer->id?"selected":"" ?>
							<?= set_select('manufacturer', $manufacturer->id) ?>
								class="circle right" data-icon="<?= base_url("assets/img/flag/$manufacturer->flag") ?>"><?= $manufacturer->name ?>
						</option>
						<?php endforeach; ?>
					</select>
					<?= form_label("Constructeur") ?>
				</div>
			</div>
			
			<div class="col s12 l5">
				<!-- Champs select Type/Catégorie-->
				<div class="input-field col l12 s6">
					<!-- Selection d'avion -->
					<select name="type">
						<option disabled selected>Choix du type
						</option>
						<?php foreach($type_list as $type): ?>
						<option value="<?= $type->id ?>"
							<?= isset($single_aircraft)&&$single_aircraft->type->id==$type->id?"selected":"" ?>
							<?= set_select('type', $type->id) ?>
							><?= $type->type_fr ?>
						</option>
						<?php endforeach; ?>
					</select>
					<?= form_label("Type de l'appareil") ?>
				</div>
				<div class="input-field col l12 s6">
					<!-- Selection d'avion -->
					<select name="category">
						<option disabled selected>Catégorie de l'appareil
						</option>
						<?php foreach($category_list as $category): ?>
						<option value="<?= $category->id ?>" 
							<?= isset($single_aircraft)&&$single_aircraft->category->id==$category->id?"selected":"" ?>
							<?= set_select('category', $category->id) ?>	
							><?= $category->category ?>
						</option>
						<?php endforeach; ?>
					</select>
					<?= form_label("Catégorie") ?>
				</div>
			</div>
		</div>
	
		<legend>
			<strong class="valign-wrapper">
				<i class="material-icons prefix left">&#xE3B0;</i>
				<a class="valign-wrapper photos-collapse" href="">Photos <i class="material-icons">&#xE5C5;</i></a>
			</strong>
		</legend>
		<?php if( isset($upload_errors)): ?>
		<div>
			<strong><?= $upload_errors ?></strong>
		</div>
		<?php endif; ?>
	<div class="photos-formbloc" hidden="hidden">
			<div class="row">
				<!-- Image actuelle -->
				<div class="col s6 valign-wrapper">
					<?php
					$col_ext = "12";
					if(isset($single_aircraft) && !empty($single_aircraft->photo_exter)):
						$col_ext = "9";
					echo img($single_aircraft->photo_exter, "aperçu flotte photo extérieur", "col s3");
					endif; ?>
				
					<!-- Champs file images -->
					<div class="file-field input-field col s<?= $col_ext ?>">
						<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
							<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
							<?= form_upload(array("id"=>"photo_exter", "name"=>"photo_exter")) ?>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Photo Extérieur">
						</div>
					</div>
				</div>
				<!-- Image actuelle -->
				<div class="col s6 valign-wrapper">
					<?php
					$col_int = "12";
					if(isset($single_aircraft) && !empty($single_aircraft->photo_exter)):
						$col_int = "9";
						echo img($single_aircraft->photo_inter, "aperçu flotte photo intérieur", "col s3");
					endif; ?>
				
					<div class="file-field input-field col s<?= $col_int ?>">
						<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
							<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
							<?= form_upload(array("id"=>"photo_inter", "name"=>"photo_inter")) ?>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Photo Intérieur">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Image actuelle -->
				<div class="col s6 valign-wrapper">
					<?php
					$col_plan = "12";
					if(isset($single_aircraft) && !empty($single_aircraft->photo_exter)):
						$col_plan = "9";
						echo img($single_aircraft->photo_plan, "aperçu flotte photo plan", "col s3");
					endif; ?>
				
					<div class="file-field input-field col s<?= $col_plan ?>">
						<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
							<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
							<?= form_upload(array("id"=>"photo_plan", "name"=>"photo_plan")) ?>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Photo Plan">
						</div>
					</div>
				</div>
				<!-- Image actuelle -->
				<div class="col s6 valign-wrapper">
					<?php
					$col_bonus = "12";
					if(isset($single_aircraft) && !empty($single_aircraft->photo_exter)):
						$col_bonus = "9";
						echo img($single_aircraft->photo_bonus, "aperçu flotte photo bonus", "col s3");
					endif; ?>
				
					<div class="file-field input-field col s<?= $col_bonus ?>">
						<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
							<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
							<?= form_upload(array("id"=>"photo_bonus", "name"=>"photo_bonus")) ?>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Photo Bonus">
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="row">
			<legend class="valign-wrapper">
				<i class="material-icons prefix left">&#xE85D;</i>
				<strong>Caractéristiques :</strong>
			</legend>
			<div class="col s12 l7">
				<!-- Champs num vitesse/autonomie/passagers -->
				<div class="input-field valign-wrapper col s4">
					<?= form_label("Vitesse", "cruise_speed", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"cruise_speed",
						"id"		=>"cruise_speed",
						"class"		=>"validate",
						"type"		=>"number",
						"value"		=> !isset($single_aircraft) ? set_value('cruise_speed') : $single_aircraft->cruise_speed,
					)) ?>
				</div>
				<div class="input-field valign-wrapper col s4">
					<?= form_label("Autonomie", "aircraft_range", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"aircraft_range",
						"id"		=>"aircraft_range",
						"class"		=>"validate",
						"type"		=>"number",
						"value"		=> !isset($single_aircraft) ? set_value('aircraft_range') : $single_aircraft->aircraft_range,
					)) ?>
				</div>
				<div class="input-field valign-wrapper col s4">
					<?= form_label("Passagers max", "passengers", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"passengers",
						"id"		=>"passengers",
						"class"		=>"validate",
						"max-length"=>"3",
						"min-length"=>"1",
						"type"		=>"number",
						"value"		=> !isset($single_aircraft) ? set_value('passengers') : $single_aircraft->passengers,
					)) ?>
				</div>
			</div>
			
			<div class="input-field col s8 offset-s2 l5">
				<select name="crew">
					<option disabled selected>Choix de l'équipage
					</option>
					<?php foreach($crew_list as $crew): ?>
					<option value="<?= $crew->id ?>" 
						<?= isset($single_aircraft)&&$single_aircraft->crew->id==$crew->id?"selected":"" ?>
						<?= set_select('crew', $crew->id) ?>	
						><?= $crew->crew_fr ?>
					</option>
					<?php endforeach; ?>
				</select>
				<?= form_label("Équipage") ?>
			</div>
		</div>
	
		<div class="row">
			<!-- Champs textarea descriptions -->
			<div class="input-field valign-wrapper col l6 s12">
				<?= form_label("Description Français", "description_fr")
				. form_textarea(array(
					"name"		=>"description_fr",
					"id"		=>"description_fr",
					"class"		=>"materialize-textarea",
					"value"		=> !isset($single_aircraft) ? set_value('description_fr') : $single_aircraft->description_fr,
				)) ?>
			</div>
			<div class="input-field valign-wrapper col l6 s12">
				<?= form_label("Description Anglais", "description_en")
				. form_textarea(array(
					"name"		=>"description_en",
					"id"		=>"description_en",
					"class"		=>"materialize-textarea",
					"value"		=> !isset($single_aircraft) ? set_value('description_en') : $single_aircraft->description_en,
				)) ?>
			</div>
		</div>
	
        <button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save">
			Enregistrer
        </button>
		<?= anchor('mkadmin/fleet/', 'Annuler', array("class" => "cancel-btn right btn grey darken-1")); ?>
    <?= form_close() ?>
</section>