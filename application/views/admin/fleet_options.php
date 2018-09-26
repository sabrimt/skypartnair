<section>
	<div class="row">
			<?= anchor('mkadmin/fleet/', 'RETOUR À LA FLOTTE', array("class" => "cancel-btn btn grey darken-1", "style" => "margin-left: 5%")) ?>
	</div>
	<div class="row">
		<div class="col l4">
			<div class="col s11 offset-s1">
				<!-- Options list -->
				<div class="row options-list">
					<legend class="flow-text"><strong>CONSTRUCTEURS</strong></legend>
					<?= anchor('mkadmin/option/optionmanager/manufacturer', '<i class="black-text material-icons left" style="font-size: 1.5rem;">&#xE146;</i><strong>AJOUTER</strong>'); ?>
					<table class="stripped highlight centered responsive-table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Constructeur</th>
								<th>Image Nation</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($manufacturers as $manufacturer): ?>
							<tr class="list-elt">
								<td><?= $manufacturer->id ?></td>
								<td><?= $manufacturer->name ?></td>
								<td><img style="max-height: 2rem" src="<?= base_url("assets/img/flag/$manufacturer->flag") ?>"></td>
								<td class="action-btn btn-display">
									<a class="edit-btn material-icons blue-grey-text tooltipped"
									   data-position="left" data-delay="40" data-tooltip="Modifier"
									   href="<?= base_url('mkadmin/option/optionmanager/manufacturer/' . $manufacturer->id) ?>">&#xE3C9;</a>
									<a class="confirm-delete-btn material-icons deep-orange-text tooltipped" 
									   data-position="left" data-delay="40" data-tooltip="supprimer" 
									   href="" data-link="<?= base_url("mkadmin/option/deleteoption/manufacturer/$manufacturer->id") ?>">&#xE872;</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col l4">
			<div class="col s11 offset-s1">
				<!-- Options list -->
				<div class="row options-list">
					<legend class="flow-text"><strong>TYPES D'ÉQUIPAGES</strong></legend>
					<?= anchor('mkadmin/option/optionmanager/crew', '<i class="black-text material-icons left" style="font-size: 1.5rem;">&#xE146;</i><strong>AJOUTER</strong>'); ?>
					<table class="stripped highlight centered responsive-table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Équipage FR</th>
								<th>Équipage EN</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach($crews as $crew): ?>
							<tr class="list-elt">
								<td><?= $crew->id ?></td>
								<td><?= $crew->crew_fr ?></td>
								<td><?= $crew->crew_en ?></td>
								<td class="action-btn btn-display">
									<a class="edit-btn material-icons blue-grey-text tooltipped" data-position="left" data-delay="40" data-tooltip="Modifier" href="<?= base_url('mkadmin/option/optionmanager/crew/' . $crew->id) ?>">&#xE3C9;</a>
									<a class="confirm-delete-btn material-icons deep-orange-text tooltipped" data-position="left" data-delay="40" data-tooltip="supprimer" href="" data-link="<?= base_url("mkadmin/option/deleteoption/crew/$crew->id") ?>">&#xE872;</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col l4">
			<div class="col s10 offset-s1">
				<!-- Options list -->
				<div class="row options-list">
					<legend class="flow-text"><strong>CATÉGORIES</strong></legend>
				<?= anchor('mkadmin/option/optionmanager/category', '<i class="black-text material-icons left" style="font-size: 1.5rem;">&#xE146;</i><strong>AJOUTER</strong>'); ?>
					<table class="stripped highlight responsive-table centered">
						<thead>
							<tr>
								<th>Id</th>
								<th>Catégorie</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach($categories as $category): ?>
							<tr class="list-elt">
								<td><?= $category->id ?></td>
								<td><?= $category->category ?></td>
								<td class="action-btn btn-display">
									<a class="edit-btn material-icons blue-grey-text tooltipped" data-position="left" data-delay="40" data-tooltip="Modifier" href="<?= base_url('mkadmin/option/optionmanager/category/' . $category->id) ?>">&#xE3C9;</a>
									<a class="confirm-delete-btn material-icons deep-orange-text tooltipped" data-position="left" data-delay="40" data-tooltip="supprimer" href="" data-link="<?= base_url("mkadmin/option/deleteoption/category/$category->id") ?>">&#xE872;</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</section>
