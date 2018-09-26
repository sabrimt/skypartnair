<section class="row">
    <h1 class="col s8 offset-s1 center"><?= $action ?> d'articles</h1>
    <div class="row">
        <?= validation_errors("<em class='block red lighten-4 red-text col s8 offset-s2 valign-wrapper'><i class='material-icons red-text left valign-center' style='font-size: 1.2rem;'>error</i>", "</em>") ?>
    </div>
    <?= form_open_multipart('', array('class' => 'sale-form appear-form col s12')) ?>
        <div class="row" style="margin-bottom: 1px;">
            <div class="col s12 l5 offset-l1"> <!-- PREMIERE COLONNE -- >
                <!-- Champs TITRE FR -->
                <div class="input-field valign-wrapper">
                    <i class="material-icons prefix">&#xE838;</i>
                    <?= form_label("Titre de l'article FR", "title_fr", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
                        . form_input(array(
                        "name"	=>"title_fr",
                        "id"	=>"title_fr",
                        "value"	=> !isset($single_article) ?
                                set_value('title_fr') :
                                $single_article->title_fr,
                        "class"	=>"validate",
                        "required" =>"required")) ?>
                </div>
                <!-- Champs TITRE EN -->
                <div class="input-field valign-wrapper">
                    <i class="material-icons prefix">&#xE838;</i>
                    <?= form_label("Article title EN", "title_en", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
                        . form_input(array(
                        "name"	=>"title_en",
                        "id"	=>"title_en",
                        "value"	=> !isset($single_article) ?
                                set_value('title_en') :
                                $single_article->title_en,
                        "class"	=>"validate",
                        "size"	=>"100")) ?>
                </div>
            </div>
            <div class="col s12 l5">
                <div class="input-field valign-wrapper">
                    <!-- SELECTION DE LA CATEGORIE  -->
                    <i class="material-icons prefix">&#xE616;</i>
                    <select name="article_category_id" id="categorie" class="target">
                    <option disabled selected>Choix de la catégorie
                    <?php foreach ($category_list as $category): ?>
                    <option class="cat-option" value="<?= $category->id?>"
                    <?= isset($single_article)&&$single_article->article_category_id==$category->id?"selected":"" ?>
                    <?= set_select('article_category_id', $category->id) ?> data-olive="<?= $category->category_fr . ' / ' . $category->category_en ?>"> <?= $category->category_fr . ' / ' . $category->category_en ?> 
                    </option>
                    <?php
					endforeach; ?>
                    </select>
                </div>
			</div>
		</div>
		 <div class="row" style="margin-bottom: 1px;">
            <div class="col s12 l5 offset-l1"> <!-- PREMIERE COLONNE -- >
                <!-- Champs DESCRIPTION FR -->
                <div class="input-field valign-wrapper">
                    <i class="material-icons prefix">&#xE838;</i>
                    <?= form_label("Description courte FR", "description_fr", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
                        . form_input(array(
                        "name"	=>"description_fr",
                        "id"	=>"description_fr",
                        "value"	=> !isset($single_article) ?
                                set_value('description_fr') :
                                $single_article->description_fr,
                        "class"	=>"validate",
                        "required" =>"required")) ?>
                </div>
			</div>
			 <div class="col s12 l5"> <!-- PREMIERE COLONNE -- >
                <!-- Champs DESCRIPTION EN -->
                <div class="input-field valign-wrapper">
                    <i class="material-icons prefix">&#xE838;</i>
                    <?= form_label("Short description EN", "description_en", ["class"=>"active", "data-error"=>"wrong", "data-success"=>"right"])
                        . form_input(array(
                        "name"	=>"description_en",
                        "id"	=>"description_en",
                        "value"	=> !isset($single_article) ?
                                set_value('description_en') :
                                $single_article->description_en,
                        "class"	=>"validate",
                        "size"	=>"100")) ?>
                </div>
            </div>
		 </div>
	
		
		<div class="row" style="margin-bottom:0;">
			<div class="col s12 l10 offset-l1" style="margin-bottom: 2rem;">	
				<div class="input-field valign-wrapper">
					<i class="material-icons prefix">&#xE3B0;</i>
						<a class="valign-wrapper photos-collapse" style="margin-left: 3rem;" href="">Photos Article<i class="material-icons">&#xE5C5;</i></a>
				</div>
				<?php if( isset($upload_errors)): ?>
				<div>
					<strong><?= $upload_errors ?></strong>
				</div>
				<?php endif; ?>
				<div class="photos-formbloc"  hidden="hidden">
					<div class="row">
						<!-- Image actuelle -->
						<div class="col s6 valign-wrapper">
							<?php
							$col_1 = "12";
							if(isset($single_article) && !empty($single_article->picture_1)):
								$col_1 = "9";
							?>
								<img class="col s3" id="picture1_mod" src="<?= base_url('/assets/img/' . $single_article->picture_1) ?>" alt="preview">
							<?php endif; ?>

							<!-- Champs file images -->
							<div class="file-field input-field col s<?= $col_1 ?>">
								<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
									<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
									<?= form_upload(array(
										"id"=>"picture_1", 
										"name"=>"picture_1")) ?>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Photo Principale">
								</div>
							</div>
						</div>
						<!-- Image actuelle -->
						<div class="col s6 valign-wrapper">
							<?php
							$col_2 = "12";
							if(isset($single_article) && !empty($single_article->picture_2)):
								$col_2 = "9";
							?>
								<img class="col s3" src="<?= base_url('/assets/img/' . $single_article->picture_2) ?>" alt="preview">
							<?php endif; ?>

							<div class="file-field input-field col s<?= $col_2 ?>">
								<div class="btn red darken-4" style="padding-left: 1.2rem;padding-right: 1.2rem;">
									<i class="material-icons" style="font-size: 1.5rem;">&#xE226;</i>
									<?= form_upload(array("id"=>"picture_2", "name"=>"picture_2")) ?>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Photo Bonus">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div> <!-- FIN ROW  -->

    <div class="row">
        <div class="col s10 offset-s1">
            <i class="material-icons">&#xE150;</i> <span>Contenu Article FR </span>
            <br/>
            <div class="input-field">
                <?= form_label("", "content_fr") . form_textarea(array(
                    "name" => "content_fr",
                    "id" => "content_fr",
                    "class" => "tinyblog",
                ), html_entity_decode( !isset($single_article) ? set_value('content_fr') : $single_article->content_fr)); ?>
            </div>
        <br/>
        </div>
    </div>
    <div class="row">
        <div class="col s10 offset-s1">
            <i class="material-icons">&#xE150;</i> <span>Article Content EN </span>
            <br/>
            <div class="input-field">
                <?= form_label("", "content_en") . form_textarea(array(
                    "name" => "content_en",
                    "id" => "content_en",
                    "class" => "tinyblog",
                ), html_entity_decode( !isset($single_article) ? set_value('content_en') : $single_article->content_en)); ?>
            </div>
        </div>
    </div>
		
<!-- Modal Structure FR-->
<div id="modal1" class="modal">
  <div class="modal-content">
	<div id="picture1_modal"></div>
    <h1 id="h1_modal"></h1>
	<h5> Publié le <strong><script> var maintenant=new Date(); var jour=maintenant.getDate(); var mois=maintenant.getMonth()+1; var an=maintenant.getFullYear(); document.write("",jour,"/",mois,"/",an,"");</script></strong></h5>
	<h5 style="display:inline;">Catégorie : </h5> <h5 style="display:inline;"id="h4_categorie"><strong> </strong></h5>
	<hr/>
    <p id="p_content_fr" style="line-height: 5rem !important;"></p>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
  </div>
</div>
<!-- Modal Structure EN-->
<div id="modal2" class="modal">
  <div class="modal-content">
    <h1 id="h1_modal_en"></h1>
	<h5> Publié le <strong><script> var maintenant=new Date(); var jour=maintenant.getDate(); var mois=maintenant.getMonth()+1; var an=maintenant.getFullYear(); document.write("",mois,"/",jour, ",", " ",an,"");</script></strong></h5>
	<h4 id="h4_categorie_en"> </h4>
    <p id="p_content_en"></p>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
  </div>
</div>

	<div class="row">
		<div class="col s5">
	<!-- Modal Trigger -->
		<a class="modal-trigger waves-effect waves-light btn red darken-1 previewbtn" href="#modal1"> APERÇU FR </a>
		<a class="modal-trigger waves-effect waves-light btn red lighten-2 previewbtn" href="#modal2">PREVIEW EN </a>
		</div>
		<div class="col s7">
	<!-- enregistrer ou annuler -->
        <button class="btn waves-effect waves-light red darken-4 right" type="submit" name="save">
            Enregistrer
        </button>
            <?= anchor('mkadmin/blog/', 'RETOUR À LA LISTE', array("class" => "cancel-btn btn grey darken-1 right")); ?>
    <?= form_close() ?>
		</div>
	</div>
</section>
