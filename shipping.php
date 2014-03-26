<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 17 Jan 1998 05:00:00 GMT");

    require('JACKED/jacked_conf.php');
    $JACKED = new JACKED();

    try{

        // code lifted from fedex example
        //   oh dear god please forgive me 

        if($_POST['country'] == 'US'){
            if($_POST['state'] == 'HI' || $_POST['state'] == 'AK'){
                $shippingMethod = 'FEDEX_FREIGHT_ECONOMY';
            }else{
                $shippingMethod = 'GROUND_HOME_DELIVERY';
            }
        }elseif($_POST['country'] == 'CA'){
            $shippingMethod = 'INTERNATIONAL_GROUND';
        }else{
            $shippingMethod = 'INTERNATIONAL_ECONOMY';
        }

        $lines = array($_POST['line1']);
        if(isset($_POST['line2'])){
            $lines[] = $_POST['line2'];
        }

        $recipient = array(
            'Contact' => array(
                'PersonName' => $_POST['recipient_name'],
                'PhoneNumber' => $_POST['phone']
            ),
            'Address' => array(
                'StreetLines' => $lines,
                'City' => $_POST['city'],
                'StateOrProvinceCode' => $_POST['state'],
                'PostalCode' => $_POST['postal_code'],
                'CountryCode' => $_POST['country'],
                'Residential' => true
            )
        );
        $path_to_wsdl = JACKED_SITE_ROOT . "assets/php/RateService_v14.wsdl";

        ini_set("soap.wsdl_cache_enabled", "0");
 
        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

        $request['WebAuthenticationDetail'] = array(
            'UserCredential' =>array(
                'Key' => 'qOR3t5ckp1qQOBLn', 
                'Password' => 'Ch7eOwb6GPseJkzGgu7ORTGmB'
            )
        ); 

        $request['ClientDetail'] = array(
            'AccountNumber' => '526488601', 
            'MeterNumber' => '106325591'
        );

        $request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request v14 using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'crs', 
            'Major' => '14', 
            'Intermediate' => '0', 
            'Minor' => '0'
        );
        $request['ReturnTransitAndCommit'] = true;
        $request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP';
        $request['RequestedShipment']['ShipTimestamp'] = date('c');
        $request['RequestedShipment']['ServiceType'] = $shippingMethod;
        $request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; 
        // $request['RequestedShipment']['TotalInsuredValue']=array(
        //     'Ammount'=>100,
        //     'Currency'=>'USD'
        // );
        $request['RequestedShipment']['Shipper'] = array(
            'Contact' => array(
                'CompanyName' => 'STEEM Peanut Butter, Inc.',
                'PhoneNumber' => '4132228948'
            ),
            'Address' => array(
                'StreetLines' => array('324 Wells St'),
                'City' => 'Greenfield',
                'StateOrProvinceCode' => 'MA',
                'PostalCode' => '01301',
                'CountryCode' => 'US'
            )
        );
        $request['RequestedShipment']['Recipient'] = $recipient;
        $request['RequestedShipment']['ShippingChargesPayment'] = array(
            'PaymentType' => 'SENDER',
            'Payor' => array(
                'ResponsibleParty' => array(
                    'AccountNumber' => '526488601',
                    'CountryCode' => 'US'
                )
            )
        );
        $request['RequestedShipment']['RateRequestTypes'] = 'ACCOUNT'; 
        $request['RequestedShipment']['RateRequestTypes'] = 'LIST'; 
        $request['RequestedShipment']['PackageCount'] = '1';
        $request['RequestedShipment']['RequestedPackageLineItems'] = array(
            'SequenceNumber'=>1,
            'GroupPackageCount'=>1,
            'Weight' => array(
                'Value' => $_POST['weight'],
                'Units' => 'LB'
            ),
            'Dimensions' => array(
                'Length' => 8,
                'Width' => 6,
                'Height' => 4,
                'Units' => 'IN'
            )
        );

        $response = $client -> getRates($request);
        if($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR'){
            $valid = 'true';
            // temp fixed pricing, see steempb/steempb.com#35
            if($_POST['country'] == 'US' && !($_POST['state'] == 'HI' || $_POST['state'] == 'AK')){
                $cost = '6.75';
            }else{
                $cost = $response->RateReplyDetails->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;
            }
        }else{
            $valid = 'false';
            $cost = 0;
            print_r($response->Notifications);
        }

        header('Content-Type: application/json');
        echo json_encode(array('valid' => $valid, 'cost' => sprintf("%01.2f", $cost)));

    }catch(Exception $e){
        header('HTTP/1.1 500 Internal Server Error');
        echo '<h1>A Problem Happened.</h1>';
        echo '<h4>look at it:</h4>';
        echo '<font color="red">' . $e->getMessage() . '</font>';
        echo '<pre>' . print_r($e->getTrace(), true) . '</pre>';
        exit(1);
    }
?>