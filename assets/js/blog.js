/*!
 * STEEM PB v1.0
 *
 * Copyright 2013 WarrantyNowVoid.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built half-drunk and mostly insane by @pettazz.
 *
 * Load javascript stuff required to build the page
 */

// Modernizr.load({
//     test: Modernizr.csstransforms3d,
//     yep : '/assets/css/experimental.css'
// }); 

//determine if this is @2x territory
var isRetina = Math.floor(window.devicePixelRatio) > 1;
// console.log('@2x support: ' + isRetina);

if(isRetina){
    var shareMarkup = '<ul id="social-links"><li><a href="http://twitter.com/share?url=http%3A%2F%2Fsteempb.com&text=I can%27t wait for @steempb! %23GetGoing" target="_blank"><img src="/assets/img/template/share_twitter@2x.png" title="Share on Twitter" /></a></li><li><a href="http://plus.google.com/share?url=http://steempb.com" target="_blank"><img src="/assets/img/template/share_gplus@2x.png" title="Share on Google+" /></a></li><li><a href="http://www.facebook.com/sharer.php?u=http://steempb.com" target="_blank"><img src="/assets/img/template/share_facebook@2x.png" title="Share on Facebook" /></a></li></ul>';
}else{
    var shareMarkup = '<ul id="social-links"><li><a href="http://twitter.com/share?url=http%3A%2F%2Fsteempb.com&text=I can%27t wait for @steempb! %23GetGoing" target="_blank"><img src="/assets/img/template/share_twitter.png" title="Share on Twitter" /></a></li><li><a href="http://plus.google.com/share?url=http://steempb.com" target="_blank"><img src="/assets/img/template/share_gplus.png" title="Share on Google+" /></a></li><li><a href="http://www.facebook.com/sharer.php?u=http://steempb.com" target="_blank"><img src="/assets/img/template/share_facebook.png" title="Share on Facebook" /></a></li></ul>';
}


var jetGuyMainPresent = true;
var jetGuyMainAnimating = false;

var jetFleetPresent = false;
var jetFleetAnimating = false;

$(document).ready(function(){
    // Konami loader
    var eggloader = new Konami(function(){
        if(typeof easterEgg == "undefined"){
            // wow such default pretty
            suchDogeWow();
        }else if(typeof easterEgg == "function"){
            easterEgg();
        }else if(typeof easterEgg == "string"){
            switch(easterEgg){
                default:
                    suchDogeWow();
                    break;
            }
        }else{
            // console.log("Konami-san doesn't know wtf to do with that definition. You get doge instead.");
            suchDogeWow();
        }
    }); 

});

function suchDogeWow(){
    if(typeof LIBDOGE == "undefined"){
        yepnope.injectJs('/assets/js/libdoge.min.js', function(){
            LIBDOGE.controller.buyDoge();
        });
    }else{
        LIBDOGE.controller.buyDoge();
    }
}

$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000, function(){
                    $(window).scroll();
                });
                return false;
            }
        }
    });
});