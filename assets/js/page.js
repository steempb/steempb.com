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

var jarLimit = 4;
var jarLimitStr = "four";


var jetGuyMainPresent = true;
var jetGuyMainAnimating = false;

var jetFleetPresent = false;
var jetFleetAnimating = false;

var paymentMethod = 'USD';

var shippingUpdated = false;
var submissionData;

// get the current value of Doge from Moolah
var dogeValue = false;
$.get('https://moolah.io/api/rates?f=USD&t=DOGE&a=1', function(data){
    dogeValue = parseInt(data.replace(/,/g, ''));
})


$(document).ready(function(){
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
            suchDogeWow();
        }
    }); 

    //make jetguys fly
    $(window).scroll(function(eData){
        // $(window).height() is bugged in mobilesafari
        var winHeight = window.innerHeight ? window.innerHeight : $(window).height();
        var currentST = $(this).scrollTop();

        if(!jetFleetPresent && jetGuyMainPresent && currentST > 200){
            jetGuyFlyAway();
        }
        if(!jetFleetPresent && currentST < 200 && !jetGuyMainPresent){
            jetGuyFlyIn();
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
        'content': '<p style="font-size:12px; color:#333;">Limit of ' + jarLimitStr + ' jars per transaction to save shipping costs.</p>'
    });

    $('#inputCountry').popover({
        'animation': true,
        'placement': 'bottom',
        'trigger': 'manual',
        'title': 'Shipping Only to the US',
        'html': true,
        'content': '<p style="font-size:12px; color:#333;">Our apologies, but we\'re not yet able to ship STEEM Peanut Butter outside of the United States, but we\'re working on it. If you reside in a country outside of the US and you participated in our Peanut Beta, please email us at: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a></p>'
    });

    $('#cta-get-it-now').click(function(eo){
        jetGuyFlyAway();
        $("#cta-main").children().each(function(){
            $(this).fadeOut('fast', function(){
                $(this).remove()
            });
        });
        // if($('html').hasClass('csstransforms3d')){
        //     $("#cta-main").append('<div class="spinner"></div>');
        // }else{
        //     $("#cta-main").append('<div class="gifspinner"><img src="/assets/img/template/spinner.gif" /></div>');
        // }
        jetFleetFlyIn();
        $("#cta-main").animate({
            backgroundColor: 'rgba(238, 238, 238, 0.96)'
        }, 500, 'easeInBack');
        $("#cta-main-container").animate(
            {
                marginLeft: -425,
                width: 800, 
                height: 520,
                boxShadow: 'none'
            }, 
            501,
            'easeInBack', function(){
                $("#cta-main").css({
                    backgroundColor: 'rgba(238, 238, 238, 0)',
                    transition: '0.6s',
                    boxShadow: 'none'
                });

                context = {
                    
                };

                loadTemplate('store_front_page', function(t) {
                    context.flip_side = 'front';
                    context.usd = true;
                    $('#cta-main').html( t(context) );

                    context.flip_side = 'back';
                    context.usd = false;
                    $('#cta-main').append( t(context) );

                    $(".dogetoggle").click(function(){
                        $("#cta-main-container").toggleClass('flip');
                    });

                });
            }
        );
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
            if(value > jarLimit || !$.isNumeric(value)){
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
            var value = $.trim($("#inputCountry").val());
            if(value != 'US' && value != 'CA'){
                $('#inputCountry').popover('show');
                $("#inputCountry").focus();
                $("#inputCountry").blur(function(){
                    $('#inputCountry').popover('hide');
                    $('#inputCountry').unbind('blur');
                });
            }else{
                data['country'] = value;
            }
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
                    'content': '<p style="font-size:12px; color:#333;">Sorry about that, folks. As we build volume, those prices should go down. <br />BUT, if we may offer a solution:<br />Orders of anywhere from 1 to ' + jarLimitStr + ' jars should be the same shipping price <strong>as long as they\'re all being shipped to the same address</strong>, so combining your order with your friends to split it is one way to reduce the cost to each of you.</p>'
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

function bigBoxTransition(callback){
    $
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
                    scrollTop: target.offset().top - 60
                }, 1000, function(){
                    $(window).scroll();
                });
                return false;
            }
        }
    });
});

// load one of our Handlebars templates
function loadTemplate(name, callback){
    $.get("/assets/templates/"+ name + ".handlebars", function(raw) {
        callback(Handlebars.compile(raw));
    });
}

/*
 * Retina Images using Handlebars.js
 *
 * Created by [Makis Tracend](@tracend)
 * Released under the [MIT license](http://makesites.org/licenses/MIT) 
 *
 * Usage: <img src="{{retina 'http://mydoma.in/path/to/image.jpg'}}">
 */
Handlebars.registerHelper('retina', function( src ) {

    return (isRetina) 
        ? src.replace(/\.\w+$/, function(match) { return "@2x" + match; }) 
        : src;
  
});

// change prices to DOGE
Handlebars.registerHelper('formatPrice', function( value ) {
    return (this.usd)
        ? '$' + value
        : 'Ð' + (parseInt(value) * dogeValue);
  
});