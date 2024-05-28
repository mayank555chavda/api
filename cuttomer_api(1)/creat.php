<?php
include('dbconn.php');

header('Access-Control-Allow-Origin:*');
// header('Access-Control-Allow-Credentials:true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods : POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');


include('function.php');

$requestMethod =  $_SERVER["REQUEST_METHOD"];

     
     
     if($requestMethod === 'POST'){
         $inputData = json_decode(file_get_contents("php://input"), true);
         if(empty($inputData)){
             $storedata = storedata($_POST);
         }else{
             $storedata = storedata($inputData);
         }
         echo $storedata;
         
     }
?>