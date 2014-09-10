<?php
    if(!isset($templateVars['pageType'])){
        $templateVars['pageType'] = 'system';
    }
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>STEEM Blog<?php echo isset($templateVars['pageTitle'])? ' - ' . $templateVars['pageTitle'] : ''; ?></title>
        <meta name="viewport" content="width=900, height=device-height">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta property="og:site_name" content="STEEM Caffeinated Peanut Butter Blog" />

        <?php if($templateVars['pageType'] == 'post'){ ?>

        <meta property="og:title" content="<?php echo $templateVars['pageTitle']; ?> - STEEM Blog" />
        <meta property="og:url" content="<?php echo $templateVars['postURL']; ?>" />
        <meta property="og:description" content="<?php echo $templateVars['postHeadline']; ?>" />
        <meta property="og:updated_time" content="<?php echo $templateVars['postDatetime']; ?>" />
        <?php } ?>
        <meta property="og:image" content="http://steempb.com/assets/img/facebook_og.png" />


        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/blog.css" rel="stylesheet">

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

        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li><a class="brand" href="http://steempb.com"><img src="/assets/img/template/logo_small.png" /></a></li>
                        <li><a href="http://steempb.com#faq-border">FAQ</a></li>
                        <li class="active"><a href="http://steempb.com/blog">Blog</a></li>
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/twitter.png" /></a></li>
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li class="social"><a href="https://plus.google.com/106045698028303100415" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a href="http://steempb.com" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>
        <div id="blog-logo-main">
            <a href="/blog">
                <img src="/assets/img/template/logo.png" />
                <h1>BLOG</h1>
            </a>
        </div>
        <div id="jetguy-main"><img src="/assets/img/template/jetguy_medium.png" /></div>

        <div id="blog-border"></div>
        <div id="blog-wrap">
            <div id="blog-section">
                <div class="row">
                    <div id="blog-nav">
                        <ul class="nav nav-pills">

                            <?php 
                                $newsActive = "";
                                $babblingActive = "";
                                $htsActive = "";
                                $podcastsActive = "";

                                if(isset($templateVars['contentType'])){
                                    switch($templateVars['contentType']){
                                        case 'news':
                                            $newsActive = ' active';
                                            break;
                                        case 'babbling':
                                            $babblingActive = ' active';
                                            break;
                                        case 'how-to-steem':
                                            $htsActive = ' active';
                                            break;
                                        case 'podcasts':
                                            $podcastsActive = 'active';
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            ?>

                            <li class="<?php echo $newsActive; ?>"><a href="/blog/news">News</a></li>
                            <li class="<?php echo $babblingActive; ?>"><a href="/blog/babbling">Babbling</a></li>
                            <li class="<?php echo $htsActive; ?>"><a href="/blog/how-to-steem">How to STEEM</a></li>
                            <li class="<?php echo $podcastsActive; ?>"><a href="/blog/podcasts">Podcasts</a></li>
                            <li class="spacer">&nbsp;</li>
                            <li class="searchbox">
                                <form method="GET" action="/blog/search">
                                    <input type="search" id="blog-search" name="q" />
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>