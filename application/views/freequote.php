<section class="row">

    <h1 class="col m8 offset-m2 s10 offset-s1 center red-text text-darken-4"><?= t('privatejet_lang_h1') ?></h1>
    <div class="row">
        <?php if(validation_errors()){
		echo validation_errors("<em class='block col m8 offset-m2 s10 offset-s1 valign-wrapper grey lighten-2' style='border-left: 4px solid #9B3532; padding-bottom: 1px; padding-top: 1px;'><i class='material-icons red-text text-darken-2 left' style='font-size: 1.2rem;'>error</i>", "</em>");}
		if(isset($session['email_sent'])): ?>
		<h3 class="col m8 offset-m2 s10 offset-s1 success-flash-msg blue lighten-7 center z-depth-3"><?= $session['email_sent'] ?>
		</h3>
		<?php endif; ?>
    </div>
	
    <?= form_open('', array('class' => 'col l8 offset-l2', 'id' => 'free-quote-form')) ?>
        <div class="row radio-btn-fields">
			<input name="travel-type" type="radio" value="owq" id="one-way-quote" class="with-gap" <?= set_radio('travel-type', 'owq', TRUE); ?> />
			<label class="travel-type-radio with-gap" for="one-way-quote"><?= t('privatejet_lang_trvl_type_single') ?></label>

			<input name="travel-type" type="radio" value="rq" id="return-quote" class="with-gap" <?= set_radio('travel-type', 'rq'); ?> />
			<label class="travel-type-radio with-gap" for="return-quote"><?= t('privatejet_lang_trvl_type_round') ?></label>

			<input name="travel-type" type="radio" value="mq" id="multi-quote" class="with-gap" <?= $multi_chkd . set_radio('travel-type', 'mq'); ?> />
			<label class="travel-type-radio with-gap" for="multi-quote"><?= t('privatejet_lang_trvl_type_multi') ?></label>
		</div>
	
		<div class="row">
            <!-- Champ ville départ -->
                <div class="input-field col m5 s12 valign-wrapper">
					<i class="material-icons prefix">&#xE905;</i>
                    <?= form_label(t('privatejet_lang_dep_city'), "departure", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"	=>"departure",
						"id"	=>"departure",
						"value"	=>set_value('departure'),
						"class"	=>"validate",
						"size"	=>"100")) ?>
                </div>
                <!-- Champs date aller -->
				<div class="col m7 s12">
					<div class="input-field col s7 m6 offset-m1 valign-wrapper">
						<i class="material-icons prefix">&#xE916;</i>
						<?= form_label(t('privatejet_lang_dep_date'), "departure_date", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"departure_date",
							"id"		=>"departure_date",
							"value"		=> set_value('departure_date'),
							"class"		=>"datepicker")) ?>
					</div>
					<div class="input-field col s5 valign-wrapper">
						<i class="material-icons prefix">&#xE192;</i>
						<?= form_label(t('privatejet_lang_time'), "departure_time", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"departure_time",
							"id"		=>"departure_time",
							"value"		=> set_value('departure_time'),
							"class"		=>"timepicker")) ?>
					</div>
				</div>
			</div>
			
			<?php for($step=1;$step<10;$step++):
			// visibilité des champs étape
			$step_post = $this->input->post("step_".$step);
			$visible_field = isset($step_post)? "visible-fields " : "";
			$rmv_stp_btn = $step > 1 ? '<small class="remove-step-btn"><em class="red-text text-darken-5 valign-wrapper"><i class="material-icons left">&#xE15B;</i>'. t('privatejet_lang_rmv_step') .'</em></small>' : '';
			?>
	
			<div class="row multi-fields <?= $visible_field ?>" style="display: none;">
				<h4><strong class="valign-wrapper"><?= t('privatejet_lang_lgd_step') . $step . $rmv_stp_btn ?></strong></h4>
                <div class="input-field col m5 s12 valign-wrapper">
					<i class="material-icons prefix">&#xE905;</i>
                    <?= form_label(t('privatejet_lang_stp_city') . $step, "step_$step", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"	=>"step_$step",
						"id"	=>"step_$step",
						"value"	=>set_value('step_'.$step),
						"class"	=>"validate steps-city",
						"size"	=>"100")) ?>
				</div>
				<div class="col m7 date-time-infos">
					<div class="input-field col s7 m6 offset-m1 valign-wrapper">
						<i class="material-icons prefix">&#xE916;</i>
						<?= form_label(t('privatejet_lang_stp_date') . $step, "date_step_$step", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"date_step_$step",
							"value"		=> set_value('date_step_'.$step),
							"id"		=>"date_step_$step",
							"class"		=>"datepicker steps")) ?>
					</div>
					<div class="input-field col s5 valign-wrapper">
						<i class="material-icons prefix">&#xE192;</i>
						<?= form_label(t('privatejet_lang_time'), "time_step_$step", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"time_step_$step",
							"id"		=>"time_step_$step",
							"value"		=> set_value('time_step_'.$step),
							"class"		=>"timepicker steps")) ?>
					</div>
                </div>
			</div>
			<?php endfor;
			// visibilité des champs retour pour multiquote => class 'remove-btn' sur '.return-fields-btn'
			$qtype = $this->input->post('travel-type');
			$dest = $this->input->post('destination');
			if(isset($dest) && isset($qtype) && $qtype == 'mq'){ $rmv_btn = ' remove-btn'; } else { $rmv_btn = ''; }
			?>
			
			<h3><small class="fields-add-btn red-text text-darken-5"><i class="material-icons left">&#xE145;</i><?= t('privatejet_lang_add_step') ?></small></h3>
			<h3><small class="return-fields-btn blue-text text-darken-6 <?= $rmv_btn ?>"><i class="material-icons left">&#xE145;</i><?= t('privatejet_lang_return_fields') ?></small></h3>
			<div class="row">
                <div class="input-field col m5 valign-wrapper">
					<i class="material-icons prefix">&#xE904;</i>
                    <?= form_label(t('privatejet_lang_dest_city'), "destination", ["class"=>"active destination", "data-error"=>"wrong", "data-success"=>"right"])
					. form_input(array(
						"name"	=>"destination",
						"id"	=>"destination",
						"value"	=>set_value('destination'),
						"class"	=>"validate",
						"size"	=>"100")) ?>
				</div>
				<div class="col m7 arrival-infos">
					<div class="input-field col s7 m6 offset-m1 valign-wrapper">
						<i class="material-icons prefix">&#xE916;</i>
						<?= form_label(t('privatejet_lang_dest_date'), "return_date", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"return_date",
							"value"		=> set_value('return_date'),
							"id"		=>"return_date",
							"class"		=>"datepicker")) ?>
					</div>
					<div class="input-field col s5 valign-wrapper">
						<i class="material-icons prefix">&#xE192;</i>
						<?= form_label(t('privatejet_lang_time'), "return_time", ["class"=>"active"])
						. form_input(array(
							"type"		=>"text",
							"name"		=>"return_time",
							"id"		=>"return_time",
							"value"		=> set_value('return_time'),
							"class"		=>"timepicker",
							"data-value"=> isset($current) ? $current->from_date : "")) ?>
					</div>
                </div>
			</div>
			<div class="row infos-passengers">
				<div class="input-field col s6 m4 valign-wrapper">
					<i class="material-icons prefix">&#xE7EF;</i>
					<select name="passengers">
						<option disabled selected><?= t('privatejet_lang_passengers') ?>
						</option>
						<?php
						$n = 0;
						while($n < 301):
							$n++;
							if($n>=19 && $n < 30):
							$n = 31;
						?>
								<option <?= set_select('passengers','19 - 30') ?>>19 - 30</option>
							<?php elseif ($n>30 && $n < 50):
								$n = 51;
							?>
								<option <?= set_select('passengers','31 - 50') ?>>31 - 50</option>
							<?php elseif ($n>50 && $n < 100):
								$n = 101;
							?>
								<option <?= set_select('passengers','51 - 100') ?>>51 - 100</option>
							<?php elseif ($n>100 && $n < 150):
								$n = 151;
							?>
								<option <?= set_select('passengers','101 - 150') ?>>101 - 150</option>
							<?php elseif ($n>150 && $n < 200):
								$n = 201;
							?>
								<option <?= set_select('passengers','151 - 200') ?>>151 - 200</option>
							<?php elseif ($n>200 && $n < 250):
								$n = 251;
							?>
								<option <?= set_select('passengers','201 - 250') ?>>201 - 250</option>
							<?php elseif ($n>250 && $n < 300):
								$n = 300;
							?>
								<option <?= set_select('passengers','251 - 300') ?>>251 - 300</option>
							<?php elseif ($n > 300):
							?>
								<option <?= set_select('passengers','+ 300') ?>>+ 301</option>
							<?php else:
							?>	
								<option <?= set_select('passengers',$n) ?>><?= $n ?></option>
							<?php
							endif;
						endwhile; ?>
					</select>
				</div>
                <!-- Champ Budget-->
                <div class="input-field col s12 m6 offset-m2 valign-wrapper">
					<i class="material-icons prefix">&#xE926;</i>
                    <?= form_label(t('privatejet_lang_budget'), "budget", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=>"budget",
						"id"		=>"budget",
						"value"		=> !isset($current) ?
							set_value('budget') :
							$current->price,
						"class"		=>"validate",
						"max-length"=>"8",
						"min-length"=>"3",
						"type"		=>"number")) ?>
                </div>
			</div>
			<div class="row">
			<div class="input-field valign-wrapper col s12">
				<i class="material-icons prefix">&#xE3C9;</i>
				<?= form_textarea(array(
					"name"		=>"message",
					"id"		=>"message",
					"class"		=>"materialize-textarea",
					"value"		=> set_value('message'),
					"data-length"=> "250",
					"maxlength"	=> "250",
				)) 
					. form_label(t("privatejet_lang_requirements"), "message")
					?>
			</div>
		</div>
	
	
		<div class="row personnel-infos">
			<div class="col s12 gender-name-fields">
				<div class="input-field col m3 s6 valign-wrapper">
					<i class="material-icons prefix">&#xE7FF;</i>
					<select name="gender">
						<option disabled selected><?= t("privatejet_lang_gender") ?>
						</option>
						<option value="Mme"<?= set_select('gender', 'Mme') ?>><?= t("privatejet_lang_gender_mrs") ?>
						</option>
						<option value="Mlle"<?= set_select('gender', 'Mlle') ?>><?= t("privatejet_lang_gender_ms") ?>
						</option>
						<option value="Mr"<?= set_select('gender', 'Mr') ?>><?= t("privatejet_lang_gender_mr") ?>
						</option>
						<option value="Sté"<?= set_select('gender', 'Sté') ?>><?= t("privatejet_lang_gender_co") ?>	
						</option>
					</select>
				</div>
				<div class="input-field col s12 m4 offset-m1 valign-wrapper">
					<?= form_input(array("type" => "text",
										"class"=>"validate",
										"name"=>"name",
										"id"=>"name",
										"value"=> set_value("name"),
					))
					. form_label(t("privatejet_lang_name"), "name",
									["class"=>"active",])
					?>
				</div>
				<div class="input-field col m4 s12 valign-wrapper">
					<?= form_input(array("type" => "text",
										"class"=>"validate",
										"name"=>"first-name",
										"id"=>"first-name",
										"value"=> set_value("first-name"),
					))
					. form_label(t("privatejet_lang_first_name"), "first-name",
									["class"=>"active",])
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12 valign-wrapper">
				<i class="material-icons prefix">&#xE0E1;</i>
				<?= form_input(array("type" => "email",
									"class"=>"validate",
									"name"=>"email",
									"id"=>"email",
									"value"=>set_value("email"),
				))
					. form_label("Email", "email",
					["class"=>"active",])
					?>
			</div>
			<div class="input-field col m6 s12 valign-wrapper">
			<i class="material-icons prefix">&#xE324;</i>
					<?= form_input(array("type" => "tel",
									"class"=>"validate placeholder-input",
									"name"=>"phone",
									"id"=>"phone",
									"value"=> set_value("phone"),
									"maxlength"=>"20",
									"pattern"=>"[\+]\d+",
									"title"=>t("privatejet_lang_ph_title"),
						))
					. form_label(t("privatejet_lang_phone"), "phone",
						["class"=>"active",])?>
			</div>
		</div>
	
	
		<div class="row center">
			<button class="btn waves-effect waves-light red darken-5" type="submit" name="save">
				<?= t('privatejet_lang_send') ?>
			</button>
			<?= anchor('', t('privatejet_lang_cancel'), array("class" => "cancel-btn btn waves-effect waves-light grey darken-1")); ?>
		</div>
    <?= form_close() ?>
</section>
