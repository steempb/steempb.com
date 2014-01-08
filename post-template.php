<?php 
    require('blog_bodyTop.php');
?>

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

<?php 
    require('blog_bodyBottom.php');
?>