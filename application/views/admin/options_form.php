<section>
	<div class="row">
        <?= validation_errors("<em class='block red lighten-4 red-text col s8 offset-s2 valign-wrapper'><i class='material-icons red-text left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
    </div>
	<!-- Options form -->
	<div class="row options-form">
	<?php if($form == "manufacturer"): ?><!-- Constructeur -->
		<?= form_open('', array('class' => 'manufacturer-form appear-form col s10 offset-s1 l4 offset-l4')) ?>
		<!-- Manufacturer form -->
		<div class="input-field valign-wrapper">
			<?= form_label("Nom du constructeur", "name", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
			. form_input(array(
				"name"	=>"name",
				"id"	=>"name",
				"value"	=> !isset($single_manufacturer) ?
					set_value('name') :
					$single_manufacturer->name,
				"class"	=>"validate",)) ?>
		</div>
		<div class="input-field">
			<!-- Selection du drapeau -->
			<select name="flag">
				<option disabled selected>Choix du pays
				</option>
				<?php foreach($flag_list as $country => $file): ?>
				<option value="<?= $file ?>"
					<?= isset($single_manufacturer)&&$single_manufacturer->flag==$file?"selected":"" ?>
					<?= set_select('flag', $file) ?>
					><?= $country ?>
				</option>
				<?php endforeach; ?>
			</select>
			<?= form_label("Nationalité") ?>
		</div>
		<button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save" value="manufacturer">
			Enregistrer
		</button>
		<?= form_close(); ?>
		
	<?php elseif($form == "crew"): ?><!-- Equipage -->
	
		<?= form_open('', array('class' => 'crew-form appear-form col s10 offset-s1 l4 offset-l4')) ?>
		<!-- Manufacturer form -->
		<div class="input-field valign-wrapper">
			<?= form_label("Équipage FR", "crew_fr", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
			. form_input(array(
				"name"	=>"crew_fr",
				"id"	=>"crew_fr",
				"value"	=> !isset($single_crew) ?
					set_value('crew_fr') :
					$single_crew->crew_fr,
				"class"	=>"validate",)) ?>
		</div>
		<div class="input-field valign-wrapper">
			<?= form_label("Équipage EN", "crew_en", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
			. form_input(array(
				"name"	=>"crew_en",
				"id"	=>"crew_en",
				"value"	=> !isset($single_crew) ?
					set_value('crew_en') :
					$single_crew->crew_en,
				"class"	=>"validate",)) ?>
		</div>
		<button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save" value="crew">
			Enregistrer
		</button>
		<?= form_close(); ?>
	
	<?php elseif($form == "category"): ?><!-- Catégorie -->
		<?= form_open('', array('class' => 'category-form appear-form col s10 offset-s1 l4 offset-l4')) ?>
		<!-- category form -->
		<div class="input-field valign-wrapper">
			<?= form_label("Catégorie", "category", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
			. form_input(array(
				"name"	=>"category",
				"id"	=>"category",
				"value"	=> !isset($single_category) ?
					set_value('category') :
					$single_category->category,
				"class"	=>"validate",)) ?>
		</div>
		<button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save" value="category">
			Enregistrer
		</button>
		<?= form_close(); ?>
	<?php endif; ?>
	</div>
</section>