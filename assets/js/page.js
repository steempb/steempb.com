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
    $('#jet-fleet .jetguy').each(function(){
        $(this).css({'visibility': 'hidden'});
    });
    jetGuyFlyIn();
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

    //make jetguys fly
    $(window).scroll(function(eData){
        // $(window).height() is bugged in mobilesafari
        var winHeight = window.innerHeight ? window.innerHeight : $(window).height();
        var currentST = $(this).scrollTop();
        var fleetStartMarker = $("#letsgo").offset().top + $("#letsgo").height();

        if(currentST > 200 && currentST < fleetStartMarker && jetGuyMainPresent){
            jetGuyFlyAway();
        }
        if(currentST < 200 && !jetGuyMainPresent){
            jetGuyFlyIn();
        }
        if(currentST + winHeight > fleetStartMarker + 20 && !jetFleetPresent){
            jetFleetFlyIn();
        }
    });

    $('#letsgo form#ticketWidget input').keydown(function(eo){
        if(eo.keyCode == 13){
            eo.preventDefault();
            return false;
        }
    });

    $('#letsgo form#ticketWidget button[type="submit"]').click(function(eo){
        eo.preventDefault();

        var valid = true;

        data = {};
        if($.trim($("#inputEmail").val()) == ''){
            $("#inputEmail").focus();
            valid = false;
        }else{
            data['email'] = $.trim($("#inputEmail").val());
        }

        if($.trim($("#inputQuantity").val()) == ''){
            $("#inputQuantity").focus();
            valid = false;
        }else{
            data['quantity'] = $.trim($("#inputQuantity").val());
        }

        if(valid){
            jetFleetFlyAway();
            data['product'] = $.trim($("#inputProduct").val());
            data['payment'] = $(this).attr('data-paymentMethod');
            data['getgoing'] = 'more_like_peanut_BETTER';
            $("#form-container").fadeOut('fast', function(){
                if($('html').hasClass('csstransforms3d')){
                    $("#form-container").html('<div class="spinner"></div>');
                }else{
                    $("#form-container").html('<div class="gifspinner"><img src="/assets/img/template/spinner.gif" /></div>');
                }
                $("#form-container").fadeIn('fast');

                $.ajax({
                    type: "POST",
                    url: '/ticketCheckout.php',
                    data: data,
                    success: function(data, textStatus, jqXHR){
                        window.location.href = data.url;
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $("#form-container").fadeOut('fast', function(){
                            $("#form-container").html('<p class="lead" style="color:#dd1010">There was an error submitting your purchase. <br />Please try again later.</p>');
                            $("#form-container").fadeIn('fast');
                        });
                    }
                });
            });
        }
    });
});

function jetGuyHover(){
    $('#jetguy-main').animate({
            top: 240
        }, 1000, 'easeOutBack', function(){
            $('#jetguy-main').animate({
                top: 250
            }, 1000, 'easeInBack');
    });
}

function jetGuyFlyAway(){
    if(!jetGuyMainAnimating){
        jetGuyMainAnimating = true;
        $('#jetguy-main').animate({
            top: -572,
            left: '90%'
        }, 1000, 'easeInQuart', function(){
            jetGuyMainPresent = false;
            jetGuyMainAnimating = false;
        });
    }
}

function jetGuyFlyIn(){
    if(!jetGuyMainAnimating){
        jetGuyMainAnimating = true;
        $('#jetguy-main').css({
            top: 900,
            left: '20%'
        });
        $('#jetguy-main').animate({
            top: 250,
            left: '50%'
        }, 1000, function(){
            jetGuyMainPresent = true;
            jetGuyMainAnimating = false;
        });
    }
}

function jetFleetFlyIn(){
    if(!jetFleetAnimating){
        jetFleetAnimating = true;
        $('#jet-fleet .jetguy').each(function(){
            var currentCSSOffset = $(this).css(['top', 'left']);
            $(this).css({
                top: "+=" + ($(this).height() + 50),
                left: "-=100",
                visibility: 'visible'
            });
            $(this).animate(currentCSSOffset, 1500, function(){
                jetFleetPresent = true;
                jetFleetAnimating = false;
            });
        });
    }
}

function jetFleetFlyAway(callback){
    if(!jetFleetAnimating){
        jetFleetAnimating = true;
        var iter = 0;
        var guys = $('#jet-fleet .jetguy').length;
        $('#jet-fleet .jetguy').each(function(index, value){
            var that = $(this);
            window.setTimeout(function(){
                var currentCSSOffset = that.css(['top', 'left']);
                that.animate({
                    top: -1 * (that.height() + 100),
                    left: "+=300"
                }, 1500, 'easeInQuart', function(){
                    that.css('visibility', 'hidden');
                    that.css(currentCSSOffset);
                    if(index + 1 == guys){
                        jetFleetAnimating = false;
                        if(typeof callback === 'function'){
                            callback();
                        }
                    }
                });
            }, iter * 300);
            iter++;
        });
    }
}

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