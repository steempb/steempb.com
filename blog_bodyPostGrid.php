                <h3 class="debold"><?php echo $templateVars['postGrid']['title']; ?></h3>

                <?php 
                    foreach($posts as $post){
                        $postType = str_replace(' ', '-', strtolower($post->category->name));
                ?>
                <div class="row">
                    <h1><a href="/blog/post/<?php echo $post->guid; ?>"><?php echo $post->title; ?></a></h1>
                    <p class="byline">
                        <span class="label <?php echo $postType; ?>"><?php echo $post->category->name; ?></span> <span class="datestamp"><?php echo date("F j, Y", $post->posted); ?></span>
                    </p>
                    <p class="lead"><?php echo $post->headline; ?></p>

                    <a href="/blog/post/<?php echo $post->guid; ?>"><p class="byline">Read more <i class="icon-share-alt"></i></p></a>
                </div>                    
                <?php
                    }
                ?>

                    <?php 
                    if(isset($templateVars['pager'])){
                        echo '
                    <div class="row">
                        <ul class="pager pull-right">';
                        if($templateVars['pager']['pageNum'] == 1){
                            echo'
                            <li class="disabled">
                                <a>&larr; Newer</a>';
                        }else{
                            echo '
                            <li>    
                                <a href="' . $templateVars['pager']['prevPageLink'] . '">&larr; Newer</a>';
                        }
                        echo '
                            </li>';
                        if(!$templateVars['pager']['hasNext']){
                            echo '
                            <li class="disabled">
                                <a>Older &rarr;</a>';
                        }else{
                            echo '
                            <li>
                                <a href="' . $templateVars['pager']['nextPageLink'] . '">Older &rarr;</a>';
                        }
                        echo '
                            </li>
                        </ul>
                    </div>';
                    }
                    ?>