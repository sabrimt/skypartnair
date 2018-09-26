<?php
($item == 'vente' || $item == 'option') ? $e = "e" : $e ="";
($item == 'vente') ? $pre = "La " : $pre ="L'";
?>
<section class="col l8 offset-l2">
	<div class="form-success green lighten-4 valign-wrapper" style="height: 5rem; border: 0.1rem solid #81c784; margin-top: 1rem; width: 82%; margin: 0 auto; margin-bottom: 1.5rem;">
		<h3 class='success-text' style="margin:0 auto;"><strong><?= $pre . $item ?> "<?= $entry_label ?>" a été enregistré<?= $e ?> avec succès</strong></h3>
	</div>
	<div style="margin-left: 9%;">
		<?= $back_btn ?>
	</div>
</section>