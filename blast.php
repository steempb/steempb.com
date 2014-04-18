<?php
exit();
    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED('Purveyor', 'Syrup');

    $tickets = $JACKED->Syrup->Ticket->find(array('Product' => '2d0727ce-bbe6-41fe-aef0-729fd768d984', 'redeemed' => NULL));

    $count = 0;
    $success = 0;
    $failure = 0;

    $emails = array();
    foreach($tickets as $ticket){
        if(!in_array($ticket->User->email, $emails)){
            $emails[] = $ticket->User->email;
        }
    }

    $total = count($emails);
    
    $template = file_get_contents(JACKED_SITE_ROOT . 'assets/html/beta-increase-notification-email.htm');

    $data = array(
        'client_name' => 'STEEM Caffeinated Peanut Butter',
        'client_url' => 'http://steempb.com/',
        'client_email' => 'steempb@steempb.com',
        'current_year' => '2014'
    );

    $content = $template;

    foreach($data as $key => $value){
        $content = str_replace('{'.$key.'}', $value, $content);
    }

    foreach($emails as $email){
        // $done = $JACKED->Purveyor->sendMail(
        //     $email,
        //     'notifications@steempb.com',
        //     'STEEM Caffeinated Peanut Butter',
        //     'Alright, You Win.',
        //     $content
        // );
        
        echo "sent to: ";
        echo $email;
        echo $done? ' <font color="green">yes</font>' : '<font color="red">no</font>';
        echo '<br />';
        $count++;
        if($done){
            $success++;
        }else{
            $failure++;
        }
    }

    echo "<br />done $count/$total (<font color=\"green\">$success</font>/<font color=\"red\">$failure</font>)";

?>