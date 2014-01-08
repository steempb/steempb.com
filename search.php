<?php

    try{
        require('JACKED/jacked_conf.php');
        $JACKED = new JACKED(array('MySQL', 'Syrup'));

        if(!(isset($_GET['q'])) || $_GET['q'] == ''){
            throw new MissingQueryException();
        }

        $q = preg_replace("/[^a-z0-9 ]+/i", "", $_GET['q']);

        $posts = array();
        $terms = explode(" ", $q);
        $fulltextTerms = array();
        $tagCriteria = array();
        foreach($terms as $term){
            $term = strtolower($term);
            if(strpos($JACKED->config->stopwords, ',' . $term . ',') === FALSE){
                // $tagCriteria['OR']['Curator.name LIKE \'%' . $term . '%\' OR \'\' '] = $term; //lol
                $fulltextTerms[] = $term . '*';
            }
        }

        // $tag_posts = $JACKED->Syrup->Blag->find($tagCriteria);

        $query = "SELECT Blag.guid, MATCH(Curator.name) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AS Score 
            FROM Blag, Curator, CuratorRelation WHERE MATCH(Curator.name) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AND CuratorRelation.Curator = Curator.guid AND Blag.guid = CuratorRelation.target AND Blag.alive = 1";
        $tagScores = $JACKED->MySQL->query($query);

        $query = "SELECT guid, MATCH(title) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AS Score 
            FROM Blag WHERE MATCH(title) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AND alive = 1";
        $titleScores = $JACKED->MySQL->query($query);

        $query = "SELECT guid, MATCH(content) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AS Score 
            FROM Blag WHERE MATCH(content) AGAINST ('" . implode(' ', $fulltextTerms) . "' IN BOOLEAN MODE) AND alive = 1";
        $contentScores = $JACKED->MySQL->query($query);

        $guidScores = array();

        if($titleScores){
            foreach($titleScores as $val){
                if(isset($guidScores[$val['guid']])){
                    $guidScores[$val['guid']] += $val['Score'] * 3;
                }else{
                    $guidScores[$val['guid']] = $val['Score'] * 3;
                }
            }
        }
        if($tagScores){
            foreach($tagScores as $val){
                if(isset($guidScores[$val['guid']])){
                    $guidScores[$val['guid']] += $val['Score'] * 2;
                }else{
                    $guidScores[$val['guid']] = $val['Score'] * 2;
                }
            }
        }
        if($contentScores){
            foreach($contentScores as $val){
                if(isset($guidScores[$val['guid']])){
                    $guidScores[$val['guid']] += $val['Score'];
                }else{
                    $guidScores[$val['guid']] = $val['Score'];
                }
            }
        }

        arsort($guidScores);
        $totalResultCount = count($guidScores);

        $postCount = 10;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $guidScores = array_slice($guidScores, ($postCount * $page) - $postCount, $postCount, TRUE);


        $posts = array();
        foreach($guidScores as $guid => $score){
            $posts[] = $JACKED->Syrup->Blag->findOne(array('guid' => $guid));
        }

        $templateVars['pageTitle'] = "Search: " . $q;
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>' . $totalResultCount . '</strong></em> RESULT' . (($totalResultCount == 1)? '' : 'S') . ' FOR "<strong>' . $q . '</strong>"';
        if($page > 1){
            $templateVars['postGrid']['title'] .= ' <em><small>PAGE ' . $page . '</small></em>';
        }

        if(count($posts) > 0){
            $templateVars['pager'] = array();
            $templateVars['pager']['pageNum'] = $page;
            $templateVars['pager']['hasNext'] = ($totalResultCount > ($postCount * $page));
            $templateVars['pager']['nextPageLink'] = '/blog/search?q=' . $_GET['q'] . '&page=' . ($page + 1);
            $templateVars['pager']['prevPageLink'] = '/blog/search?q=' . $_GET['q'] . '&page=' . ($page - 1);
        }

    }catch(MissingQueryException $e){
        $posts = array();
        $templateVars['pageTitle'] = "Search";
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em>NO SEARCH TERMS PROVIDED</strong>';
    }catch(Exception $e){
        $posts = array();
        $templateVars['pageTitle'] = "Search: " . $q;
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>0</strong></em> RESULTS FOR "<strong>' . $q . '</strong>"';
    }

    require('blog_bodyTop.php');
    require('blog_bodyPostGrid.php');

    require('blog_bodyBottom.php');



    class MissingQueryException extends Exception{
        protected $message = 'No search terms provided.';
    }
?>