<?php

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('Purveyor', 'Syrup');

    $sale = $JACKED->Syrup->Sale->findOne(array('guid' => $_GET['guid']));
    if(!$sale){
        header('Location: ' . $JACKED->config->base_url);
        exit();
    }

    if($_GET['success'] == 'true'){

        if($sale->payment == 'PAYPAL'){
            $tid = $sale->external_transaction_id;

            try{
                $JACKED->Purveyor->executePayPalPayment($tid, $_GET['PayerID']);

                $header = 'Thanks for your order!';
                $image = '/assets/img/template/tickets.png';
                $message = 'Your order has been verified and you will receive an email receipt shortly.';
            }catch(Exception $e){
                $header = 'We had a problem confirming your order';
                $image = False;
                $message = 'Your payment was not confirmed by PayPal and our team has been notified. Please try again later.';
                $JACKED->Logr->write('PayPal verification error:' . $e->getMessage(), Logr::LEVEL_SEVERE);
            }
        }else{
            $header = 'Wow. Such order. Very thanks.';
            $image = '/assets/img/template/dogecoin.png';
            $message = 'Your order has been verified. Once your transaction has reached 4 confirmations on the DogeChain, you\'ll receive an email receipt.';
        }
    }else{
        $header = 'We had a problem confirming your order';
        $image = False;
        $message = 'Your payment was not able to be confirmed by ' . ($sale->payment == 'PAYPAL'? 'PayPal' : 'Moolah') . ' and our team has been notified. Please try again later.';
    }

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
        <link href="/assets/css/static.css" rel="stylesheet">

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

        <script type="text/javascript">
            <?php 
                if($_GET['success'] == 'true'){
                    echo 'var paymentMethod = \'' . $sale->payment . '\'';
                }
            ?>
        </script>
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">


        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li><a class="brand" href="http://steempb.com"><img src="/assets/img/template/logo_small.png" /></a></li>
                        <li><a href="http://steempb.com#faq-border">FAQ</a></li>
                        <li><a href="http://steempb.com/blog">Blog</a></li>
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/twitter.png" /></a></li>
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li class="social"><a href="https://plus.google.com/106045698028303100415" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a href="http://steempb.com#letsgo-wrap" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>
        <div id="page-logo-main">
            <a href="/">
                <img src="/assets/img/template/logo.png" />
            </a>
        </div>
        <div id="jetguy-main"><img src="/assets/img/template/jetguy_medium.png" /></div>

        <div id="page-border"></div>
        <div id="page-wrap">
            <div id="page-section">
                <?php
                    if($image){
                ?>
                <div class="row">
                    <div class="span4">
                        <img src="<?php echo $image; ?>" />
                    </div>
                    <div class="span4">
                        <h1><?php echo $header; ?></h1>
                        <p class="lead">
                            <?php echo $message; ?></h1>
                        </p>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                        <h1><?php echo $header; ?></h1>
                        <p class="lead">
                            <?php echo $message; ?></h1>
                        </p>
                <?php
                    }
                ?>
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
        <script type="text/javascript" src="/assets/js/blog.js"></script>
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