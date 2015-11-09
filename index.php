<?php

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('DatasBeard');

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>STEEM Caffeinated Peanut Butter</title>
        <meta name="viewport" content="width=900, height=device-height">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta property="og:site_name" content="STEEM Caffeinated Peanut Butter" />
        <meta property="og:title" content="STEEM Caffeinated Peanut Butter" />
        <meta property="og:url" content="http://steempb.com" />
        <meta property="og:description" content="STEEM is caffeinated peanut butter. What else do we need to say?" />
        <meta property="og:image" content="http://steempb.com/assets/img/facebook_og.png" />


        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">
        <link href="/assets/css/ladda-themeless.min.css" rel="stylesheet">

        <!-- Modernizr -->
        <script type="text/javascript" src="/assets/js/modernizr.min.js"></script>

        <!-- I'm way too lazy to fix nth child on my own -->
        <!--[if lt IE 9]>
            <script src="/assets/js/IE9.js"></script>
            <link href="/assets/css/hnnnngh.css" rel="stylesheet">
        <![endif]-->

        <script type="text/javascript">
            // get the current price of DOGE
            var dogeValue = 1;
        </script>

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="/assets/ico/favicon.ico">
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">

        <div id="header-home">
            <div class="container">
                <a href="http://steempb.com"><img id="logo" src="/assets/img/template/logo_big.png" /></a>
                <img id="sublogo" src="/assets/img/template/caffeinated_sublogo.png" />
            </div>
        </div>

        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li><a class="brand" href="#header-home"><img src="/assets/img/template/logo_small.png" /></a></li>
                        <li><a href="#faq-border">FAQ</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/twitter.png" /></a></li>
                        <li class="social"><a href="http://instagram.com/steempb" target="_blank"><img src="/assets/img/template/instagram.png" /></a></li>
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li class="social"><a href="https://plus.google.com/106045698028303100415" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a data-checkout-stage="begin" href="#cta-main" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>
        <div id="upper-wrap">
            <div id="jetguy-main"><img src="/assets/img/template/jetguy_full.png" /></div>

            <div id="cta-main-container">
                <div id="cta-main" class="flipper">
                    <img id="beta-title" src="/assets/img/template/available_now_flat.png" />
                    <img id="cta-jar" src="/assets/img/template/cta-jar.png" />
                    <p class="lead">
                    <!--     <a href="#faq-border">Find out more</a> -->
                        <a class="btn btn-large btn-warning steembtn steembtn-large" href="#cta-main" data-checkout-stage="begin" id="cta-get-it-now">Buy Online <i class="icon-play"></i></a>
                        <a class="btn btn-large btn-warning steembtn steembtn-large" href="#store-list-marker" id="">Find a Store <i class="icon-map-marker"></i></a>
                    </p>
                </div>
            </div>
            
            <div id="jet-fleet">
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
            </div>
        </div>

        <div id="faq-border"></div>
        <div class="faq-wrap">
            <div class="faq-section">
                <div class="row">
                    <div class="span10">
                        <h1>What is STEEM?</h1>
                        <p>STEEM is caffeinated peanut butter. What else do we need to say? STEEM is designed to provide a consistent release of sustained energy and the naturally slow digestion of peanut butter is the key to that. STEEM delivers protein, electrolytes, and caffeine, granting you hours of endurance and focus, and freeing you from distractions like hunger and fatigue.</p>
                    </div>
                </div>
                <div class="row split">
                    <div class="span5 text-segment">
                        <h1>What's in this stuff?</h1>
                        <p>STEEM is made with natural peanut butter, and no artificial sweeteners. Oh, and as much caffeine as two cups of coffee, so stick with the normal serving suggestions for the best effect. Enjoy it however you would normally enjoy peanut butter: spread it on crackers, toast or fruit; re-acquaint yourself with the simple perfection of the peanut butter and jelly sandwich; or just jam a knife or a spoon or a finger into the jar and eat it like you do when no one's looking. Yes you do. Yes, you <em>do</em>.</p>
                    </div>
                    <div class="span5 table-segment">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        Know Your Peanut Butter
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Ingredients:
                                    </td>
                                    <td>
                                        Natural Peanut Butter (Peanuts, Salt), Organic Agave Nectar, Peanut Oil, Natural Caffeine (Green Coffee Extract)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Caffeine:
                                    </td>
                                    <td>
                                        150mg Per Serving<br />
                                        1200mg Per Jar
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nutrition:
                                    </td>
                                    <td>
                                        <a href="">Click here to view</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Effects:
                                    </td>
                                    <td>
                                        +2 STR +3 END +2 INT +6 LCK
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row split">
                    <div class="span5 image-segment">
                        <img src="/assets/img/template/two_jars.png" />
                    </div>
                    <div class="span5 text-segment">
                        <h1>Who is STEEM for?</h1>
                        <p>STEEM's steady release of energy (without the jittery feeling) makes it perfect not only for athletes and active people, but also for normal life. How about never having to choose awful breakroom coffee because you don't want to spend more on caffeine than you spend on your lunch? How about having enough energy to finish that backyard project in one day instead of putting it off for another weekend? How about when an all-night study session has suddenly become the morning of the test? How about never having to bring that damn percolator on camping trips just so you can avoid that crippling noontime caffeine headache? How about not worrying about nodding off in meetings, or in class, or at the wheel? How about just having the energy to get going when you need it?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="span10">
                        <h1>One last thing…</h1>
                        <p><strong>DO NOT GIVE TO ANIMALS. EVER.</strong> Fun fact: a lot of domestic animals, like dogs and cats and birds, cannot digest caffeine properly and it can lead to SERIOUS health issues. We know that your dog loves peanut butter and we know you think it'd be hilarious to get him all jacked up and crazy, BUT DON'T. SERIOUSLY. IT WOULD NOT BE HILARIOUS. <br /><em>STEEM = PEOPLE FOOD</em>.</p>
                        <h1 id="store-list-marker">Okay, Where can I get it?</h1>
                        <p>STEEM is available at any of the fine locations shown below, or available to <a data-checkout-stage="begin" href="#cta-main">purchase online now</a>. Be sure to check back soon for more locations, more are added all the time!</p>
                        <p>If you'd like to carry STEEM at your store/gym/batcave email us here: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a>.</p>
                    </div>
                </div>
                <div class="row">

                    <div id="map">
                        <div class="gifspinner"><img src="/assets/img/template/spinner.gif" /></div>
                        <p>Loading locations...</p>
                    </div>

                </div>
                <div class="row" id="mapList">

                </div>
                <div class="row">
                    <div class="span10">
                        <div id="faq-cta-row">
                            <h1>It's time to get going!</h1>
                            <a class="btn btn-large btn-warning steembtn steembtn-large" data-checkout-stage="begin" href="#cta-main">Get it now <i class="icon-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>        
        </div>    
     
        <!--<div id="faq-border-bottom"></div>-->
        

        <div id="footer-home">
            All content © STEEM Peanut Butter, Inc., all rights reserved | Contact us: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a>
        </div id="footer-home">

        <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
        <script src="http://code.jquery.com/color/jquery.color-2.1.2.min.js"></script>
        <script src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/assets/js/retina.js"></script>
        <script type="text/javascript" src="/assets/js/konami.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="/assets/js/handlebars-v1.3.0.js"></script>
        <script type="text/javascript" src="/assets/js/spin.min.js"></script>
        <script type="text/javascript" src="/assets/js/ladda.min.js"></script>
        <script type="text/javascript" src="/assets/js/ladda.jquery.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>
        <script type="text/javascript">

            // data from DatasBeard
            <?php
                // shirts from datasbeard
                $shirts = array();
                $rows = $JACKED->DatasBeard->getRows('c5514c42-c65f-445a-b9ca-6a089772e672');
                foreach($rows as $row){
                    $shirts[$row['Color']][$row['Size']] = $row['Available'];
                }
                echo 'var shirtAvailability = ' . json_encode($shirts) . ';';
            ?>

            var retailAddresses = [
            <?php
                // addresses from datasbeard
                $addressRows = $JACKED->DatasBeard->getRows('0871d7c3-f9aa-408f-b80b-65b5a4834dde');
                foreach($addressRows as $row){
                    $row['searchAddress'] = $row['address'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['zip code'];
                    echo json_encode($row) . ',';
                }
            ?>
            ];

            var checkout_lol_messages = [
            <?php
                // checkout loading messages from datasbeard

                $lolRows = $JACKED->DatasBeard->getRows('1202cb40-4b1b-42c9-9180-e6df6adeed2a');
                foreach($lolRows as $row){
                    echo '"' . $row['message'] . '...",';
                }
            ?>
            ];

        </script>
        <script type="text/javascript" src="/assets/js/page.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
            ga('create', 'UA-36577111-1', 'steempb.com');
            ga('send', 'pageview');

        </script>
    </body>
</html>
