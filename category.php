<?php

    try{
        require('JACKED/jacked_conf.php');
        $JACKED = new JACKED(array('MySQL', 'Syrup'));

        if(!(isset($_GET['catname']) && is_string($_GET['catname']))){
            throw new MissingCategoryException();
        }

        $postCount = 10;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $category = $JACKED->Syrup->BlagCategory->findOne(array('name' => trim(str_replace('-', ' ', strtolower($_GET['catname'])))));
        if(!$category){
            throw new Exception("No posts found");
        }

        // $totalResultCount = count($JACKED->Syrup->Blag->find(
        //     array('AND' => array('category.guid' => $category->guid, 'alive' => 1)))
        // ));

        $totalResultCountRes = $JACKED->MySQL->query(
            "SELECT COUNT(*) AS cnt FROM Blag WHERE category = '" . $category->guid . "' AND alive = 1"
        );
        $totalResultCount = $totalResultCountRes[0]['cnt'];

        $posts = $JACKED->Syrup->Blag->find(
            array('AND' => array('category.guid' => $category->guid, 'alive' => 1)), 
            array('field' => 'posted', 'direction' => 'DESC'),
            $postCount,
            (($postCount * $page) - $postCount)
        );

        if(!$posts){
            throw new Exception("No posts found");
        }

        $templateVars['pageTitle'] = $category->name;
        $templateVars['contentType'] = str_replace(' ', '-', strtolower($category->name));
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>' . $totalResultCount . '</strong></em> ' . strtoupper($category->name);
        if($page > 1){
            $templateVars['postGrid']['title'] .= ' <em><small>PAGE ' . $page . '</small></em>';
        }
        
        $templateVars['pager'] = array();
        $templateVars['pager']['pageNum'] = $page;
        $templateVars['pager']['hasNext'] = ($totalResultCount > ($postCount * $page));
        $templateVars['pager']['nextPageLink'] = '/blog/' . $_GET['catname'] . '/' . ($page + 1);
        $templateVars['pager']['prevPageLink'] = '/blog/' . $_GET['catname'] . '/' . ($page - 1);

    }catch(MissingCategoryException $e){
        $posts = array();
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em>NO CATEGORY GIVEN</em>';
    }catch(Exception $e){
        $posts = array();
        $templateVars['contentType'] = str_replace(' ', '-', strtolower($_GET['catname']));
        $templateVars['postGrid'] = array();
        $templateVars['postGrid']['title'] = '<em><strong>0</strong></em> POSTS IN CATEGORY: "<strong>' . $_GET['catname'] . '</strong>"';
    }

    require('blog_bodyTop.php');
    require('blog_bodyPostGrid.php');
    require('blog_bodyBottom.php');



    class MissingCategoryException extends Exception{
        protected $message = 'No category name provided.';
    }
?>