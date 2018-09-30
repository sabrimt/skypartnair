
$(document).ready(function() {
    // PHOTO ARTICLE
    $('.materialboxed').materialbox();
    // FACEBOOK
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.9";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    
    /****  PAGINATION AJAX  ****/
    
    $(function() {
		let pathname = window.location.pathname;
		let path = pathname.split('/');
		let lang = path[2];
		base_url = "http://" + window.location.host + "/";
		site_url = base_url + lang + '/';
		
        applyPagination();
        
		function applyPagination() {
            $("#ajax_pagingsearc a").click(function() {
                // Adding lang segment into url
                let hrefUrl = $(this).attr("href");
                let blogPos = hrefUrl.indexOf('blog');
                let str1 = hrefUrl.substring(0, blogPos-1);
                let str2 = hrefUrl.substring(blogPos);
                let url = str1 + '/' + lang + '/' + str2;

                // Container Infos
                let $container = $("#ajaxdata"),
                    contHeight = $container.height(),
                    contWidth = $container.width(),
                    loadingDiv = $('<div></div>').css({
                        width: contWidth + 'px',
                        height: contHeight +'px',
                        background: 'url(/skypartnair/assets/img/loading.gif) center center no-repeat',
                        backgroundSize: '40px'
                    });
                

                $container.html(loadingDiv);
                $container.css({height: contHeight});

                $.ajax({
                    type: "POST",
                    data: "ajax=1",
                    url: url,
                    success: function(msg) {
                        setTimeout(function() {

                            $container.hide().html(msg).fadeIn(300);
                            applyPagination();
                            
                        }, 300);
                    }
                });
                return false;
            });
        }
    });
    /****  END pagination ajax  ****/
    
    
    // MAIN ARTICLE IMAGE CENTER
    let marginPrinImg = ($('.principal-art-img').width() - $('.horizontal.card .card-image').width())/2;
    $('.principal-art-img').css("margin-left", -marginPrinImg);
    
    // VOIRAUSSI ARTICLES IMAGE CENTER
    $('.article_voiraussi').each(function(){
        if($('.image-container img', this).width() > $('.image-container', this).width()){
            let marginVaImg = ($('.image-container img', this).width() - $('.image-container', this).width())/2;
            $('.image-container img', this).css("margin-left", -marginVaImg);
        }
    });
    
    
    // BLOG ALIGN
    let windowWidth = $(window).width();
    
    let rowBiggest = 0; // row's height
    let articles = $('.article_item');
    let numArt = articles.length;
    if(windowWidth > 973){
        for (let artIdx = 0; artIdx < numArt; artIdx++){
            let crtArt = articles.eq(artIdx);

            if(artIdx > 2){
                crtArt.addClass("article_item_abs");
                let topArt = articles.eq(artIdx - 3);

                let tAH = artIdx - 3 >= 0 ? topArt.height():0;
                let tAL = topArt.position().left;
                let tAT = topArt.position().top;

                crtArt.css('top', tAT + tAH + "px");
                crtArt.css('left', tAL + "px");

                let firstArtH = artIdx - 6 >= 0 ? articles.eq(artIdx - 6).height(): 0;
                let rowBottom = crtArt.height() + tAH + firstArtH;

                if(rowBottom > rowBiggest){
                    rowBiggest = rowBottom;
                }
            }

        }
        $('.last-atc-1').first().css("height", rowBiggest + 30 + 'px'); // defines row's height
    } else if(windowWidth < 973 && windowWidth > 581){
        for (let artIdx = 0; artIdx < numArt; artIdx++){
            let crtArt = articles.eq(artIdx);

            if(artIdx > 1){
                crtArt.addClass("article_item_abs");
                let topArt = articles.eq(artIdx - 2);

                let tAH = artIdx - 2 >= 0 ? topArt.height():0;
                let tAL = topArt.position().left;
                let tAT = topArt.position().top;

                crtArt.css('top', tAT + tAH + "px");
                crtArt.css('left', tAL + "px");

                let firstArtH = artIdx - 8 >= 0 ? articles.eq(artIdx - 8).height(): 0;
                let line2ArtH = artIdx - 6 >= 0 ? articles.eq(artIdx - 6).height(): 0;
                let line3ArtH = artIdx - 4 >= 0 ? articles.eq(artIdx - 4).height(): 0;
                let rowBottom = crtArt.height() + tAH + firstArtH + line2ArtH + line3ArtH;

                if(rowBottom > rowBiggest){
                    rowBiggest = rowBottom;
                }
            }

        }
        $('.last-atc-1').first().css("height", rowBiggest + 30 + 'px'); // defines row's height
    }
    
    // END blog align
    
});
