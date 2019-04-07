/*!
 * STEEM PB v2.0
 *
 * Copyright 2014 steempb.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built half-drunk and mostly insane by @pettazz.
 *
 * Load javascript stuff required to build the page
 */

//determine if this is @2x territory
var isRetina = Math.floor(window.devicePixelRatio) > 1;

var jetGuyMainPresent = true;
var jetGuyMainAnimating = false;

var jetGuyHovering = false;

var jetFleetPresent = false;
var jetFleetAnimating = false;


$(document).ready(function(){
    jetFleetFlyIn();
    setTimeout(jetFleetFlyAway, 2000);
    setTimeout(function(){
        jetGuyHovering = true;
        jetGuyFlyIn(jetGuyHover);
    }, 3000);

});

function jetGuyHover(){
    if(jetGuyHovering){
        $('#jetguy-main').animate({
                top: 20
            }, 3000, 'easeOutBack', function(){
                $('#jetguy-main').animate({
                    top: 0
                }, 3000, 'easeOutBack', jetGuyHover);
        });
    }
}

function jetGuyFlyAway(){
    jetGuyHovering = false;
    if(!jetGuyMainAnimating){
        jetGuyMainAnimating = true;
        $('#jetguy-main').animate({
            top: -872,
            left: '90%'
        }, 1000, 'easeInQuart', function(){
            jetGuyMainPresent = false;
            jetGuyMainAnimating = false;
        });
    }
}

function jetGuyFlyIn(callback){
    if(!jetGuyMainAnimating){
        jetGuyMainAnimating = true;
        $('#jetguy-main').css({
            visibility: 'visible',
            top: 900,
            left: '20%'
        });
        $('#jetguy-main').animate({
            top: 0,
            left: '50%'
        }, 1000, function(){
            jetGuyMainPresent = true;
            jetGuyMainAnimating = false;

            if(typeof callback === 'function'){
                callback();
            }
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
