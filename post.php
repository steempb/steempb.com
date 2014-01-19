<?php

    try{
        require('JACKED/jacked_conf.php');
        $JACKED = new JACKED(array('Syrup', 'admin', 'MySQL'));

        if(!(isset($_GET['postid']) && is_string($_GET['postid']))){
            throw new MissingPostIDException();
        }

        $templateVars['postid'] = $_GET['postid'];

        $post = $JACKED->Syrup->Blag->findOne(array('guid' => $templateVars['postid']));
        if(!$post){
            throw new InvalidPostIDException($templateVars['postid']);
        }

        if(!$post->alive){
            if(!$JACKED->admin->checkLogin()){
                throw new InvalidPostIDException($templateVars['postid']);
            }
        }

        $templateVars['pageType'] = 'post';
        $templateVars['pageTitle'] = $post->title;
        $templateVars['contentType'] = str_replace(' ', '-', strtolower($post->category->name));
        $templateVars['postURL'] = $JACKED->config->base_url . 'blog/post/' . $post->guid;
        $templateVars['postHeadline'] = htmlentities($post->headline);
        $templateVars['postDatetime'] = date('c', $post->posted);

        include('blog_bodyTop.php');
?>

                <div class="row">
                    <h1><?php echo $post->title; ?></h1>
                    <p class="byline">
                        <span class="label <?php echo $templateVars['contentType']; ?>"><?php echo $post->category->name; ?></span> <span class="datestamp"><?php echo date("F j, Y", $post->posted); ?></span>
                        <?php
                            if(!$post->alive){
                               echo '<span class="label"><i class="icon-eye-open"></i> DRAFT PREVIEW</span>';
                            }
                        ?>
                    </p>
                    
                    <?php echo $post->content; ?>

                </div>

                <div id="post-post">
                    <div class="tags">
                        <?php
                        foreach($post->Curator as $tag){
                            echo '<span class="label label-tag ' . $templateVars['contentType'] . '"><a href="/blog/tag/' . $tag->canonicalName . '"><i class="icon-tag"></i> ' . $tag->name . '</a></span>' . "\n";
                        }
                        ?>
                    </div>

                    <div class="sharesies">
                        <p class="system1">Share this post with your friends <i class="icon-share-alt icon-white"></i></p>
                        <ul id="social-links">
                            <li><a href="http://twitter.com/share?url=<?php echo $templateVars['postURL']; ?>&text=<?php echo rawurlencode($post->title); ?> %23GetGoing" target="_blank"><img src="/assets/img/template/share_twitter.png" /></a></li>
                            <li><a href="http://plus.google.com/share?url=<?php echo $templateVars['postURL']; ?>" target="_blank"><img src="/assets/img/template/share_gplus.png" /></a></li>
                            <li><a href="http://reddit.com/submit?url=<?php echo $templateVars['postURL']; ?>&title=<?php echo rawurlencode($post->title); ?>" target="_blank"><img src="/assets/img/template/share_reddit.png" /></a></li>
                            <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $templateVars['postURL']; ?>" target="_blank"><img src="/assets/img/template/share_facebook.png" /></a></li>
                        </ul>
                    </div>

                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'steempb'; // required: replace example with your forum shortname
                        var disqus_identifier = 'steempb.<?php echo $JACKED->config->environment; ?>.<?php echo $post->guid; ?>';
                        var disqus_title = "<?php echo $post->title; ?>";
                        var disqus_url = '<?php echo $templateVars['postURL']; ?>';

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

        
    }catch(InvalidPostIDException $ie){
        $templateVars['error'] = array();
        $templateVars['error']['message'] = 'INVALID POST ID';
        include('blog_bodyTop.php');
        include('blog_bodyError.php');
    }catch(MissingPostIDException $ie){
        $templateVars['error'] = array();
        $templateVars['error']['message'] = 'NO POST ID PROVIDED';
        include('blog_bodyTop.php');
        include('blog_bodyError.php');
    }catch(Exception $e){
        $templateVars['error'] = array();
        $templateVars['error']['message'] = 'SERVER ERROR: ' . $e->getMessage();
        include('blog_bodyTop.php');
        include('blog_bodyError.php');
    }
    
    require('blog_bodyBottom.php');



    class MissingPostIDException extends Exception{
        protected $message = 'No post ID provided.';
    }

    class InvalidPostIDException extends Exception{
        public function __construct($id, $code = 0, Exception $previous = null){
            $message = "Could not find a post with id: $id.";
            
            parent::__construct($message, $code, $previous);
        }
    }

?>