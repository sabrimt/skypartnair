<?php $lng = $this->lang->lang();
$crew_lg = 'crew_'.$lng;
$type_lg = 'type_'.$lng;
?>
<div class="parallax-container" style="min-height:450px !important;">
    <div class="parallax"><?= img("photo-voyage-8.jpg", 'blog', "" )?>
		<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="white" points="0,0 65,0 65,101 0,101"/>
			<polygon fill="white" points="64.9,0 75,101 64.9,101"/>
			<polygon fill="white" points="75,101 85,0 85,101"/>
			<polygon fill="white" points="84.9,0 100,0 100,101 84.9,101"/>
		</svg> -->
	</div>
  </div>
<section class="row liste-ventes" style="background-color: #FAFAFA; margin-bottom: 0;">
	<div class="col l8 s12 offset-l2" style="padding-left:2rem;">
		<h1 class="red-text text-darken-4"><?= t("flash_lang_h1") ?></h1>
		
		<h2><?= t("flash_lang_h2") ?></h2>
		<p><?= t("flash_lang_p") ?></p>
		<h3 class="success-flash-msg blue lighten-7 center z-depth-3">
			<?= $session['email_sent']??"" ?>
		</h3>
	</div>
<!--	// VUE A JOUR-->
    <div class="col l10 s12 offset-l1" >
        <ul class="sales-list move-list collapsible popout" data-collapsible="accordion" style="margin-top: 1rem; margin-bottom: 2rem; border: none!important; ">
			
                <?php 
                $s = "";
                if (empty($sales)) {
                    ?> 
            <h3 style="padding-left:2rem;"><?= t("flash_lang_h3_sorry") ?> </h3>
            
                <?php } else {
                if ($nb_sale>1) {
                     $s ="s";
                }
                ?> 
            <h4 style="padding-left:2rem;"><?= t("flash_lang_h3_sale_count", [$nb_sale, $s]) ?></h4>
			<div class="row">
				<?php if(validation_errors()){
					echo validation_errors("<em class='block col m8 offset-m2 s10 offset-s1 valign-wrapper grey lighten-2' style='border-left: 4px solid #9B3532; padding-bottom: 1px; padding-top: 1px;'><i class='material-icons red-text text-darken-2 left' style='font-size: 1.2rem;'>error</i>", "</em>");?>
				<div class="col m8 offset-m2 s10 offset-s1 valign-wrapper grey lighten-2" style="border-left: 4px solid #9B3532;">
					<a href="#active-item" class="btn active-item-link red darken-5"><?= t("flash_lang_complete_form") ?></a>
				</div>
			<?php	} ?>
			</div>
            
			<?php
			foreach ($sales as $sale_index => $sale):
				if ($sale->to_date != $sale->from_date && $sale->to_date != "") {
					$dispo_complete = t("flash_lang_date_interval", [$sale->from_date, $sale->to_date]);
				} else {
					$dispo_complete = '<strong style="font-weight: 600;">'.$sale->from_date.'</strong>';
				}
				
			?>
            
            <li class="move-item" >
                <div class="row collapsible-header hoverable" style="padding-top:1rem;">
                    <div class="sale-infos-form col l3 m4 s12" data-sale="<?= $sale->id ?>">
                            <div class="valign-wrapper space-around">
								<strong><?= strtoupper($sale->departure) ?></strong>
                                <i class="material-icons rotate-item">&#xE539;</i><strong><?= strtoupper($sale->arrival) ?></strong>
                            </div>
                            <div class="separator metal linear"></div>
                            <div class="left-align">
								<small><?= t("flash_lang_avail") ?> <br/></small>
                                <span><small style="font-size: 80%;"><?= $dispo_complete ?></small></span>
                            </div>
                    </div>
					
										<div class="col l7 m8 s12 flex-container">
											<div class="col l6 m6 s6 push-s3" data-sale-index="<?= $sale_index ?>">
												<div class="center-align" style="margin-bottom:0;">
													<?= img($sale->fleet->photo_bonus, 'avion', "pictoflash" )?>
												</div>
												<div class="center-align" style="margin-top:0;">
													<span class="center-align"> <?= $sale->fleet->manufacturer->name . ' ' . $sale->fleet->model ?> </span>
												</div>
											</div>

											<div class="col l2 m3 s3 pull-s6 valign-wrapper space-around">
												<div class="center">
													<span class="valign-wrapper space-around" style="font-size:14pt;"> <i class="material-icons">&#xE637;</i><?= $sale->capacity ? '<strong>'.$sale->capacity.'</strong>' : '<small style="font-size: 60%;">N/C</small>'; ?></span>
													<span> <small style="font-size: 8pt;"><?= t("flash_lang_capacity") ?> </small></span>
												</div>
											</div>
											
											<div class="col l4 m3 s3 valign-wrapper space-around">
												<h3 class="red-text text-darken-5"><strong><?= "€ " . $sale->price ?></strong></h3>
											</div>
															</div>
										<div class="col l2 s12 valign-wrapper space-around interest-height">
											<span class="valign-wrapper"><i class="material-icons">&#xE148;</i><?= t("flash_lang_interest") ?></span>
										</div>
										<div class=" col s12 interest-container">
											<div class="interest-block flex-container space-around" style="display:none;">
												<strong class="material-icons">&#xE5C5;</strong>
												<span><?= t("flash_lang_interest") ?></span>
												<strong class="material-icons">&#xE5C5;</strong>
											</div>
										</div>
										<div class="header-aircraft-details row">
											<div class="header-aircraft-details-content col s12">
												<div class="detail-photos col m8 s7">
													<div class="col l4 m6 s12 details-content flex-col-container space-around">
														<?= img($sale->fleet->photo_exter, 'Aircraft outside photo', "sale-photo-detail") ?>
													</div>
													<div class="col l4 m6 s12 details-content flex-col-container space-around">
														<?= img($sale->fleet->photo_inter, 'Aircraft inside photo', "sale-photo-detail") ?>
													</div>
													<div class="col l4 m6 s12 details-content flex-col-container space-around">
														<?= img($sale->fleet->photo_plan, 'Aircraft plan photo', "sale-photo-detail") ?>
													</div>
												</div>
												<div class="col m4 s5 details-content">
													<h3 class="blue-text text-darken-6 center-align"><?= $sale->fleet->manufacturer->name.' | '.$sale->fleet->model ?></h3>
													<p><strong><?= t('flash_lang_detail_type') ?> :</strong> <span class="right"><?= $sale->fleet->type->$type_lg ?></span></p>
													<p><strong><?= t('flash_lang_detail_speed') ?> :</strong> <span class="right"><?= $sale->fleet->cruise_speed ?></span></p>
													<p><strong><?= t('flash_lang_detail_range') ?> :</strong> <span class="right"><?= $sale->fleet->aircraft_range ?></span></p>
													<p><strong><?= t('flash_lang_detail_passengers') ?> :</strong> <span class="right"><?= $sale->fleet->passengers ?></span></p>
													<p><strong><?= t('flash_lang_detail_crew') ?> :</strong> <span class="right"><?= $sale->fleet->crew->$crew_lg ?></span></p>
												</div>
											</div>
											<div class="details-close-ban col s12">
												<small><?= t('flash_lang_detail_close') ?></small>
											</div>
										</div>
													</div>
													<div class="collapsible-body row minheight">
										
										<!-- ********************** -->
										<!-- EMAIL FORM ON COLLAPSE -->
										<!-- ********************** -->
					
                </div>
            </li>
            <?php endforeach; }?>
        </ul>
    </div>
	
	
	
	<!-- ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ -->
	<!-- ¤¤¤¤¤  EMAIL FORM  ¤¤¤¤¤ -->
	<div class="hide">
		<?= form_open('', array('id'=>"mail-form-content",
								'class' => 'mail-form'))?>
		<div class="">
			<i>"<?= t("flash_lang_interested") ?>"</i>
		</div>
		
		<div class="row">
			<div class="col l10 s12">
				<div class="row">
					<div class="col l8 offset-l1 s12 gender-name-fields">
						<div class="input-field col s4 valign-wrapper">
							<i class="material-icons prefix hide-on-small-only">&#xE7FF;</i>
							<select name="gender">
								<option disabled selected><?= t("flash_lang_gender") ?>
								</option>
								<option <?= set_select('gender', t("flash_lang_gender_mrs")) ?>><?= t("flash_lang_gender_mrs") ?>
								</option>
								<option <?= set_select('gender', t("flash_lang_gender_ms")) ?>><?= t("flash_lang_gender_ms") ?>
								</option>
								<option <?= set_select('gender', t("flash_lang_gender_mr")) ?>><?= t("flash_lang_gender_mr") ?>
								</option>
								<option <?= set_select('gender', t("flash_lang_gender_co")) ?>><?= t("flash_lang_gender_co") ?>	
								</option>
							</select>
						</div>
						<div class="input-field col s8 valign-wrapper">
							<?= form_input(array("type" => "text",
												"class"=>"validate",
												"name"=>"name",
												"id"=>"name",
												"value"=> set_value("name"),
							))
							. form_label(t("flash_lang_name"), "name",
											["class"=>"active",])
							?>
						</div>
					</div>
				</div>
		<div class="row">
			<div class="input-field col l6 s12 valign-wrapper">
				<i class="material-icons prefix hide-on-small-only">&#xE0E1;</i>
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
			<div class="input-field col l5 s12 valign-wrapper">
			<i class="material-icons prefix hide-on-small-only">&#xE324;</i>
					<?= form_input(array("type" => "tel",
									"class"=>"validate placeholder-input",
									"name"=>"phone",
									"id"=>"phone",
									"value"=> set_value("phone"),
									"maxlength"=>"20",
									"pattern"=>"[\+]\d+",
									"title"=>t("flash_lang_ph_title"),
						))
					. form_label(t("flash_lang_phone"), "phone",
						["class"=>"active",])?>
			</div>
		</div>
		<div class="row">
			<div class="input-field valign-wrapper col l11 s12 m9">
				<i class="material-icons prefix hide-on-small-only">&#xE3C9;</i>
				<?= form_textarea(array(
					"name"		=>"message",
					"id"		=>"message",
					"class"		=>"materialize-textarea",
					"value"		=> set_value('message'),
					"data-length"=> "250",
					"maxlength"	=> "250",
				)) 
					. form_label(t("flash_lang_requirements"), "message")
					?>
			</div>
			<div class="input-field col s12 l2 m3">
				
			</div>
		</div>
	</div>
			<div class="col l2 s12">
				<div class="col s12 valign-wrapper">
					<a class="btn waves-effect waves-light center-align blue lighten-6 show-btn valign-wrapper" data-sale-index="<?= $sale_index ?>" style="height: -webkit-max-content; height: -moz-max-content; height: max-content; line-height: inherit;">
								<small><?= t("flash_lang_details") ?></small>
					</a>
				</div>
				<div class="col s12">
				<button class="btn waves-effect waves-light btn-large blue darken-6" type="submit" name="send" value="<?= set_value("send") ?>" style="width:100%;">
						   <?= t("flash_lang_send") ?>
				</button>
				</div>
			</div>
			
		<?= form_close()?>
	</div>
	<!-- ¤¤¤¤¤  END EMAIL FORM  ¤¤¤¤¤ -->
	<!-- ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ -->
	
</section>

<section class="row txt-ventes blue-grey lighten-5" style="margin-bottom: 0;">
	<div class="col l8 s12 offset-l2 blue-grey lighten-5" style="margin-bottom:0; padding-bottom: 2rem;">
		<h3 class="valign-wrapper red-text text-darken-5" style="margin-top:3rem;"><i class="material-icons left">&#xE83A;</i><strong><?= t("flash_lang_how") ?></strong></h3>
		<p style="margin-bottom: 0;"><?= t("flash_lang_p2") ?></p>
		<ul class="collection col l7 s12 offset-l1 blue-grey lighten-5" style=" margin-top:0; margin-bottom: 0;">
			<li class="collection-item"><?= t("flash_lang_li1") ?></li>
			<li class="collection-item"><?= t("flash_lang_li2") ?></li>
		</ul>
	</div>
	<div class="col l10 s12 offset-l2 blue-grey lighten-5" style="margin-top: 0;">
		<p style="margin-bottom: 0; margin-top:0;"><?= t("flash_lang_p3") ?></p>
		<ul class="col l10 s12 offset-l1 blue-grey lighten-5">
			<li class="valign-wrapper"><i class="material-icons left">&#xE815; </i><?= t("flash_lang_li3") ?> </li>
			<li class="valign-wrapper"><i class="material-icons left">&#xE5CA;</i><?= t("flash_lang_li4") ?>  </li>
		</ul>
	</div>
	<div class="col l10 s12 offset-l2 blue-grey lighten-5" style="margin-top: 0; padding-bottom: 3rem;">
		<p><?= t("flash_lang_p4") ?><strong>SKY Partnair</strong> <?= t("flash_lang_p41") ?><br/>
		<?= t("flash_lang_p42") ?></p>
		<p><?= t("flash_lang_p5") ?><a href="+33 1 00 00 00 00">+33 1 00 00 00 00</a> <?= t("flash_lang_p51") ?></p>
		<p><small><i><?= t("flash_lang_p6") ?></small></i></p>
	</div>
</section>
	
