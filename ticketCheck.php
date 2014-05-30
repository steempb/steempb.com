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
                $valid[] = array(
                    'code' => $ticketObj->guid, 
                    'promo_name' => $ticketObj->Promotion->name,
                    'value' => $ticketObj->Promotion->value / 100,
                    'single_use' => $ticketObj->single_use
                );
            }catch(TicketInvalidException $e){
                $invalid[] = array(
                    'code' => $ticket, 
                    'reason' => 'Promo code no longer accepted.'
                );
            }catch(PromotionInactiveException $e){
                $invalid[] = array(
                    'code' => $ticket, 
                    'reason' => 'Promo code no longer accepted.'
                );
            }catch(TicketAlreadyRedeemedException $e){
                $invalid[] = array(
                    'code' => $ticket, 
                    'reason' => 'Promo code already redeemed.'
                );
            }catch(Exception $e){
                $invalid[] = array(
                    'code' => $ticket, 
                    'reason' => 'Promo code not recognized.'
                );
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