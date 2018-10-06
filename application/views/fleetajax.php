<?php
$lng = $this->lang->lang();
$crew_lg = 'crew_'.$lng;
$type_lg = 'type_'.$lng;


if(is_array($aircrafts) && !empty($aircrafts)):
?>
	<ul class="list-container">
			<?php $s = $nb_aircrafts === 1 ? '' : 's'; ?>
			<h4><?= t('fleet_lang_item_count_txt', [$nb_aircrafts, $s]) ?></h4>
            <?php 
            foreach ($aircrafts as $aircraft):
				$type_class = strtolower($aircraft->type->type_en) === "private jet" ? ' jet-type ': ' charter-type ';
            ?>
            <li class="row valign-wrapper grey lighten-3 fleet-item hoverable">
				<div class="col s4 fleet-manu">
					<div class="col s6">
						<?= img('flag/'.$aircraft->manufacturer->flag, $aircraft->manufacturer->flag . ' flag', "min-fleet-flag") ?>
						<span><?= $aircraft->manufacturer->name ?></span>
					</div>
					<div class="col s6 center">
						<span><?= $aircraft->model ?></span>
					</div>
                </div>
				<div class="col s3 fleet-type-container center">
					<?= img($aircraft->photo_bonus, $aircraft->type->$type_lg, "center rcrft-type-img$type_class") ?>
					<div class="fleet-img-pop hoverable" onclick="document.location='<?= base_url('fleet/showAircraft/'.$aircraft->id) ?>'">
						<span class="arrow"></span>
						<?= img($aircraft->photo_exter, '', "") ?>
						<i class="material-icons">&#xE8B6;</i>
					</div>
				</div>
				<div class="col s2 center">
					<small class="info-legend"><?= t('fleet_lang_item_range'); ?></small>
					<i class="material-icons">&#xE192;</i>
					<strong><?= $aircraft->aircraft_range ?></strong>
				</div>
				<div class="col s2 center">
					<small class="info-legend"><?= t('fleet_lang_item_capacity'); ?></small>
					<i class="material-icons">&#xE7EF;</i>
					<strong><?= $aircraft->passengers ?></strong>
				</div>
				<div class="right-align right col s2">
					<a class="btn waves-effect waves-light blue darken-5 wite-text" href="<?= base_url("fleet/showAircraft/" . $aircraft->id) ?>" style="padding-left: 1.2rem; padding-right: 1.2rem;"><?= t('fleet_lang_item_detail_btn'); ?></a>
				</div>
            </li>
            <?php endforeach; ?>
        </ul>
<?php else: ?>
	<h3 class="col s12 center"><?= t('fleet_lang_item_no_item'); ?></h3>
<?php endif; ?>