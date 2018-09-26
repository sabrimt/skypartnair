<div class="d hx hf gu gallery-item gallery-expand ce overhead">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray" style="height: 300px;">
                <img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/overhead.jpg?15442768042751423763" crossOrigin="anonymous" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Workspace</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Grapefruit</h3>
                </div>
                <p class="fi">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="fi">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
<!--// EFFET ZOOM SUR DIV -->
<div class="blog-card" style >
		<div class="card zoomarticle" style="padding:0.5rem;">
			<div class="card-image waves-effect waves-block waves-light article_big_img">
				<?= img($article->picture_1, 'affretement jet privé', "" )?> 
				<div class="txt-img-bloc">
					<h2 class="margin-top:2rem;"><?= $article->$title ?></h2>
					<p><small> Publié le <?= $article->article_date ?> dans <strong><?= $article->category->$category ?></strong></small></p>
				</div>
				<div class="mask">
					<p class="center-align" style=" padding-left:1rem; padding-right: 1rem;"> <i> <?= $article->$description ?> <br/>...</i> </p>
<!--								<a href="#" class="">En savoir plus</a>-->
				</div>

			</div>
		</div>
	</div>