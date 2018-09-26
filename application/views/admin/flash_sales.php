<section class="row">

    <h1 class="col s8 offset-s2 center"><?= $action ?> de vente flash</h1>
    <div class="row">
        <?= validation_errors("<em class='block red lighten-4 red-text col s8 offset-s2 valign-wrapper'><i class='material-icons red-text left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
    </div>
    <?= form_open('', array('class' => 'sale-form appear-form col s10 offset-s1')) ?>
        <div class="row">
            <div class="col s12 l6">
            <!-- Champs villes d'arrivée/départ-->
                <div class="input-field  valign-wrapper">
					<i class="material-icons prefix">flight_takeoff</i>
                    <?= form_label("Ville de départ", "departure", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"	=>"departure",
						"id"	=>"departure",
						"value"	=> !isset($single_sale) ?
							set_value('departure') :
							$single_sale->departure,
						"class"	=>"validate",
						"size"	=>"100")) ?>
                </div>
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">flight_land</i>
                    <?= form_label("Ville d'arrivée", "arrival", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"	=>"arrival",
						"id"	=>"arrival",
						"value"	=> !isset($single_sale) ?
							set_value('arrival') :
							$single_sale->arrival,
						"class"	=>"validate",
						"size"	=>"100")) ?>
				</div>
                <div class="input-field valign-wrapper">
                    <!-- Selection d'avion -->
					<i class="material-icons prefix">&#xE539;</i>
                    <select name="fleet_id">
                        <option disabled selected>Choix de l'appareil
							<?php foreach ($fleet_list as $fleet): ?>
							<option value="<?= $fleet->id ?>"
							<?= isset($single_sale)&&$single_sale->fleet_id==$fleet->id?"selected":"" ?>
							<?= set_select('fleet_id', $fleet->id ) ?>> <?= $fleet->manufacturer->name . ' - ' . $fleet->model ?>
							</option>
							<?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col s12 l6">
				<!-- Champ Capacité-->
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE87C;</i>

                    <?= form_label("Capacité", "capacity", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"capacity",
						"id"		=>"capacity",
						"value"		=> !isset($single_sale) ?
							set_value('capacity') :
							$single_sale->capacity,
						"class"		=>"validate",
						"max-length"=>"3",
						"min-length"=>"1",
						"type"		=>"number")) ?>
                </div>
                <!-- Champ Prix-->
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE926;</i>

                    <?= form_label("Prix", "price", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"price",
						"id"		=>"price",
						"value"		=> !isset($single_sale) ?
							set_value('price') :
							$single_sale->price,
						"class"		=>"validate",
						"max-length"=>"6",
						"min-length"=>"3",
						"type"		=>"number")) ?>
                </div>
                <!-- Champs dates de disponibilité -->
                <div class="input-field col s6 valign-wrapper">
					<i class="material-icons prefix">&#xE916;</i>
                    <?= form_label("Disponible du:", "from_date", ["class"=>"active"])
					. form_input(array(
						"type"		=>"text",
						"name"		=>"from_date",
						"id"		=>"from_date",
						"value"		=> set_value('from_date'),
						"class"		=>"datepicker",
						"data-value"=> isset($single_sale) ? $single_sale->from_date : "")) ?>
                </div>
                <div class="input-field col s6 valign-wrapper">
                    <?= form_label("au:", "to_date", ["class"=>"active"])
					. form_input(array(
						"type"		=>"text",
						"name"		=>"to_date",
						"value"		=> set_value('to_date'),
						"id"		=>"to_date",
						"class"		=>"datepicker",
						"data-value"=> isset($single_sale) ? $single_sale->to_date : "")) ?>
                </div>
           </div>
        </div>
        <button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save">
			Enregistrer
        </button>
		<?= anchor('mkadmin/flash/', 'Retour à la liste', array("class" => "cancel-btn right btn grey darken-1")); ?>
    <?= form_close() ?>
</section>
