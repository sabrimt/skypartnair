<section>
    
    <div class="row">
		<div class="col l10 offset-l2 s12 ">
		<h1 class="red-text text-darken-5">IDENTIFICATION</h1>
		</div>
		<h3 class="center-align"><em class='block red-text text-darken-4'><?= $login_error??"" ?></em></h3>
		<?= validation_errors("<em class='block red lighten-4 red-text text-darken-4 valign-wrapper col l4 offset-l4 m8 offset-m2'><i class='material-icons left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
		<?= form_open_multipart('', array('class' => 'appear-form col l4 offset-l2 m8 offset-m2 s12')) ?>
			
			<div class="input-field valign-wrapper">
				<?= form_label("IDENTIFIANT", "email", ["class"=>"active"])
				. form_input(array(
					"name"		=>"email",
					"id"		=>"email",
					"class"		=>"validate",
					"value"		=> set_value('email'),
				)) ?>
			</div>
			<div class="input-field valign-wrapper">
				<?= form_label("MOT DE PASSE", "password", ["class"=>"active"])
				. form_input(array(
					"name"		=>"password",
					"id"		=>"password",
					"type"		=>"password",
					"class"		=>"validate",
					"value"		=> set_value('model'),
				)) ?>
			</div>
            
		<button class="btn waves-effect waves-light grey darken-4 right" type="submit" name="login">Connexion</button>
        <?= form_close() ?>
    </div>
</section>