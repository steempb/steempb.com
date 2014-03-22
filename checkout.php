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
        $shipping = $_POST['shipping'];
        $tickets = $_POST['tickets'];

        if($tickets){
            $tickets = array_map(trim, explode(",", $tickets));
        }

        $user = $JACKED->Syrup->User->findOne(array('email' => $email));
        if(!$user){
            $user = $JACKED->Syrup->User->create();
            $user->email = $email;
            $user->save();    
        }

        $recipient_name = $_POST['recipient_name'];
        $line1 = $_POST['line1'];
        $line2 = $_POST['line2'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];

        $newAddr = $JACKED->Syrup->ShippingAddress->create();

        $newAddr->User = $user->guid;
        $newAddr->recipient_name = $recipient_name;
        $newAddr->line1 = $line1;
        $newAddr->line2 = $line2;
        $newAddr->city = $city;
        $newAddr->postal_code = $postal_code;
        $newAddr->state = $state;
        $newAddr->phone = $phone;
        $newAddr->country = $country;

        $newAddr->save();

        $shippingAddr = $newAddr->guid;

        $productobj = $JACKED->Syrup->Product->findOne(array('guid' => $product));
        if(!$productobj){
            throw new Exception('Product not found');
        }

        $result = $JACKED->Purveyor->createSale($user->guid, $product, $quantity, $method, $JACKED->config->base_url . 'tomhanks.php', $shippingAddr, $shipping, 'STEEM Caffeinated Peanut Butter', $tickets);

        header('Content-Type: application/json');
        echo json_encode(array('url' => $result['url']));

    }catch(Exception $e){
        header('HTTP/1.1 500 Internal Server Error');
        echo '<h1>A Problem Happened.</h1>';
        echo '<h4>look at it:</h4>';
        echo '<font color="red">' . $e->getMessage() . '</font>';
        // echo '<pre>' . print_r($e->getTrace(), true) . '</pre>';
        exit(1);
    }
?>