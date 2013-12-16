/*!
 * WarrantyNowVoid v4.0
 *
 * Copyright 2013 WarrantyNowVoid.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built half-drunk and mostly insane by @pettazz.
 *
 * Load javascript stuff required to build the page
 */

Modernizr.load({
    test: Modernizr.csstransforms3d,
    yep : '/assets/css/experimental.css'
}); 

//determine if this is @2x territory
var isRetina = Math.floor(window.devicePixelRatio) > 1;
console.log('@2x support: ' + isRetina);



function nextFeature(){
    current = parseInt($('div#featuredbox .item.active').attr('data-itemid'));
    if(current == 4){
        next = 1;
    }else{
        next = current + 1;
    }

    switchToFeature(next);
}

function switchToFeature(itemid){
    $('div#featuredbox .item.active').removeClass('active');
    $('div#featuredbox .item[data-itemid=' + itemid + ']').addClass('active');

    $('div#featuredbox ul.titletabs li.active').removeClass('active');
    $('div#featuredbox ul.titletabs li[data-itemid=' + itemid + ']').addClass('active');
}

function startSnowing(){
    if(typeof $.snowfall == "undefined"){
        yepnope.injectJs('/assets/js/snowfall.jquery.js', function(){
            $(document).snowfall({maxSpeed : 10, shadow: true});
        });
    }else{
        $(document).snowfall({maxSpeed : 10, shadow: true});
    }
}

function walkenize(){
    $('#walkenize-button').hide();
    if(typeof $.snowfall == "undefined"){
        startSnowing();
        var walkenDelayer = window.setTimeout(function(){
            $(document).snowfall('clear');
            $(document).snowfall({image :"/assets/img/template/walken_flake.png", minSize: 10, maxSize:69});
            $("body").append('<audio id="walkenmp3"><source src="/assets/mp3/winterwonderland.mp3" type="audio/mpeg" /></audio>');
            $("audio#walkenmp3").trigger("play");
        }, 1000);
    }else{
        $(document).snowfall('clear');
        $(document).snowfall({image :"/assets/img/template/walken_flake.png", minSize: 10, maxSize:69});
        $("body").append('<audio id="walkenmp3"><source src="/assets/mp3/winterwonderland.mp3" type="audio/mpeg" /></audio>');
        $("audio#walkenmp3").trigger("play");
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

var intervalID = window.setInterval(nextFeature, 10000);

var poopActive = false;
var poopTimer = false;
var poopAnim;
var pooCounter = 0;

$(document).ready(function(){

    if(Modernizr.csstransforms3d){
        //footer thingy
        $("img.bottom-logo").click(function(eo){
            $('footer').toggleClass('rotateSpecial').toggleClass('rotateNormal');
        });
    }

    //featured box
    $('div#featuredbox ul.titletabs li').click(function(eo){
        switchToFeature($(this).attr('data-itemid'))
        window.clearInterval(intervalID);
        intervalID = window.setInterval(nextFeature, 10000);
    });

    //snowfall plugin
    if($('#walkenize-button').length > 0){
        startSnowing();
        $('#walkenize-button').click(walkenize);
    }

    // poop button
    $('#poopButton').click(function(eo){
        startPooping();
    });

    // Konami loader

    var eggloader = new Konami(function(){
        if(typeof easterEgg == "undefined"){
            // wow such default pretty
            suchDogeWow();
        }else if(typeof easterEgg == "function"){
            easterEgg();
        }else if(typeof easterEgg == "string"){
            switch(easterEgg){
                case 'snow':
                    startSnowing();
                    break;
                case 'walken':
                    walkenize();
                    break;
                case 'poopguy':
                    startPooping();
                    break;

                default:
                    suchDogeWow();
                    break;
            }
        }else{
            console.log("Poopguy doesn't know what the fuck to do with this easter egg. You get doge instead.");
            suchDogeWow();
        }
    }); 
});


function startPooping(){
    try{
        ga('send', 'event', 'button', 'click', 'poopGuy');
    }catch(err){}

    poopAnim = new Image();
    poopAnim.src = '/assets/img/template/poop_pooping' + (isRetina? '@2x' : '') + '.gif?lol=' + Math.random();
    if(!poopActive){
        poopActive = true;
        pooCounter++;
        console.log('POOP NUMBER ' + pooCounter + ' INBOUND!');

        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();

        var poopDestinationX = Math.floor((Math.random() * (viewportWidth - 400)) + 100);
        var poopDestinationY = $(window).scrollTop() + viewportHeight / 3;

        try{
            $("audio#pushit").get(0).currentTime = 0;
            $("audio#pushit").get(0).play();
        }catch(err){}

        $("#poopGuy").offset({ top: poopDestinationY, left: viewportWidth + 100 });
        $("#poopGuy").show();
        $("#poopGuy").addClass('walking');
        $("#poopGuy").animate({ left: poopDestinationX }, 5000, 'linear', function(){
            $("#poopGuy").removeClass('walking');
            $("#poopGuy").css('background-image', 'url(' + poopAnim.src + ')');
            poopTimer = window.setInterval(finishPooping, 4500);
        });
    }
}

function finishPooping(){
    window.clearInterval(poopTimer);
    poopAnim = false;
    var offset = $("#poopGuy").position();
    // offset for the diff in rects on poopguy and apoop
    spawnPoop({ top: offset.top + 340, left: offset.left + 159 });
    $("#poopGuy").css('background-image', '');
    $("#poopGuy").addClass('walking');
    $("#poopGuy").animate({ left: -250 }, 5500, 'linear', function(){
        try{
            $("audio#pushit").get(0).pause();
        }catch(err){}
        $("#poopGuy").removeClass('walking');
        console.log('DONE POOPING!');
        poopActive = false;
    });
}

function spawnPoop(offset){
    var newPoo = $('<div class="aPoop"></div>');
    newPoo.offset(offset);
    $('body').prepend(newPoo);
}