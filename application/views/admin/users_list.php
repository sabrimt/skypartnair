<section class="row liste-utilisateurs">
	<div class="row">
		<div class="col s10 offset-s1 ">
			<h1>Gestion Utilisateurs </h1>
			<p>Ajouter et supprimer facilement les utilisateurs MKPartnair et modifier leurs droits...</p>
		</div>
		<h3 class="success-flash-msg blue lighten-7 center z-depth-3">
			<?= $session['role-update']??"" ?>
		</h3>
	</div>
    <div class="col s10 offset-s1">
		<?php
		if(!(isset($action) && $action == 'Ajout')){
			echo $add_btn??'';
		}
		$s = "";
		if (empty($users)) {
			?> 
		<h3><strong>Pas d'utilisateurs.</strong></h3>
			<?php } else {
			if ($nb_usr>1) {
				 $s ="s";
			}
			?> 
		<h3><strong><?= $nb_usr ?> utilisateur<?=$s?> enregistré<?=$s?></strong></h3>
		<table class="stripped highlight centered responsive-table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Email</th>
					<th>Dernière connexion</th>
					<th>Rôle</th>
				</tr>
			</thead>
			<tbody>
            <?php
                foreach ($users as $user):
			?>
				<tr class="list-elt">
					<td><?= $user->id ?></td>
					<td><?= $user->name ?></td>
					<td><?= $user->email ?></td>
					<td><?= $user->last_connection ?></td> 
					<td style="position: relative;">
						 <?= form_open('', array('class' => 'role-switch')) ?>
						<div class="switch center">
							<label>
								USER
								<input type="checkbox" name="role-check" 
									<?= $user->role === "ADMIN"?"checked":"" ?> 
									<?= $user->id != $this->auth_user->id ? "" : "disabled"; ?>
									class="role-check-btn">
								<span class="lever"></span>
								ADMIN
							</label>
						</div>
						<?php if($user->id != $this->auth_user->id): ?>
						<button type="submit" name="rolesave" 
								class="check-submit btn btn-floating pulse red darken-5 tooltipped" value="<?= $user->id ?>" 
								data-position="left" data-delay="40" data-tooltip="Enregistrer" >
							<i class="material-icons">&#xE161;</i>
						</button>
						<?php endif; ?>
						<?=	form_close() ?>
					</td>
					<td class="action-btn btn-display">
						<?php if($user->role !== "ADMIN"): ?>
						<a class="confirm-delete-btn material-icons deep-orange-text text-darken-3 tooltipped"
						   data-position="left" data-delay="40" data-tooltip="Supprimer"
						   href="" data-link="<?= base_url("mkadmin/user/deleteuser/$user->id") ?>">&#xE872;</a>
						<?php endif; ?>
					</td>
						
				</tr>
			<?php endforeach; }?>
			</tbody>
		</table>
    </div>
</section>