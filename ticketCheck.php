<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 17 Jan 1998 05:00:00 GMT");

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('Purveyor', 'Syrup');

    try{
        $tickets = $_POST['tickets'];

        if($tickets){
            $tickets = array_map("trim", explode(",", $tickets));
        }

        $valid = array();
        $invalid = array();

        foreach($tickets as $ticket){
            try{
                $ticketObj = $JACKED->Purveyor->validateTicket($ticket);
                $valid[] = array($ticketObj->guid => $ticketObj->Promotion->value);
            }catch(TicketInvalidException $e){
                $invalid[] = array($ticket => 'This promo code is no longer accepted.');
            }catch(PromotionInactiveException $e){
                $invalid[] = array($ticket => 'This promo code is no longer accepted.');
            }catch(TicketAlreadyRedeemedException $e){
                $invalid[] = array($ticket => 'This promo code has already been redeemed.');
            }catch(Exception $e){
                $invalid[] = array($ticket => 'This promo code was not found.');
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array('valid' => $valid, 'invalid' => $invalid));

    }catch(Exception $e){
        header('HTTP/1.1 500 Internal Server Error');
        echo '<h1>A Problem Happened.</h1>';
        echo '<h4>look at it:</h4>';
        echo '<font color="red">' . $e->getMessage() . '</font>';
        // echo '<pre>' . print_r($e->getTrace(), true) . '</pre>';
        exit(1);
    }
?>