<?php
    date_default_timezone_set('America/New_York');
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
        <link href="/assets/css/main_blog.css" rel="stylesheet">

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
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a href="http://steempb.com#letsgo-wrap" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
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

        <div id="faq-border"></div>
        <div id="faq-wrap">
            <div id="faq-section">
                <div class="row">
                    <h1>Some blog post</h1>
                    <p class="byline">
                        <span class="label <?php echo 'recipes'; ?>"><?php echo 'recipes'; ?></span> <span class="datestamp"><?php echo date("F j, Y", 1234567890); ?></span>
                        <?php
                            //if(!$post->alive){
                            //    echo '<span class="label"><i class="icon-eye-open"></i> DRAFT PREVIEW</span>';
                            //}
                        ?>
                    </p>
                    <p>STEEM is caffeinated peanut butter. What else do we need to say? STEEM is designed to provide a consistent release of sustained energy, and the naturally slow digestion of peanut butter is the key to that. STEEM delivers protein, electrolytes, and caffeine, granting you hours of endurance and focus, and freeing you from distractions like hunger and fatigue.</p>
                    
                    <p>We only use natural and organic ingredients in STEEM, with NO hydrogenated oils and NO high-fructose corn syrup. Enjoy it however you would normally enjoy peanut butter: spread it on crackers, toast or fruit; re-acquaint yourself with the simple perfection of the peanut butter and jelly sandwich; or just jam a knife or a spoon or a finger into the jar and eat it like you do when no one’s looking. Yes you do. Yes, you <em>do</em>.</p>
                    
                    <p>STEEM’s steady release of energy (without the jittery feeling) makes it perfect not only for athletes and active people, but also for normal life. How about never having to choose awful breakroom coffee because you don’t want to spend more on caffeine than you spend on your lunch? How about having enough energy to finish that backyard project in one day instead of putting it off for another weekend? How about when an all-night study session has suddenly become the morning of the test? How about never having to bring that damn percolator on camping trips just so you can avoid the crippling caffeine headache you’ll have by noon? How about not worrying about nodding off in meetings, or in class, or at the wheel? How about just having the energy to get going when you need it?</p>
                    
                    <p><strong>DO NOT GIVE TO ANIMALS. EVER.</strong> A fun fact about caffeine is that a lot of domestic animals, like dogs and cats and birds, cannot digest caffeine properly and it can lead to SERIOUS health issues. So we know that your dog loves peanut butter and we know you think it’d be hilarious to get him all jacked up and crazy, BUT DON’T. SERIOUSLY. IT WOULD NOT BE HILARIOUS. STEEM = PEOPLE FOOD.</p>
                </div>

                <div id="post-post">
                    <div class="tags">
                        <span class="label label-tag recipes"><a href="/tag/some-tag"><i class="icon-tag"></i> some tag</a></span>
                        <span class="label label-tag recipes"><a href="/tag/hats"><i class="icon-tag"></i> hats</a></span>
                        <span class="label label-tag recipes"><a href="/tag/butts"><i class="icon-tag"></i> butts</a></span>
                        <span class="label label-tag recipes"><a href="/tag/lol-and-stuff"><i class="icon-tag"></i> lol and stuff</a></span>
                        <span class="label label-tag recipes"><a href="/tag/longer-tags-are-okay-too"><i class="icon-tag"></i> longer tags are okay too</a></span>
                    </div>

                    <div class="sharesies">
                        <p class="system1">Share this post with your friends <i class="icon-share-alt icon-white"></i></p>
                        <ul id="social-links">
                            <li><a href="http://twitter.com/share?url=<?php echo $templateVars['postURL']; ?>&text=<?php echo rawurlencode($post->title); ?> %23WNV" target="_blank"><img src="/assets/img/template/share_twitter.png" /></a></li>
                            <li><a href="http://plus.google.com/share?url=<?php echo $templateVars['postURL']; ?>" target="_blank"><img src="/assets/img/template/share_gplus.png" /></a></li>
                            <li><a href="http://reddit.com/submit?url=<?php echo $templateVars['postURL']; ?>&title=<?php echo rawurlencode($post->title); ?>" target="_blank"><img src="/assets/img/template/share_reddit.png" /></a></li>
                            <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $templateVars['postURL']; ?>" target="_blank"><img src="/assets/img/template/share_facebook.png" /></a></li>
                        </ul>
                    </div>

                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'steempb'; // required: replace example with your forum shortname
                        var disqus_identifier = 'steempb.local.none; ?>';
                        var disqus_title = "Test post";
                        var disqus_url = 'http://localhost/';

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                </div>
            </div>
        </div>

        <div id="footer-home">
            <a href="http://steempb.com">All content © STEEMPB.com</a>
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