<?php

  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow0Methd : DELETE');
    header('Access-Control-Allow-Headers: Content-Type');


include('function.php');

$requestMethod =  $_SERVER["REQUEST_METHOD"];

if($requestMethod === "DELETE"){

    

        $deletecustomer = deleteCustomer($_GET);
        echo $deletecustomer;

    

}
else{
    $data = [
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>