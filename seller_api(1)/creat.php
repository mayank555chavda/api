<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: Content-Type');


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
else {
    
    $data = [
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method NNot Allowed");
    echo json_encode($data);

}



?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="product_name" placeholder="Product Name" required><br>
    <input type="number" name="product_price" placeholder="Product Price" required><br>
    <input type="file" name="product_image" accept="image/*" required><br> <!-- Add file input for image -->
    <input type="submit" name="submit" value="Submit">
</form>