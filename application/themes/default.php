<!DOCTYPE html>
<html lang="<?= $lng =  $this->lang->lang(); ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= $charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?= $title ?></title>
	<link rel="icon" type="image/x-icon" href="<?= img_url("mkicon.ico") ?>" />

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
    <?= css_url("materialize", "screen,projection") ?>
    <?= css_url("style", "screen,projection") ?>
    <?php foreach($css as $url): echo $url."\n"; endforeach; 
		$active = " crtactive ";
		$crturl = $this->uri->segment(0);
        
        // Calling blog categories from ArticleCategory_model
        $cat_title = 'category_'.$lng;

        $article_categories = $this->ArticleCategory_model->categoryList($cat_title);
	?>
</head>
<body>
<!-- ********************************************* DEBUT NAVBAR ************************************************** -->
    <div class="navbar-fixed" id="navprincipal"><!-- DEBUT NAVBAR FIXED -->
        <nav class="white" role="navigation"><!-- DEBUT NAV -->
            <div class="nav-wrapper container "><!-- DEBUT DIV NAV CONTAINER -->
                <div class="row rowlogo"><!-- DEBUT ROW -->
                    <div class="left col s3 bloclogo"><!-- DIV LOGO -->
                        <span id="logo-container" class="left brand-logo logopic" >
                            <a  href="<?= site_url(); ?>"><?= img('logo.jpg', 'sky partnair affretement d\'avion', 'responsive-img' )?> </a>
                        </span>
                    </div><!-- FIN DIV LOGO -->
                    
                    <div class="col s9 blocmenunav"><!-- DIV BLOC MENU NAV -->
                        <ul class="center hide-on-med-and-down"><!-- DEBUT UL PRINCIPAL NAV -->
                            <li>
                                <a class="dropdown-button <?= $crturl == "privatejet" ? $active : "" ?>" href="<?= site_url("privatejet/") ?>" data-activates="jetpri1" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400><?= t("default_layout_nav_private_jet") ?></a>
                            </li>
								<ul id="jetpri1" class="dropdown-content">
                                    <li><a href="<?= site_url("privatejet/freequote") ?>"><?= t("default_layout_nav_free_quote") ?></a></li>
                                    <li><a href="<?= site_url("privatejet/") ?>"><?= t("default_layout_nav_jet_advantages") ?></a></li>
                                    <li><a href="#!">SKY JET CARD</a></li>
                                    <li><a href="#!">FAQ</a></li>
								</ul>
                            <li>
                                <a class="dropdown-button <?= $crturl == "group" ? $active : "" ?>" href="<?= site_url("group/") ?>" data-activates="volgrou1" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400><?= t("default_layout_nav_group_flights") ?></a>
                            </li>
                                <ul id="volgrou1" class="dropdown-content">
                                    <li><a href="<?= site_url("group/freequote") ?>"><?= t("default_layout_nav_free_quote") ?></a></li>
									<li><a href="<?= site_url("group/") ?>"><?= t("default_layout_nav_charter_flight") ?></a></li>
									<li><a href="#!"><?= t("default_layout_nav_sport_flights") ?></a></li>
                                    <li><a href="#!">FAQ</a></li>
                                </ul>
                            <li>
                                <a class="dropdown-button <?= $crturl == "skypartnair" ? $active : "" ?>" href="<?= site_url("skypartnair/") ?>" data-activates="mkpar1" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400>SKY PARTNAIR</a>
                            </li>
                                <ul id="mkpar1" class="dropdown-content">
									<li><a href="<?= site_url("skypartnair/") ?>"><?= t("default_layout_nav_we_are") ?></a></li>
									<li><a href="#!"><?= t("default_layout_nav_safety") ?></a></li>
									<li><a href="#!"><?= t("default_layout_nav_why_choose") ?></a></li>
									<li><a href="#!"><?= t("default_layout_nav_our_values") ?></a></li>
								</ul>
                            <li>
                                <a class="dropdown-button <?= $crturl == "fleet" ? $active : "" ?>" href="<?= site_url("fleet/") ?>" data-activates="flotte" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400><?= t("default_layout_nav_fleet") ?></a>
                            </li>
                                <ul id="flotte" class="dropdown-content">
									<li><a href="<?= site_url("fleet/") ?>"><?= t("default_layout_nav_fleet_mk") ?></a></li>
									<li><a href="<?= site_url("fleet/privatejet") ?>"><?= t("default_layout_nav_private_jets") ?></a></li>
									<li><a href="<?= site_url("fleet/charter") ?>"><?= t("default_layout_nav_airliners") ?></a></li>
                                </ul>
                            <li>
                                <a class="dropdown-button <?= $crturl == "flash" ? $active : "" ?>" href="<?= site_url("flash/") ?>" data-activates="venfla1" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400><?= t("default_layout_nav_flash_sales") ?></a>
                            </li>
                                <ul id="venfla1" class="dropdown-content">
                                    <li><a href="<?= site_url("flash/") ?>"><?= t("default_layout_nav_flash_sales") ?></a></li>
								</ul>
                            <li>
                                <a class="dropdown-button <?= $crturl == "blog" ? $active : "" ?>" href="<?= site_url("blog/") ?>" data-activates="blog" data-beloworigin="true" data-constrainWidth="false" data-inDuration=400>BLOG</a>
                            </li>
                                <ul id="blog" class="dropdown-content">

                                    <li><a href="<?= site_url("blog/") ?>"><?= t("default_layout_nav_blog_item1") ?></a></li>
                                    <li class="divider row"></li>
                                    <?php foreach ($article_categories as $cat) :?>
									    <li><a href="<?= site_url('blog/listdisplay/'. $cat->id) ?>"><?= $cat->$cat_title ?></a></li>
                                    <?php endforeach; ?>

                                 </ul>
                            <li class="right">
                                <a href="<?= base_url("fr").$this->uri->uri_string() ?>" class="badgelang"><span class="badge <?= $lng == "fr" ? "badge-lng" : "" ?> fr" >FR</span></a>
                                <a href="<?= base_url("en").$this->uri->uri_string() ?>" class="badgelang"><span class="badge <?= $lng == "en" ? "badge-lng" : "" ?> en" >EN</span></a>
                            </li>
                        </ul>   <!-- FIN UL PRINCIPAL NAV -->
                        <a href="#" data-activates="slide-out" class="button-collapse right"><i class="material-icons">menu</i></a>
                    </div>      <!-- FIN DIV BLOC MENU NAV -->
                </div>          <!-- FIN ROW -->
            </div>              <!-- FIN DIV NAV CONTAINER -->
        </nav>                  <!-- FIN NAV -->
    </div>                      <!-- FIN NAVBAR FIXED -->
    
    <ul id="slide-out" class="side-nav">    <!-- DEBUT UL MENU NAV MOBILE -->
        <li>
            <a href="<?= site_url(); ?>"><?= img('logo.jpg', 'sky partnair affretement d\'avion', 'logo-mobile' )?> </a>
        </li>
        <li><a href="<?= site_url("privatejet/") ?>"><?= t("default_layout_nav_private_jet") ?></a></li>
        <li><a href="<?= site_url("group/") ?>"><?= t("default_layout_nav_group_flights") ?></a></li>
        <li><a href="<?= site_url() ?>">SKY PARTNAIR</a></li>
        <li><a href="<?= site_url("fleet/") ?>"><?= t("default_layout_nav_fleet") ?></a></li>
        <li><a href="<?= site_url("flash/") ?>"><?= t("default_layout_nav_flash_sales") ?></a></li>
        <li><a href="<?= site_url("blog/") ?>">BLOG</a></li>
        <li class="left">
            <a href="<?= base_url("fr").$this->uri->uri_string() ?>" class="badgelang"><span class="badge" style="background-color: #172983; margin-left:0;">FR</span></a>
            <a href="<?= base_url("en").$this->uri->uri_string() ?>" class="badgelang"><span class="badge" style="background-color: #942725; margin-left:0;">EN</span></a>
        </li>
    </ul>       <!-- FIN UL MENU NAV MOBILE -->
<!-- ********************************************* FIN NAVBAR ************************************************** -->

    <!-- DEBUT BOUTON BARRE DEVIS QUAND SCROLL 450 -->
    <?php $twitter = '<svg class="iconbar" style="position: relative; width:24px;height:24px; transform: scale(1.2); margin: auto 10px;" viewBox="0 0 24 24">
    <path fill="#ffffff" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z" />
</svg>'; ?>
    <div class="fixed-action-btn toolbar" id="magicdevis">
        <a class="btn-floating btn-large deval">
            <i class="large material-icons">send</i>
        </a>
        <ul class="devalexpand">
            <li class="col s3 waves-effect waves-light"><a class="bottom-links" style="display:flex;" href="<?= site_url("privatejet/freequote") ?>"> <i class="material-icons iconbar">description</i><?= t('default_layout_contact_bar_quotation') ?></a></li>
            <li class="col s3 waves-effect waves-light"><a class="bottom-links" style="display:flex;" href="tel:+33144840039"> <i class="material-icons iconbar">call</i>+33 1 44 84 00 39</a><li></li>
            <li class="col s3 waves-effect waves-light"><a class="bottom-links" style="display:flex;" href="mailto:nullepart@mozilla.org"> <i class="material-icons iconbar">email</i>EMAIL</a></li>
            <li class="col s3 waves-effect waves-light"><a class="bottom-links" style="display:flex;" href="https://twitter.com/login" target="_blank"> <?= $twitter ?>FB - T - I</a></li>
        </ul>
    </div>

    <!-- FIN BOUTON BARRE DEVIS QUAND SCROLL 450 -->
 <!-- ********************************************* CONTENU ENVOYÉ PAR LES CONTROLLERS  ********************** -->

    <?= $output ?>
 
 <!-- *********************************************   FOOTER   ************************************************** -->
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l5 m6 s12">
                <h2 class="grey-text text-darken-2 flow-text">SKY PARTNAIR</h2>
                <p class="grey-text text-lighten-4"><?= t('default_layout_footer_bio') ?></p>
            </div>

            <div class="col l6 offset-l1 m6 s12">

                <div class="col m6 s12">
                    <h2 class="grey-text text-darken-2 flow-text"><?= t('default_layout_footer_title_about') ?></h2>
                    <ul>
                        <li><a class="white-text" href="#!"><?= t('default_layout_footer_about_press') ?></a></li>
                        <li><a class="white-text" href="#!"><?= t('default_layout_footer_about_mentions') ?></a></li>
                        <li><a class="white-text" href="#!"><?= t('default_layout_footer_about_news') ?></a></li>
                        <li><a class="white-text" href="#!"><?= t('default_layout_footer_about_sitemap') ?></a></li>
                    </ul>
                </div>

                <div class="col m6 s12">
                    <h2 class="grey-text text-darken-2 flow-text">CONTACT</h2>
                    <ul>
                        <li><a class="white-text" href="#!"><?= t('default_layout_footer_contact_contactform') ?></a></li>
                        <li><a class="white-text" href="#!">Link 2</a></li>


                        <li><a class="lime-text" href="<?= base_url("mkadmin/dashboard") ?>">BACK OFFICE</a></li>
                    
                    
                    </ul>
                    
                </div>
            </div>
            
        </div>

        <div class="footer-copyright row">
            <div class="container">
                <div class="payment-means col l5 m6 s12 center-align">
                    <?= img('means_of_payment.png', 'means of payment' )?>
                </div>
                <div class="col l5 offset-l1 m5 s12 right-align">
                    <p class="grey-text text-lighten-1"><?= t('default_layout_footer_rights') ?></p>
                    <p class="grey-text text-lighten-1"><?= t('default_layout_footer_developers') ?></p>
                </div>
            </div>
        </div>
    </div>
</footer><script>console.log(document.readyState);</script>
<!--  Scripts -->
<script src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous">
</script>
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<script src="<?= js_url('jquery-3.2.1') ?>"></script>
<script src="<?= js_url('materialize') ?>"></script>
<script src="<?= js_url('init') ?>"></script>
<?php foreach ($js as $url): ?>
    <script src="<?= $url ?>"></script>
<?php endforeach; ?>
<script>
    // Menus déroulants de la navbar
    $(".dropdown-button").dropdown({hover: true});
    
    // Apparition du bouton barre-contact
    $(window).scroll(function() {

        if ($(this).scrollTop()>450)
        {
            $('#topbar').fadeOut();
            $('#magicdevis').fadeIn();
        }
        else
        {
            $('#topbar').fadeIn();
            $('#magicdevis').fadeOut();
        }
    });
    
    // Change couleur des boutons vol a/r aller simple sur formulaire de recherchr
    $('.vol').click(function(){
        var $this = $('.txtbouton2').toggleClass('red darken-5');
    });
</script>
</body>
</html>