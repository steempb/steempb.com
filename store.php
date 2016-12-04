<?php

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED(array('DatasBeard', 'Syrup'));

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>STEEM Store</title>
        <meta name="viewport" content="width=900, height=device-height">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta property="og:site_name" content="STEEM Store" />
        <meta property="og:title" content="STEEM Caffeinated Peanut Butter Store" />
        <meta property="og:url" content="http://steempb.com/store" />
        <meta property="og:description" content="STEEM is caffeinated peanut butter. What else do we need to say? Buy some!" />
        <meta property="og:image" content="http://steempb.com/assets/img/facebook_og.png" />


        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">
        <link href="/assets/css/store.css" rel="stylesheet">
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

    <body class="store">

        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li><a class="brand" href="#header-home"><img src="/assets/img/template/logo_small.png" /></a></li>
                        <li><a href="/store">Store</a></li>
                        <li><a href="/#faq-border">FAQ</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/twitter.png" /></a></li>
                        <li class="social"><a href="http://instagram.com/steempb" target="_blank"><img src="/assets/img/template/instagram.png" /></a></li>
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li><a data-checkout-stage="begin" href="#cta-main" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>
        <div id="store-logo-main">
            <img src="/assets/img/template/logo.png" />
            <h1>Store</h1>
        </div>
        <div id="jetguy-main"><img src="/assets/img/template/jetguy_medium.png" /></div>

        <div id="store-border"></div>
        <div id="store-wrap">
            <div id="store-section">

            <?php
                $alternator = 0;
                $products = $JACKED->Syrup->Product->find(array('active' => true));
                foreach($products as $product){
                    switch($alternator % 3){
                        case '0':
                            $class = 'stripe-1';
                            break;
                        case '1':
                            $class = 'stripe-2';
                            break;
                        case '2':
                            $class = 'stripe-3';
                            break;
                    }
            ?>
                <div class="row store-entry <?php echo $class; ?>">
                    <?php
                        if($alternator % 2 === 0){
                    ?>
                    <div class="span3">
                        <img src="<?php echo $product->image; ?>" />
                    </div>
                    <?php
                        }
                    ?>

                    <div class="span7">
                        <h1><?php echo $product->name; ?></h1>
                        <p><?php echo $product->description; ?></p>
                        <p class="lead">$<?php echo ($product->cost / 100); ?></p>
                        <a class="btn btn-large btn-warning steembtn steembtn-large">Add to Cart <i class="icon-play"></i></a>
                    </div>

                    <?php
                        if($alternator % 2 === 1){
                    ?>
                    <div class="span3">
                        <img src="<?php echo $product->image; ?>" />
                    </div>
                    <?php
                        }
                    ?>
                </div>
            <?php
                    $alternator++;
                }
            ?>
            </div>        
        </div>        

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
        <script type="text/javascript">

            // data from DatasBeard
            <?php
                // shirts from datasbeard
                $shirts = array();
                $rows = $JACKED->DatasBeard->getRows('c5514c42-c65f-445a-b9ca-6a089772e672');
                $shirtsAvailable = false;
                foreach($rows as $row){
                    $availability = ((bool) $row['Available'] > 0);
                    $shirts[$row['Color']][$row['Size']] = $availability;
                    $shirtsAvailable = $shirtsAvailable || $availability;
                }
                echo 'var shirtAvailability = ' . json_encode($shirts) . ';';
                echo 'var shirtsUnavailable = ' . ($shirtsAvailable? 'false' : 'true') . ';';
            ?>

        </script>
        <script type="text/javascript" src="/assets/js/store.js"></script>
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
