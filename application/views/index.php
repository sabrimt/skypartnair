<?php
$lng = $this->lang->lang();
$title='title_' . $lng; 
$category='category_' . $lng;
$description='description_' . $lng;
$content='content_' . $lng;?>
    

<!-- PREMIER PARALLAX AVEC FORMULAIRE -->

<div id="index-banner" class="parallax-container">

    <div class="section no-pad-bot">
        <div class="container">
            <div class="row rowformul">
				<div class="formulaire col s3" style="position:relative;">

					<!-- FORM VALIDATION -->
					<?php if(validation_errors()){?>
					<div class="row grey lighten-2 frmval">
						<span class="arrow"></span>
						<?php
							echo validation_errors("<em class='block valign-wrapper grey lighten-2 black-text' style='font-size: .8rem;'><i class='material-icons red-text text-darken-2 left' style='font-size: 1.2rem; margin-right: 5px;'>error</i>", "</em>");?>
					</div>

					<?php } ?>
					<h3 class="success-flash-msg blue lighten-7 blue-text text-darken-6 center z-depth-3" style="margin-top: 0;">
						<?= $session['email_sent']??"" ?>
					</h3>

                    <div class="row rowformul1">
						<?= form_open('', array('id'=>"home-form",
								'class' => 'home-form col s12 formformul'))?>
							<div class="row" style="margin-bottom: .3rem;">
								<a class="col s6 blue lighten-7 waves-effect waves-light white-text vol btn btn-as <?php $postBtn = $this->input->post("envoidevis"); echo isset($postBtn) && $postBtn == "as"?"vol-active": "" ?>"><?= t('home_lang_form_oneway') ?></a>
                                <a class="col s6 blue lighten-7 waves-effect waves-light white-text vol btn btn-ar <?= isset($postBtn) && $postBtn == "as"?"": "vol-active" ?>"><?= t('home_lang_form_return') ?></a>
                            </div>
							<a href="<?= site_url("privatejet/freequote/multidestination") ?>" class="red-text text-darken-5 right" style="font-weight:700;"><small class="valign-wrapper">
									<i class="material-icons rotate-item">&#xE5C7;</i><?= t('home_lang_form_multi') ?>
							</small></a>
							<div class="row rowform">
								<div class="input-field col s12 black-text">
                                    <i class="material-icons prefix">flight_takeoff</i>
                                    <input id="departure" name="departure" type="text" class="validate inputform" value="<?= set_value("departure") ?>">
                                    <label for="departure"><?= t('home_lang_form_from') ?></label>
                                </div>
                            </div>

                            <div class="row rowform">
                                <div class="input-field col s12 black-text destination">
                                    <i class="material-icons prefix">flight_land</i>
                                    <input id="destination" name="destination" type="text" class="validate inputform" value="<?= set_value("destination") ?>">
                                    <label for="destination"><?= t('home_lang_form_to') ?></label>
                                </div>
                            </div>

                            <div class="row rowform">
                                <div class="input-field col s6 black-text">
                                    <input type="text" name="dep-date" class="datepicker inputform" placeholder="<?= t('home_lang_form_departuredate') ?>" value="<?= set_value("dep-date") ?>">
                                </div>

                                <div class="input-field col s6 black-text des-date">
                                    <input type="text" name="des-date" class="datepicker inputform" placeholder="<?= t('home_lang_form_returndate') ?>" value="<?= set_value("des-date") ?>">
                                </div>
                            </div>

                            <div class="row rowform">
								<div class="phone-info red-text text-darken-5 " hidden="hidden">
									<p><?= t('home_lang_form_phone_info') ?></p>
								</div>

                                <div class="input-field col s6 black-text inmarg">
                                    <input name="name" type="text" class="validate inputform" placeholder="<?= t('home_lang_form_name') ?>" value="<?= set_value("name") ?>">
                                </div>

                                <div class="input-field col s6 black-text inmarg">
                                    <input name="phone" type="text" class="validate inputform" placeholder="<?= t('home_lang_form_phone') ?>" value="<?= set_value("phone") ?>">
                                </div>
                            </div>

                            <div class="row rowform">
                                <div class="input-field col s12 black-text" >
                                    <input name="email" type="email" class="validate inputform" placeholder="@ Email *" value="<?= set_value("email") ?>">
								</div>
                            </div>

                            <div class="row rowform">
                                <button type="submit" name="envoidevis" value="ar" class="col s10 offset-s1 red darken-5 waves-effect waves-light btn btn2" ><i class="material-icons left">send</i><?= t('home_lang_form_button') ?></button>
                            </div>

						<?= form_close(); ?>
                    </div>
				</div>
            </div>
        </div>
    </div>

    <div class="parallax"> <?php // echo img('avion.jpg', 'image avion de ligne');?> 

		<!--<div class="slides-text slide-text-two red-text text-darken-5">
			<h2>MK PARTNAIR</h2>
			<p>Test parallax + slides + contenu</p>
		</div>
		<div class="slides-text slide-text-three red-text text-darken-5">
			<h2>MK PARTNAIR</h2>
			<p>Ceci est le deuxième contenu</p>
		</div>
		<div class="slides-text slide-text-four red-text text-darken-5">
			<h2>MK PARTNAIR</h2>
			<p>Et voilà le contenu pour la quatrième photo</p>
		</div>
		<div class="slides-text slide-text-five red-text text-darken-5">
			<h2>MK PARTNAIR</h2>
			<p>Photo 5 et son contenu</p>
		</div>-->
		
		<!-- <div class="text-paral-home">
			<p>SOLUTION D’AFFRÈTEMENT AÉRIEN</p>
			<p style="font-size:15pt;">LOCATION DE JET PRIVÉ OU AFFRÈTEMENT D’AVION DE LIGNE</p>
		</div> -->

	
		<?php echo img('parallax4.jpg', 'image vol de jet privé', 'slide slide-one');?>
		<?php echo img('parallax2.jpg', 'image intérieur d\'avion', 'slide slide-two');?>
		<?php echo img('parallax5.jpg', 'image voyage à travers le monde', 'slide slide-three');?>
		<?php echo img('parallax3.jpg', 'image jet privé', 'slide slide-four');?>

	</div>
	
</div>

<!-- FIN DU PREMIER PARALLAX AVEC FORMULAIRE -->



<!-- CONTENU GENERAL -->

<!-- PREMIER BLOC -->
<div class="container "> 
    <div class="section ">
		<h1 class="center-align"><?= t('home_lang_h1_bloc1') ?></h1>
		<h2 class="center-align"><?= t('home_lang_h2_bloc1') ?></h2>
		<div class="row roparal" style="display: flex; align-items: stretch;">
			<div class="info-block hoverable move-animable col s12 m4" onclick="document.location='<?= base_url('privatejet') ?>'">
				<div class="icon-block">
					<div class="hover-calc">
						<h4 class="center"><?= t('home_lang_btn_bloc1') ?></h4>
					</div>
					<?= img('petite1.jpg', 'affretement jet privé', "photo-petite responsive-img image" )?> 
				</div>
				<h3 class="center"><strong><?= t('home_lang_h3_bloc1_1') ?></strong></h3>
				<p class="light"><?= t('home_lang_p_bloc1_1') ?></p>
			</div>
			<div class="info-block hoverable col s12 m4" onclick="document.location='<?= base_url('group') ?>'">
				<div class="icon-block">
					<div class="hover-calc">
						<h4 class="center"><?= t('home_lang_btn_bloc1') ?></h4>
					</div>
					<?= img('petite2.jpg', 'affretement avion commercial', "photo-petite responsive-img image" )?> 
				</div>
				<h3 class="center"><strong><?= t('home_lang_h3_bloc1_2') ?></strong></h3>
				<p class="light"><?= t('home_lang_p_bloc1_2') ?></p>
			</div>

			<div class="info-block hoverable col s12 m4" onclick="document.location='<?= base_url('group') ?>'">
				<div class="icon-block">
					<div class="hover-calc">
						<h4 class="center"><?= t('home_lang_btn_bloc1') ?></h4>
					</div>
					<?= img('petite3.jpg', 'affretement vol groupe sport', "photo-petite responsive-img image" )?> 
				</div>
				<h3 class="center"><strong><?= t('home_lang_h3_bloc1_3') ?></strong></h3>
				<p class="light"><?= t('home_lang_p_bloc1_3') ?></p>
			</div>
		</div>
    </div>
</div>
<!-- FIN PREMIER BLOC -->



<!-- DEUXIEME BLOC -->
<div>
	<div class="container " style="padding-bottom:4rem;;">
		<div class="row">
			<div class="center-align col s8 offset-s2">
				<h1 class=""><?= t('home_lang_h1_bloc2') ?></h1>
				<p class><?= t('home_lang_p_bloc2') ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col s6 m3">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons icon-pqmk red-text text-darken-5">&#xE80B;</i></h2>
				<h4 class="center"><?= t('home_lang_content1_bloc2') ?></h4>
			  </div>
			</div>

			<div class="col s6 m3">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons icon-pqmk red-text text-darken-5">&#xE8DC;</i></h2>
				<h4 class="center"><?= t('home_lang_content2_bloc2') ?></h4>

			  </div>
			</div>

			<div class="col s6 m3">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons icon-pqmk red-text text-darken-5">settings</i></h2>
				<h4 class="center"><?= t('home_lang_content3_bloc2') ?></h4>
			  </div>
			</div>
			<div class="col s6 m3">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons icon-pqmk red-text text-darken-5">&#xE1DB;</i></h2>
				<h4 class="center"><?= t('home_lang_content4_bloc2') ?></h4>
			  </div>
			</div>
			
		</div>
	</div>
</div>
<!-- FIN DEUXIEME BLOC -->


<!-- TROISIEME BLOC --> 
<div id="index-banner2" class="parallax-container animationjspar">

    <div class="section no-pad-bot">
        <div class="container">
					   <div class="row">
						   <div class="col s12 center-align animationjs">
							   <div class="col l3 s6 blue-text text-darken-6">
								   <span class="count" data-anim-num="7000">0</span>
								   <p class="txt-js"><?= t('home_lang_bloc3_count1') ?></p>
							   </div>
							   <div class="col l3 s6 blue-text text-darken-6">
								   <span class="count" data-anim-num="10">100</span> 
									<p class="txt-js"><?= t('home_lang_bloc3_count2') ?></p>
							   </div>
							   <div class="col l3 s6 blue-text text-darken-6">
								   <span class="count" data-anim-num="96">0</span>
									<p class="txt-js"><?= t('home_lang_bloc3_count3') ?></p>
							   </div>
							   <div class="col l3 s6 blue-text text-darken-6">
								   <span class="count" data-anim-num="2">100</span>
									<p class="txt-js"><?= t('home_lang_bloc3_count4') ?></p>
							   </div>
						   </div>
					   </div>
		</div>
	</div>
	 <div class="parallax">
		<?php echo img('photo-voyage-8.jpg', 'image vol de jet privé', '');?>
    </div>
</div>

<!-- FIN TROSIEME BLOC -->



<!-- QUATRIEME BLOC -->
<div id="index-banner3" class="parallax-container hide-on-med-and-down">
	<div class="section no-pad-bot">
		<div class="container">

			<div class="row center red-text text-darken-5" style=" background-color: rgba(254, 254, 254, 0.6); padding: 10px;">
				<h1><?= t('home_lang_bloc4_h1') ?></h1>
				<h2><?= t('home_lang_bloc4_p') ?></h2>
			</div>
			<div class="row roparal" style="margin-top:1rem;">
				<div class="col s12 m6 picto-link" onclick="document.location='<?= base_url('fleet/privatejet') ?>'">
					<div class="picto-link-header" style="left:0;">
						<?= img('picto-jet-prive.png', 'location jet privé', 'photo-plus-petite jet responsive-img center' )?>
						<h3 class="center red-text text-darken-5"><strong><?= t('home_lang_bloc4_jet_title') ?></strong></h3>
						<div class="" style="position:relative;min-height: 4rem;">
							<div class="picto-link-content">
								<p><?= t('home_lang_bloc4_jet_content') ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m6 picto-link" onclick="document.location='<?= base_url('fleet/charter') ?>'">
					<div class="picto-link-header" style="right:0;">
						<?= img('picto-avion-ligne.png', 'affretement vol groupe', 'photo-petite responsive-img center' )?>
						<h3 class="center red-text text-darken-5"><strong><?= t('home_lang_bloc4_airliner_title') ?></strong></h3>
						<div class="" style="position:relative;min-height: 4rem;">
							<div class="picto-link-content">
								<p><?= t('home_lang_bloc4_airliner_content') ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="parallax">
		<?php echo img('plan2.png', 'image vol de jet privé', '');?>
	</div>
</div>
<!-- FIN QUATRIEME BLOC -->



<!-- ************ BLOC BLOG ************* -->
<div class="bloc-blog grey lighten-3">
	<div class="container">
		<div class="section" >
			<h1 class="center-align"><?= t('home_lang_bloc5_h1') ?></h1>
			<h2 class="center-align"><?= t('home_lang_bloc5_p') ?></h2>
			<div class="row roparal">
				<h2 class="center-align"><a href="<?= base_url("blog") ?>" class="btn-large white z-depth-4 red-text text-darken-5 waves-effect"><?= t('home_lang_bloc5_blog_btn') ?></a></h2>
				<?php
				foreach ($articles as $articl):
				?>

				<div class="col s12 m6 l4 article_item">
					<div class="card hoverable">
						<div class="card-image tile">
							<?= img($articl->picture_1, 'affretement jet privé', "photoblog" )?>
							<span class="card-title"><?= $articl->$title ?></span>
							<a href="<?= base_url("blog/displayarticle/$articl->id") ?>" class="btn transparent waves-effect waves-light animate-text"><?= t('home_lang_bloc5_read_btn') ?></a>
						</div>
						<div class="card-content">
							<p class="text-transfert"><small><?= t('home_lang_bloc5_date', [$articl->article_date, $articl->category->$category]) ?></small></p>
							<p><?= $articl->$description ?></p>
						</div>
					</div>
				</div>

				<?php
				endforeach; ?>
			</div>
		</div>
	</div>
</div>
<!-- ************ FIN BLOC BLOG ************* -->



<!-- BLOC THEY TRUST US -->
<div class="partners grey lighten-2"  style="padding-top:5rem; padding-bottom: 3rem; margin-bottom: 0;">
    <div class="container">
		<div class="row">
		   		
			<h1 class="center-align"><?= t('home_lang_bloc6_h1') ?></h1>
			<div class="col l12 s12 logo-partners center-align" style="margin-top:4rem; margin-bottom: 3rem;">
				<div class="log-part col s2">
					<?= img('/partners/avinode_logo_140.png', 'partner mkpartnair', "photo-petite height-limit" )?> 
				</div>
				<div class="log-part col s2">
					<?= img('/partners/logo_aeroports_de_paris1.gif', 'partner mkpartnair', "photo-petite height-limit" )?> 
				</div>

				<div class="log-part col s2">
					<?= img('/partners/Wyvern.png', 'partner mkpartnair', "photo-petite height-limit" )?>
				</div>
				<div class="log-part col s2">
					<?= img('/partners/nouveau-logo-seine-saint-denis.jpg', 'partner mkpartnair', "photo-petite height-limit" )?>
				</div>

				<div class="log-part col s2">
					<?= img('/partners/michelin.png', 'partner mkpartnair', "photo-petite height-limit" )?>
				</div>

				<div class="log-part col s2">
					<?= img('/partners/psa.jpg', 'partner mkpartnair', "photo-petite height-limit" )?>
				</div>
	   		</div>
		</div>
    </div>
</div>
<!-- FIN BLOC THEY TRUST US -->
