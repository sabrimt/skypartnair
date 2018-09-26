<section class="row liste-flotte">
	<div class="row">
		<div class="col s10 offset-s1">
			<h1>Gestion FLOTTE </h1>
			<p>Ajouter un nouvel avion, créer un constructeur, modifier, supprimer les caractériques et les photos d'avions existants...</p>
		</div> 
	</div>
    <div class="col s10 offset-s1">
		<?php
		if(!(isset($action) && $action == 'Ajout')){
			echo $add_btn??'';
		}
		$s = "";
		if (empty($aircrafts)) {
			?> 
		<h3><strong>Pas de Flotte.</strong></h3>
			<?php } else {
			if ($nb_aircrafts > 1) {
				 $s ="s";
			}
			echo anchor('mkadmin/option/', 'Gestion des options', array("class" => "btn grey"));
			?> 
		<h3><strong><?= $nb_aircrafts ?> appareil<?=$s?> enregistré<?=$s?></strong></h3>
		<table class="stripped highlight centered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Photos</th>
					<th>Constructeur</th>
					<th>Model</th>
					<th>Type</th>
					<th>Catégorie</th>
					<th>Passagers max</th>
					<th>Vitesse max</th>
					<th>Autonomie</th>
					<th>Infos</th>
				</tr>
			</thead>
			<tbody>
            <?php
                foreach ($aircrafts as $aircraft):
			?>
				<tr class="list-elt">
					<td><?= $aircraft->id ?></td>
					<td><a href="<?= base_url("mkadmin/fleet/aircraftmanager/$aircraft->id") ?>"><?= img($aircraft->photo_exter, "photo extérieur", "fleet-preview-img") ?></a></td>
					<td><?= $aircraft->manufacturer->name ?></td>
					<td><a href="<?= base_url("mkadmin/fleet/aircraftmanager/$aircraft->id") ?>"><?= $aircraft->model ?></a></td>
					<td><?= $aircraft->type->type_fr ?></td>
					<td><?= $aircraft->category->category ?></td>
					<td><?= $aircraft->passengers ?></td>
					<td><?= $aircraft->cruise_speed ?></td>
					<td><?= $aircraft->aircraft_range ?></td>
					<td><a href="#modal-details-<?= $aircraft->id ?>" class="modal-trigger blue-grey-text valign-wrapper"><strong><i class='material-icons'>&#xE145;</i> VOIR</strong></a>
					</td>
					<td class="action-btn btn-display">
						<a class="edit-btn material-icons blue-grey-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Modifier"
						   href="<?= base_url("mkadmin/fleet/aircraftmanager/$aircraft->id") ?>">&#xE3C9;</a>
						<a class="confirm-delete-btn material-icons deep-orange-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Supprimer"
						   href="" data-link="<?= base_url("mkadmin/fleet/deleteaircraft/$aircraft->id") ?>">&#xE872;</a>
					</td>
						
				</tr>
				
				<!--	MODAL   -->
				<div id="modal-details-<?= $aircraft->id ?>" class="modal col s8  modal-fixed-footer">
					<div class="modal-content">
						<h2 class="h2_modal-details center-align blue-grey-text"><?= $aircraft->manufacturer->name . ' ' .$aircraft->model ?></h2>
						<div class="row pictures_modal">
							<div class="col s3">
								<h4 class="center-align"><strong>Photo extérieur</strong></h4>
								<?= img($aircraft->photo_exter, "photo extérieur", "col s12") ?>
							</div>
							<div class="col s3">
								<h4 class="center-align"><strong>Photo intérieur</strong></h4>
								<?= img($aircraft->photo_inter, "photo intérieur", "col s12") ?>
							</div>
							<div class="col s3">
								<h4 class="center-align"><strong>Photo plan</strong></h4>
								<?= img($aircraft->photo_plan, "photo plan", "col s12") ?>
							</div>
							<div class="col s3">
								<h4 class="center-align"><strong>Photo bonus</strong></h4>
								<?= img($aircraft->photo_bonus, "photo bonus", "col s12") ?>
							</div>
						</div>
						<div class="row type-infos">
							<div class="col s5 right-align">
								<h4><strong>Type Français</strong></h4>
								<p><?= $aircraft->type->type_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Type</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Type Anglais</strong></h4>
								<p><?= $aircraft->type->type_en ?></p>
							</div>
						</div>
						<div class="row crew-infos">
							<div class="col s5 right-align">
								<h4><strong>Équipage Français</strong></h4>
								<p><?= $aircraft->crew->crew_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Équipage</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Équipage Anglais</strong></h4>
								<p><?= $aircraft->crew->crew_en ?></p>
							</div>
						</div>
						<div class="row description-infos">
							<div class="col s5 right-align">
								<h4><strong>Description Français</strong></h4>
								<p><?= $aircraft->description_fr ?></p>
							</div>
							<div class="col s2 center blue-grey-text">
								<h3><strong>Description</strong></h3>
							</div>
							<div class="col s5">
								<h4><strong>Description Anglais</strong></h4>
								<p><?= $aircraft->description_en ?></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					  <a href="#!" class="modal-action modal-close waves-effect waves-grey btn-flat">FERMER</a>
					</div>
				</div>
				<!--	END MODAL   -->
					
			<?php endforeach; }?>
			</tbody>
		</table>
    </div>
</section>