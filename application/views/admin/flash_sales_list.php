<section class="row liste-ventes">
	<div class="row">
		<div class="col s10 offset-s1 ">
			<h1>Gestion VENTES FLASH </h1>
			<p>Ajouter et supprimer facilement vos ventes flash...</p>
		</div> 
	</div>
    <div class="col s10 offset-s1">
		<?php
		if(!(isset($action) && $action == 'Ajout')){
			echo $add_btn??'';
		}
		$s = "";
		if (empty($sales)) {
			?> 
		<h3><strong>Pas de Vente Flash en cours.</strong></h3>
			<?php } else {
			if ($nb_sale>1) {
				 $s ="s";
			}
			?> 
		<h3><strong><?= $nb_sale ?> vente<?=$s?> flash disponible<?=$s?></strong></h3>
		<table class="stripped highlight centered responsive-table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Départ</th>
					<th>Arrivée</th>
					<th>Disponibilité</th>
					<th>Capacité</th>
					<th>Prix</th>
					<th>Avion</th>
				</tr>
			</thead>
			<tbody>
            <?php
                foreach ($sales as $sale):
                $dispo_complete = $sale->to_date != $sale->from_date && $sale->to_date != "" ? "Du " . $sale->from_date . " au " . $sale->to_date : "Le " . $sale->from_date;
			?>
				<tr class="list-elt">
					<td><?= $sale->id ?></td>
					<td><?= $sale->departure ?></td>
					<td><?= $sale->arrival ?></td>
					<td><?= $dispo_complete ?></td>
					<td><?= $sale->capacity ?></td>
					<td><?= "€ " . $sale->price ?></td>
					<td><?= $sale->fleet->manufacturer->name . ' ' .  $sale->fleet->model ?></td>
					<td class="action-btn btn-display">
						<a class="edit-btn material-icons blue-grey-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Modifier"
						   href="<?= base_url("mkadmin/flash/salesmanager/$sale->id") ?>">&#xE3C9;</a>
						<a class="confirm-delete-btn material-icons deep-orange-text tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Supprimer"
						   href="" data-link="<?= base_url("mkadmin/flash/deletesale/$sale->id") ?>">&#xE872;</a>
					</td>
						
				</tr>
			<?php endforeach; }?>
			</tbody>
		</table>
    </div>
</section>