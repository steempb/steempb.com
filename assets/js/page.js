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

var jetGuyMainPresent = true;
var jetGuyMainAnimating = false;

var jetFleetPresent = false;
var jetFleetAnimating = false;

var cart_context = {
    'item_name': 'None',
    'item_quantity': 0,
    'item_subtotal': 0,
    'shipping_total': 0,
    'discounts': []
};

// get the current value of Doge from Moolah
var dogeValue = false;
$.get('https://moolah.io/api/rates?f=USD&t=DOGE&a=1', function(data){
    dogeValue = parseInt(data.replace(/,/g, ''));
})

// get our templates
var store_template;
$.get("/assets/templates/store_front_page.handlebars", function(raw) {
    store_template = Handlebars.compile(raw);
});

var summary_template;
$.get("/assets/templates/store_summary.handlebars", function(raw) {
    summary_template = Handlebars.compile(raw);
});


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

    //close any popovers with an oustide click
    $('body').on('click', function (e) {
        //did not click a popover toggle or popover
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) { 
            $('[data-toggle="popover"]').popover('hide');
        }
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
                height: 470,
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

                context.flip_side = 'front';
                context.payment_method = 'usd';
                context.usd = true;
                $('#cta-main').html( store_template(context) );

                context.flip_side = 'back';
                context.payment_method = 'doge';
                context.usd = false;
                $('#cta-main').append( store_template(context) );

                $(".dogetoggle").click(function(){
                    $("#cta-main-container").toggleClass('flip');
                });

                $('.international-shipping-info').attr('data-content', '<p style="font-size:12px; color:#333;">Our apologies, but we\'re not yet able to ship STEEM Peanut Butter outside of the United States, but we\'re working on it. If you reside in a country outside of the US and you participated in our Peanut Beta, please email us at: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a></p>');

                // sync the shipping form on both sides
                $('form.shipping input').change(function(eo){
                    $('.' + oppositeSide() + ' form.shipping input[name=' + $(this).attr('name') + ']').val($(this).val());
                });

                // Checkout stuff

                btn = $('select[name=inputQuantity]').parents('form').find('.checkoutbtn');
                btn.addClass('noclicky');
                btn.mouseover(function(){
                    select = $(this).parents('form').find('select[name=inputQuantity]');
                    if($(this).hasClass('noclicky')){
                        select.tooltip({
                            'animation': true,
                            'placement': 'bottom',
                            'trigger': 'manual',
                            'title': 'Please select a quantity.'
                        });
                        select.tooltip('show');
                    }else{
                        select.tooltip('destroy');
                    }
                });

                $('select[name=inputQuantity]').change(function(){
                    $('select[name=inputQuantity]').val($(this).val());
                    $('select[name=inputQuantity]').tooltip('destroy');
                    if($(this).val()){
                        var quantity = parseInt($(this).val());
                               
                        var labels = {
                            doge: 'Ð' + ((6.75 + (4.99 * quantity)) * dogeValue).toFixed(2) + ' <i class="icon-play"></i>',
                            usd: '$' + (6.75 + (4.99 * quantity)).toFixed(2) + ' <i class="icon-play"></i>'
                        }                       

                        $('.checkoutbtn[data-payment-method="' + currentSideCurrency() + '"]').fadeOut('fast', function(){
                            $(this).removeClass('btn-disabled').removeClass('noclicky');
                            $(this).html(labels[currentSideCurrency()]);
                            $(this).fadeIn();
                            $('select[name=inputQuantity]').tooltip('destroy');
                        });
                        $('.checkoutbtn[data-payment-method="' + oppositeSideCurrency() + '"]').html(labels[oppositeSideCurrency()]).removeClass('noclicky');

                    }else{
                        $(this).tooltip({
                            'animation': true,
                            'placement': 'bottom',
                            'trigger': 'manual',
                            'title': 'Please select a quantity.'
                        });
                        $(this).tooltip('show');

                        $('.checkoutbtn[data-payment-method="' + currentSideCurrency() + '"]').fadeOut('fast', function(){
                            $(this).addClass('btn-disabled').addClass('noclicky');
                            $(this).html('Buy Me');
                            $(this).fadeIn();
                        });
                        $('.checkoutbtn[data-payment-method="' + oppositeSideCurrency() + '"]').html('Buy Me').addClass('noclicky');
                        
                    }
                });

                $('form.checkout-normal').submit(function(eo){
                    eo.preventDefault();
                    if($(this).find('.checkoutbtn').hasClass('noclicky')){
                        eo.preventDefault();
                        select = $(this).find('select[name=inputQuantity]');
                        select.tooltip({
                            'animation': true,
                            'placement': 'bottom',
                            'trigger': 'manual',
                            'title': 'Please select a quantity.'
                        });
                        select.tooltip('show');
                    }else{
                        cart_context.item_name = 'STEEM Jar';
                        cart_context.item_quantity = $(this).find('select[name=inputQuantity]').val();
                        cart_context.item_subtotal = cart_context.item_quantity * 4.99;
                        cart_context.shipping_total = 6.75;
                        checkoutSlide(2);
                    }
                });

                // Special stuff

                $('select[name=inputColor]').change(function(){
                    $('.' + oppositeSide() + ' select[name=inputColor]').val($(this).val());
                    var that = $(this);
                    $('.img-special').fadeOut(function(){
                        $(this).attr('src', '/assets/img/template/checkout_valuemeal_' + that.val() + (isRetina? '@2x' : '') + '.png');
                        $(this).fadeIn();
                    });
                });

                $('select[name=inputSize]').change(function(){
                    $('.' + oppositeSide() + ' select[name=inputSize]').val($(this).val());
                });

                $('form.checkout-special').submit(function(eo){
                    eo.preventDefault();
                    cart_context.item_name = '2 Jars + T-Shirt';
                    cart_context.item_quantity = 1;
                    cart_context.item_subtotal = 19.99;
                    cart_context.shipping_total = 0;
                    checkoutSlide(2);
                });

            }
        );
    });

});

function currentSide(){
    return ($("#cta-main-container").hasClass('flip'))
        ? 'back'
        : 'front';
}

function oppositeSide(){
    return ($("#cta-main-container").hasClass('flip'))
        ? 'front'
        : 'back';
}

function currentSideCurrency(){
    return ($("#cta-main-container").hasClass('flip'))
        ? 'doge'
        : 'usd';
}

function oppositeSideCurrency(){
    return ($("#cta-main-container").hasClass('flip'))
        ? 'usd'
        : 'doge';
}

function checkoutSlide(slide){
    if(slide == 1){
        newMargin = -20;
    }else{
        updateSummary();
        newMargin = -914;
    }
    $('.store-slide[data-store-slide=1]').animate({
        marginLeft: newMargin
    }, 300);
    $('.checkoutbar').attr('src', '/assets/img/template/checkoutbar_step' + slide + (isRetina? '@2x' : '') + '.png');
}

function updateSummary(){
    cart_context.total = cart_context.item_subtotal + cart_context.shipping_total;

    context_front = cart_context;
    context_front.usd = true;
    $('.store-side.front dl.store-summary').html( summary_template(context_front) );

    context_back = cart_context;
    context_back.usd = false;
    $('.store-side.back dl.store-summary').html( summary_template(context_back) );

    $('.cart-edit-link').click(function(){
        checkoutSlide(1);
    });

    $('.btn.promo-codes').click(function(){
        collectPromoCode($(this));
    });
}

function collectPromoCode(that){
    that.parent('dd').siblings('dt.promo-placeholder').replaceWith('<input type="text" id="ticketInput" /> <button class="btn btn-mini btn-warning promo-codes-submit">Add</button>');
    that.parent('dd').remove();

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
        ? '$' + parseFloat(value).toFixed(2)
        : 'Ð' + (parseFloat(value) * dogeValue).toFixed(2);
  
});

// return the payment service name
Handlebars.registerHelper('checkoutService', function() {
    return (this.usd)
        ? 'PayPal'
        : 'Moolah';
  
});