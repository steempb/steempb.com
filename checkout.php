<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 17 Jan 1998 05:00:00 GMT");

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('Purveyor', 'Syrup');

    $resultData = array();

    try{
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $method = $_POST['payment'];
        $email = $_POST['email'];
        $tickets = $_POST['tickets'];

        if($product == 'a4c1b91a-1a6d-422b-848e-ad662370fa36'){
            $shipping = 0;
            $dimensions = array(
                'Size' => $_POST['size'],
                'Color' => $_POST['color']
            );
        }else{
            $shipping = 6.75;
            $dimensions = NULL;
        }

        if($tickets){
            $tickets = array_map("trim", explode(",", $tickets));
        }

        // SEE steempb/steempb.com#42
        if($method == 'DOGE'){
            if(!$tickets){
                $tickets = array();
            }
            for($i = 0; $i < $quantity; $i++){
                $tickets[] = 'DOGECOIN20INTERNAL';
            }
        }

        $user = $JACKED->Syrup->User->findOne(array('email' => $email));
        if(!$user){
            $user = $JACKED->Syrup->User->create();
            $user->email = $email;
            $user->save();    
        }

        $recipient_name = $_POST['recipient_name'];
        $line1 = $_POST['line1'];
        $line2 = isset($_POST['line2'])? $_POST['line2'] : '';
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $state = $_POST['state'];
        $country = 'US';

        $newAddr = $JACKED->Syrup->ShippingAddress->create();

        $newAddr->User = $user->guid;
        $newAddr->recipient_name = $recipient_name;
        $newAddr->line1 = $line1;
        $newAddr->line2 = $line2;
        $newAddr->city = $city;
        $newAddr->postal_code = $postal_code;
        $newAddr->state = $state;
        $newAddr->phone = '';
        $newAddr->country = $country;

        $newAddr->save();

        $shippingAddr = $newAddr->guid;

        $productobj = $JACKED->Syrup->Product->findOne(array('guid' => $product));
        if(!$productobj){
            throw new Exception('Product not found');
        }

        $result = $JACKED->Purveyor->createSale($user->guid, $product, $quantity, $method, $JACKED->config->base_url . 'tomhanks.php', $dimensions, $shippingAddr, $shipping, 'STEEM Caffeinated Peanut Butter', $tickets);

        if(!filter_var($result['url'], FILTER_VALIDATE_URL)){
            throw new Exception('Unable to create sale with ' . ($method == 'DOGE')? 'Moolah' : 'PayPal');
        }else{
            $resultData['url'] = $result['url'];
        }

    }catch(Exception $e){
        //until Purveyor has better exceptions, we have to guess.
        switch($e->getMessage()){
            case 'Unsupported Payment method.':
                header('HTTP/1.1 400 Bad Request');
                $resultData['error'] = array('code' => 'invalid_payment_method', 'message' => 'Unrecognized payment method.');
                break;

            case 'Product not found':
                header('HTTP/1.1 400 Bad Request');
                $resultData['error'] = array('code' => 'invalid_product', 'message' => 'Unrecognized product.');
                break;

            case 'Too many Tickets to redeem with this quantity.':
                header('HTTP/1.1 400 Bad Request');
                $resultData['error'] = array('code' => 'ticket_quantity_mismatch', 'message' => 'More tickets added than products.');
                break;

            default:
                header('HTTP/1.1 500 Internal Server Error');
                $resultData['error'] = array('code' => 'generic_error', 'message' => $e->getMessage());
                break;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($resultData);

?>