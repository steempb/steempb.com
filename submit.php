<?php
    if(!(isset($_POST['getgoing']) && $_POST['getgoing'] == 'more_like_peanut_BETTER')){
        header('Location: http://steempb.com');
        exit();
    }

    include('../steem_config.php');

    /**
     * Generates pseudo-random VALID RFC 4211 COMPLIANT Universally Unique IDentifiers (UUID) version 4.
     * As found here: http://www.php.net/manual/en/function.uniqid.php#94959
     * 
     * @return string The generated UUID
     */
    function uuid4(){
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    try{
        sleep(3);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $postalCode = $_POST['postalCode'];
        $guid = uuid4();

        $obj = new mysqli($steemConfig['host'], $steemConfig['user'], $steemConfig['password'], $steemConfig['schema']);
        if ($obj->connect_errno) {
            throw new Exception("Connect failed: " . $obj->connect_error);
        }

        $obj->autocommit(true);

        $query = "INSERT INTO InfoRequest (`guid`, `name`, `email`, `postal_code`) VALUES ('$guid', '$name', '$email', '$postalCode')";
        if(!$obj->query($query)){
            throw new Exception("Error: " . $obj->error);
        }

        $obj->close();

    }catch(Exception $e){
        header('HTTP/1.1 500 Internal Server Error');
        error_log($e->getMessage());
        exit();
    }

?>