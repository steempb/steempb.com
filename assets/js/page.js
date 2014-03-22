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

var shippingUpdated = false;
var submissionData;

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

    $('#letsgo form#jarWidget input').keydown(function(eo){
        if(eo.keyCode == 13){
            eo.preventDefault();
            return false;
        }
    });

    $('#inputQuantity').popover({
        'animation': true,
        'placement': 'left',
        'trigger': 'manual',
        'title': 'Quantity Too Large',
        'html': true,
        'content': '<p style="font-size:12px; color:#333;">Limit of three jars per transaction to save shipping costs.</p>'
    });

    $('#letsgo form#jarWidget button[type="submit"]').click(function(eo){
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
            var value = $.trim($("#inputQuantity").val());
            if(value > 3 || !$.isNumeric(value)){
                $('#inputQuantity').popover('show');
                $("#inputQuantity").focus();
                $("#inputQuantity").keydown(function(){
                    $('#inputQuantity').popover('hide');
                    $('#inputQuantity').unbind('keydown');
                    $('#inputQuantity').unbind('blur');
                });
                $("#inputQuantity").blur(function(){
                    $('#inputQuantity').popover('hide');
                    $('#inputQuantity').unbind('keydown');
                    $('#inputQuantity').unbind('blur');
                });
                valid = false;
            }else{
                data['quantity'] = $.trim($("#inputQuantity").val());
            }
        }

        data['tickets'] = $.trim($("#inputTickets").val());

        if(valid){
            data['payment'] = $(this).attr('data-paymentMethod');
            submissionData = data;
            $('#shippingModal').modal({
                backdrop: true,
                keyboard: false
            });
        }
    });

    $('form#shippingDetails input,select').change(function(eo){
        $(".modal-footer .btn-primary").attr('disabled', 'disabled');
        $('#shippingTotal').html('');
        shippingUpdated = false;
    });

    $('.modal-footer .btn-cancel').click(function(eo){
        $('#shippingModal').modal('hide');
        submissionData = {};
    });

    $('#shippingCalc').click(function(eo){
        eo.preventDefault();

        valid = true;

        data = {};
        if($.trim($("#inputName").val()) == ''){
            $("#inputName").focus();
            valid = false;
        }else{
            data['recipient_name'] = $.trim($("#inputName").val());
        }

        if($.trim($("#inputStreetLine1").val()) == ''){
            $("#inputStreetLine1").focus();
            valid = false;
        }else{
            data['line1'] = $.trim($("#inputStreetLine1").val());
        }

        data['line2'] = $.trim($("#inputStreetLine2").val());

        if($.trim($("#inputCity").val()) == ''){
            $("#inputCity").focus();
            valid = false;
        }else{
            data['city'] = $.trim($("#inputCity").val());
        }

        if($.trim($("#inputPostalCode").val()) == ''){
            $("#inputPostalCode").focus();
            valid = false;
        }else{
            data['postal_code'] = $.trim($("#inputPostalCode").val());
        }

        if($.trim($("#inputState").val()) == ''){
            $("#inputState").focus();
            valid = false;
        }else{
            data['state'] = $.trim($("#inputState").val());
        }

        if($.trim($("#inputPhone").val()) == ''){
            $("#inputPhone").focus();
            valid = false;
        }else{
            data['phone'] = $.trim($("#inputPhone").val());
        }

        if($.trim($("#inputCountry").val()) == ''){
            $("#inputCountry").focus();
            valid = false;
        }else{
            data['country'] = $.trim($("#inputCountry").val());
        }

        if(valid){
            submissionData = $.extend({}, submissionData, data);
            updateShippingCost(data);
        }
    });

    $('.modal-footer .btn-primary').click(function(eo){
        if(shippingUpdated){
            $('#shippingModal').modal('hide');
            completeFormSubmission();
        }else{
            $('#shippingCalc').focus();
        }
    });

});

function updateShippingCost(shippingData){
    shippingData['weight'] = submissionData['quantity'] * .5; // weight calc!
    $('#shippingTotal').html('<div class="gifspinner-small"><img src="/assets/img/template/spinner.gif" /></div>');
    $.ajax({
        type: "POST",
        url: '/shipping.php',
        data: shippingData,
        success: function(data, textStatus, jqXHR){
            if(data.valid == 'true'){
                $('#shippingTotal').html('$' + data.cost + ' <img style="vertical-align:top;" id="shippingCostPopover" src="/assets/img/template/big_info' + (isRetina? '@2x' : '') + '.png" width="20" height="20" />');

                $('#shippingCostPopover').popover({
                    'animation': true,
                    'placement': 'top',
                    'trigger': 'manual',
                    'title': 'Why is shipping so expensive?',
                    'html': true,
                    'content': '<p style="font-size:12px; color:#333;">Sorry about that, folks. As we build volume, those prices should go down. <br />BUT, if we may offer a solution:<br />Orders of anywhere from 1 to 4 jars should be the same shipping price <strong>as long as they\'re all being shipped to the same address</strong>, so combining your order with your friends to split it is one way to reduce the cost to each of you.</p>'
                });
                $('#shippingCostPopover').hover(function(){
                    $('#shippingCostPopover').popover('show');
                }, function(){
                    $('#shippingCostPopover').popover('hide');
                });
                $('#shippingCostPopover').click(function(){
                    $('#shippingCostPopover').popover('toggle');
                });
                shippingUpdated = true;
                submissionData['shipping'] = data.cost;
                $(".modal-footer .btn-primary").removeAttr('disabled');
            }else{
                $('#shippingTotal').html('Invalid Address');
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#shippingTotal').html('Error Getting Data');
        }
    });
}

function completeFormSubmission(){
    data = submissionData;
    jetFleetFlyAway();
    data['product'] = $.trim($("#inputProduct").val());
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
            url: '/checkout.php',
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