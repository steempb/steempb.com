<?php

    try{
        require('JACKED/jacked_conf.php');
        $JACKED = new JACKED(array('MySQL', 'Syrup'));

        if(!(isset($_GET['tagname']) && is_string($_GET['tagname']))){
            throw new MissingTagException();
        }

        $order = FALSE;
        if(isset($_GET['order'])){
            $o = strtoupper($_GET['order']);
            if($o == 'DESC' || $o == 'ASC'){
                $order = $o;
            }
        }

        $tagName = $JACKED->MySQL->sanitize(trim($_GET['tagname']));

        $postCount = 20;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        // $totalResultCount = count($JACKED->Syrup->Blag->find(
        //     array('AND' => array('Curator.canonicalName' => $tagName, 'alive' => 1))
        // ));

        $totalResultCountRes = $JACKED->MySQL->query(
            "SELECT COUNT(Blag.guid) AS cnt FROM Blag, Curator, CuratorRelation 
            WHERE Blag.alive = 1 AND Blag.guid = CuratorRelation.target AND Curator.guid = CuratorRelation.Curator AND Curator.canonicalName = '" . $tagName . "'"
        );
        $totalResultCount = $totalResultCountRes[0]['cnt'];

        $posts = $JACKED->Syrup->Blag->find(
            array('AND' => array('Curator.canonicalName' => $tagName, 'alive' => 1)),
            array('field' => 'posted', 'direction' => ($order? $order : 'DESC')),
            $postCount,
            (($postCount * $page) - $postCount)
        );
        $mainTag = $JACKED->Syrup->Curator->findOne(array('canonicalName' => $tagName));

        if(!$posts){
            throw new Exception("No posts found");
        }

        $templateVars['pageTitle'] = "Tag: " . $mainTag->name;
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>' . $totalResultCount . '</strong></em> POSTS TAGGED WITH "<strong>' . $mainTag->name . '</strong>"';
        if($page > 1){
            $templateVars['postGrid']['title'] .= ' <em><small>PAGE ' . $page . '</small></em>';
        }

        $templateVars['pager'] = array();
        $templateVars['pager']['pageNum'] = $page;
        $templateVars['pager']['hasNext'] = ($totalResultCount > ($postCount * $page));
        $templateVars['pager']['nextPageLink'] = '/blog/tag/' . $_GET['tagname'] . '/' . ($page + 1);
        $templateVars['pager']['prevPageLink'] = '/blog/tag/' . $_GET['tagname'] . '/' . ($page - 1);

    }catch(MissingTagException $e){
        $posts = array();
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em>NO TAG PROVIDED</strong>';
    }catch(Exception $e){
        $posts = array();
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>0</strong></em> POSTS TAGGED WITH "<strong>' . $_GET['tagname'] . '</strong>"';
    }

    require('blog_bodyTop.php');
    require('blog_bodyPostGrid.php');
    require('blog_bodyBottom.php');



    class MissingTagException extends Exception{
        protected $message = 'No canonical tag name provided.';
    }
?>