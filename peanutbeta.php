<?php


    function flipperize($str){
        $result = '
        <span class="flipper">';
        foreach(str_split($str) as $char){
            if($char == '$'){
                $char = 'usd';
            }else if($char == '.'){
                $char = 'dot';
            }
            $result .= '
            <img src="/assets/img/flip-numbers/' . $char . '.png" />';
        }
        $result .= '
        </span>';

        return $result;
    }


    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED(array('Syrup'));

    $tickets = $JACKED->Syrup->Ticket->find(array('Promotion' => '2d0727ce-bbe6-41fe-aef0-729fd768d984'));
    $currentPreorders = count($tickets);

    switch(True){
        case $currentPreorders >= 2000:
            $ticketsLeft = 2500 - $currentPreorders;
            $value = '$2.00';
            break;

        case 2000 > $currentPreorders && $currentPreorders >= 1500:
            $ticketsLeft = 2000 - $currentPreorders;
            $value = '$1.75';
            break;

        case 1500 > $currentPreorders && $currentPreorders >= 1000:
            $ticketsLeft = 1500 - $currentPreorders;
            $value = '$1.50';
            break;

        case 1000 > $currentPreorders && $currentPreorders >= 500:
            $ticketsLeft = 1000 - $currentPreorders;
            $value = '$1.25';
            break;

        default:
            $ticketsLeft = 500 - $currentPreorders;
            $value = '$1.00';
            break;
    }

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>STEEM Caffeinated Peanut Beta</title>
        <meta name="viewport" content="width=900, height=device-height">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta property="og:site_name" content="STEEM Caffeinated Peanut Butter" />
        <meta property="og:title" content="STEEM Peanut Beta" />
        <meta property="og:url" content="http://steempb.com/peanutbeta" />
        <meta property="og:description" content="Pre-order STEEM Caffeinated Peanut butter and join the Peanut Beta today! More pre-orders, bigger discount." />
        <meta property="og:image" content="http://steempb.com/assets/img/facebook_og_pbbbp.png" />


        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">

        <!-- Modernizr -->
        <script type="text/javascript" src="/assets/js/modernizr.min.js"></script>

        <!-- I'm way too lazy to fix nth child on my own -->
        <!--[if lt IE 9]>
            <script src="/assets/js/IE9.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="/assets/ico/favicon.ico">
    </head>

    <body>
        
        <div id="header-home">
            <div class="container">
                <a href="http://steempb.com/peanutbeta"><img id="logo" src="/assets/img/template/logo_beta_big.png" /></a>
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
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li class="social"><a href="https://plus.google.com/106045698028303100415" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a href="#letsgo-wrap" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst half"></div>
        <div id="cta-beta">
            <img src="/assets/img/template/pbbbp_pile.png" />
            <img src="/assets/img/template/equalsign.png" />
            <img id="jar" src="/assets/img/template/jar.png" />
            <img src="/assets/img/template/minussign.png" />
            <?php echo flipperize($value); ?>
            <br />
            <a class="btn btn-large btn-warning steembtn steembtn-large" href="#letsgo-wrap">Get Tickets now <i class="icon-play"></i></a>
        </div>

        <div id="faq-border"></div>
        <div id="faq-wrap">
            <div id="faq-section">
                <div class="row">
                    <div class="span4" style="text-align:right;">
                        <img src="/assets/img/template/beta_welcome.png" title="WHATS ALL THIS HOOTIN' AN HOLLERIN'?" />
                    </div>
                    <div class="span4">
                        <p class="lead" style="font-size:28px; padding-top:15px">
                            For two weeks <em>only</em> ! <br />March 7th - March 21st!
                        </p>
                    </div>
                </div>
                <br />
                <p><strong>COLOSSAL NEWS:</strong> STEEM Caffeinated Peanut Butter will be finally be available for purchase on March 21st, 2014! But why not use the smarts that brought you here in the first place to make sure you're among the first to get your hands on a jar? Then be a part of the STEEM Peanut Beta!</p>

                <p>We want to know how many of you are ready to experience STEEM and change the way you get going each day, so from March 7th to launch day, March 21st, come by the site for a great deal. For the low low cost of ONE DOLLAR, you can buy a <strike>golden</strike> ticket that will be sent to you via e-mail*. Enter the code from your ticket when you're buying your first jar of STEEM Caffeinated Peanut Butter, the ONE DOLLAR you spent will be worth…ONE DOLLAR OFF PER JAR! That's...a little underwhelming, but</p>

                <p><em>BUT WAIT</em></p>

                <p>(here's the good part)</p>

                <p>Notice our little counter down there? Once we’ve sold 500 of these tickets, every ticket will be worth ONE DOLLAR TWENTY-FIVE CENTS ($1.25) OFF PER JAR. So you paid a buck, but because you know a ton of people and they all wanted to buy tickets to be cool like you, now your buck is worth MORE than a buck. The next goal after that is 1,000 tickets sold. Want to find out what your buck will be worth if we get there? Or even past that? Help us reach our goal and you'll find out!</p>

                <p>Tell your friends. Tell your parents. Tell your friends' parents. Make your Friends list beg for mercy. Tell everyone. Because these tickets will ONLY be available during the STEEM Peanut Beta, and the more we sell, the more they're worth when you're buying your first jar. Or second. Or third.</p>

                <p><small>*unless you are harry potter in which case it will most likely be delivered by owl</small></p>
                <div class="row">
                    <div class="span4 centered">
                        <h3>Current Ticket Value</h3>
                        <?php echo flipperize($value); ?>
                    </div>
                    <div class="span4 centered">
                        <h3>Tickets to Next Reward</h3>
                        <?php echo flipperize(str_pad($ticketsLeft, 4, '0', STR_PAD_LEFT)); ?>
                    </div>
                </div>
                <div class="row" id="faq-cta-row">
                        <h1>It's time to get going!</h1><a class="btn btn-large btn-warning steembtn steembtn-large" href="#letsgo-wrap">Get Tickets now <i class="icon-play"></i></a>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>

        <div id="faq-border-bottom"></div>
        
        <div id="letsgo-wrap">
            <div id="jet-fleet">
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
            </div>

            <div id="letsgo">
                <h1>Let's get going!</h1>
                <div id="form-container">
                    <p class="lead">Purchase Pre-Order Tickets and join the <strong>Peanut Beta</strong>!</p>
                    <img id="ticketsCost" src="/assets/img/template/pbbbp_widget_cost.png" />
                    <form class="form-horizontal" method="POST" id="ticketWidget">
                        <input type="hidden" id="inputProduct" value="b8cbfab8-04cd-44ed-b45d-d7dd5bb256c4" />
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Email</label>
                            <div class="controls">
                                <input class="input-xlarge" type="text" id="inputEmail" required placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputQuantity">Quantity</label>
                            <div class="controls">
                                <input class="input-xlarge" type="text" id="inputQuantity" required placeholder="Quantity">
                            </div>
                        </div>
                        <button type="submit" data-paymentMethod="DOGE" class="btn steembtn steembtn-large steembtn-fixed"><strong>Checkout with Ðogecoin</strong></button>
                        <button type="submit" data-paymentMethod="PAYPAL" class="btn steembtn steembtn-large steembtn-fixed"><strong>Checkout with PayPal</strong></button>
                    </form>
                </div>
            </div>
        </div>

        <div id="footer-home">
            All content © STEEM Peanut Butter, Inc., all rights reserved | Contact us: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a>
        </div id="footer-home">

        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/assets/js/retina.js"></script>
        <script type="text/javascript" src="/assets/js/konami.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.easing.1.3.js"></script>
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