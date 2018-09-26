<section class="row">

    <h1 class="col s8 offset-s2 center"><?= $action ?> d'utilisateur</h1>
    <div class="row">
        <?= validation_errors("<em class='block red lighten-4 red-text col s8 offset-s2 valign-wrapper'><i class='material-icons red-text left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
    </div>
    <?= form_open('', array('class' => 'usradd-form appear-form col s10 offset-s1')) ?>
        <div class="row">
            <div class="col s12 l6">
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE7FD;</i>
                    <?= form_label("Nom", "name", ["class"=>"active"])
					. form_input(array(
						"name"	=>"name",
						"id"	=>"name",
						"value"	=> set_value('name'),
						"class"	=>"validate",
						"size"	=>"100")) ?>
                </div>
                <div class="input-field valign-wrapper">
				<i class="material-icons prefix">&#xE0BE;</i>
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
				<legend>ATTRIBUER LES DROITS UTILISATEUR</legend>
				<p><small>"ADMIN" attribue tous les droits. "USER" ne permet pas de gérer les utilisateurs</small></p>
				<div class="switch center">
					<label>
						USER
						<input type="checkbox" name="role">
						<span class="lever"></span>
						ADMIN
					</label>
				</div>
            </div>
            <div class="col s12 l6">
                <!-- PASSWORD -->
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE897;</i>

                    <?= form_label("Mot de passe", "password", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=> "password",
						"id"		=> "password",
						"class"		=> "validate",
						"min-length"=> "8",
						"type"		=> "password")) ?>
                </div>
                <div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE897;</i>

                    <?= form_label("Confirmer mot de passe", "password-confirm", ["class"=>"active", "data-error"=>"wrong"])
					. form_input(array(
						"name"		=> "password-confirm",
						"class"		=> "validate",
						"min-length"=> "8",
						"type"		=> "password")) ?>
                </div>
				<small>Attribuer un mot de passe par défaut, puis laisser l'utilisateur remplacer avec un mot de passe d'au moins 8 caractères. N'hésitez pas à utiliser des majuscules, des chiffres et même des caractères spéciaux pour plus de sécurité. </small>
            </div>
        </div>
        <button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save">
			Enregistrer
        </button>
		<?= anchor('mkadmin/user/', 'Retour à la liste', array("class" => "cancel-btn right btn grey darken-1")); ?>
    <?= form_close() ?>
</section>
