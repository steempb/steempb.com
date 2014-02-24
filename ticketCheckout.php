<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 17 Jan 1998 05:00:00 GMT");

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('Purveyor', 'Syrup');

    try{
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $method = $_POST['payment'];
        $email = $_POST['email'];

        $user = $JACKED->Syrup->User->findOne(array('email' => $email));
        if(!$user){
            $user = $JACKED->Syrup->User->create();
            $user->email = $email;
            $user->save();    
        }

        $productobj = $JACKED->Syrup->Product->findOne(array('guid' => $product));
        if(!$productobj){
            throw new Exception('Product not found');
        }

        $result = $JACKED->Purveyor->createSale($user->guid, $product, $quantity, $method, $JACKED->config->base_url . 'tomhanks.php', NULL, 'Purchase of Tickets for STEEM Peanut Butter, Inc.\'s Peanut Beta.');

        header('Content-Type: application/json');
        echo json_encode(array('url' => $result['url']));

    }catch(Exception $e){
        header('HTTP/1.1 500 Internal Server Error');
        echo '<h1>A Problem Happened.</h1>';
        echo '<h4>look at it:</h4>';
        echo '<font color="red">' . $e->getMessage() . '</font>';
        echo '<pre>' . print_r($e->getTrace(), true) . '</pre>';
        exit(1);
    }
?>