<!DOCTYPE html>

<html lang="fr">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=<?= $charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title><?= $title ?></title>
	<link rel="icon" type="image/x-icon" href="<?= img_url("mkicon.ico") ?>" />
	<!-- JS TINY -->
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m8v86vyf9556aof4u4j6k2l3d8onskd53g7y6vi1f9upnfva"></script>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?= css_url("materialize", "screen,projection") ?>
    <?= css_url("style", "screen,projection") ?>
    <?= css_url("dashboard", "screen,projection") ?>
    <?php foreach($css as $url): echo $url."\n"; endforeach; ?>
</head>

<body>
<!--      NAVBAR      -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="grey darken-4">
                    <div class="nav-wrapper logodashfull" style="margin-left:0.45rem;"><?= img('logomini.jpg', '', 'responsive-img logo-admin' )?>
                    <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only right fixed"><i class="material-icons white-text">menu</i></a>
					<?php if($this->auth_user->is_connected) : ?>
					<p class="grey-text text-lighten-1 right" style="margin-right: 8rem;">Bienvenue <a href="<?= base_url('mkadmin/user/edituser/'.$this->auth_user->id) ?>" class="grey-text text-lighten-2"><strong><?= $this->auth_user->name . ' | ' ?></strong><?= $this->auth_user->email ?></a></p>
					<?php endif; ?>
                    </div>
                    <div class="nav-wrapper logodashmob"><?= img('logo.jpg', '', 'responsive-img logo-admin' )?>
						<a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only right fixed">
							<i class="material-icons white-text">menu</i>
						</a>
                    </div>
            </nav>
        </div>
		
        <!-- START LEFT SIDEBAR NAV-->
<?php if($this->auth_user->is_connected) : ?>
        <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed">
                        <li class="bold grey darken-3 dash-menu-li-up"><a href="<?= base_url('mkadmin/dashboard') ?>" class="waves-effect waves-cyan white-text"><i class="material-icons white-text">home</i> TABLEAU DE BORD</a>
                        </li>
                        <li class="bold grey darken-3 dash-menu-li-up"><a href="<?= base_url('/') ?>" class="waves-effect waves-cyan white-text"><i class="material-icons white-text">visibility</i> VOIR LE SITE</a></li>
                        <li class="bold grey darken-3 dash-menu-li-up"><a href="<?= base_url('mkadmin/dashboard/deconnexion') ?>" class="waves-effect waves-cyan white-text"><i class="material-icons white-text">power_settings_new</i> SE DECONNECTER</a></li>
                        <li class="bold dash-menu-li-down center"><a href="<?= base_url('mkadmin/flash') ?>" class="waves-effect waves-cyan adashdown">VENTES FLASH</a>
                        </li>

                        <li><div class="divider dashdivi"></div></li>
                        <li class="bold dash-menu-li-down center"><a href="<?= base_url('mkadmin/fleet') ?>" class="waves-effect-cyan adashdown">FLOTTE</a>
                        </li>

                        <li><div class="divider dashdivi"></div></li>
                        <li class="bold dash-menu-li-down center"><a href="<?= base_url('mkadmin/blog') ?>" class="waves-effect waves-cyan adashdown">BLOG</a>
                        </li>
                        <li><div class="divider dashdivi"></div></li>
						<?php if($this->auth_user->is_ADMIN) : ?>
                        <li class="bold dash-menu-li-down center"><a href="<?= base_url('mkadmin/user') ?>" class="waves-effect waves-cyan adashdown">UTILISATEURS</a>
                        </li>
                        <li><div class="divider dashdivi"></div></li>
						<?php endif; ?>
                </ul>
        </aside><?php endif; ?>
		<!-- END LEFT SIDEBAR NAV-->
    </header>

	<!-- END HEADER -->

	<main id="main-content">
		<?= $output ?>
	</main>

    <script
    src="https://code.jquery.com/jquery-3.1.1.js"integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="crossorigin="anonymous"></script>
    <script src="<?= js_url('jquery-3.2.1') ?>"></script>
    <script src="<?= js_url('materialize') ?>"></script>
    <script src="<?= js_url('init') ?>"></script>
    <script src="<?= js_url('dashboard') ?>"></script>

    <?php foreach ($js as $url): ?>
        <script src="<?= $url ?>"></script>
    <?php endforeach; ?>
</body>
</html>