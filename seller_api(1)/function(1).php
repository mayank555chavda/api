<?php
include('dbconn.php');


function storedata($storeInput){

    global $conn;
    
    $product_name = mysqli_real_escape_string($conn, $storeInput['product_name']);
    $product_price = mysqli_real_escape_string($conn, $storeInput['product_price']);
    if($product_name == ''){
        echo "Enter Product Name First";
    }
    elseif($product_price == '') {
        echo "Enter Product Price";
    }
    else {
        
   

        $query = "INSERT INTO api (product_name,product_price) VALUES ('$product_name', '$product_price')" ;
    
        $result = mysqli_query($conn, $query);

        if($result){

            $data = [
                'message' => $requestMethod. 'Customer Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            echo json_encode($data);

        }
        else {
            $data = [
                'message' => $requestMethod. 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }
    }
 }

function getCustomerList(){

    global $conn;

    $query = "SELECT * FROM api";
    $query_run = mysqli_query($conn, $query);


    if($query_run){ 

        if(mysqli_num_rows($query_run) > 0){

            $res =  mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            return json_encode($res);
        
        
        }
        else{
            
            $data = [
                'message' => $requestMethod. 'No Customer Found',
            ];
            
            return json_encode($data);

    }

    } else {
        $data = [
            'message' => $requestMethod. 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function getCustomer($customerParams) {
    global $conn;

    if($customerParams['id'] == null){
        return ('Enter your customer id');

    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    
    $query = "SELECT * FROM api WHERE id = '$customerId' LIMIT 1";
    
    
    $result = mysqli_query($conn, $query);
 
    if($result){

        if(mysqli_num_rows($result) == 1 )
        {
            $res = mysqli_fetch_assoc($result);
        
            $data = [
                'message' => $requestMethod. 'Customer Fetched Successfully',
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($res);
        }
        else
        {
            $data = [
                'message' => $requestMethod. 'No Customer Found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }

    } else {
        $data = [
            'message' => $requestMethod. 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    
    }

}

// function updateCustomer($storeInput, $customerParams) {

//     global $conn;

//     if(!isset($customerParams['id'])){

//         return ('customer id not found in URL');

//     } elseif($customerParams['id'] == null) {

//         return ('Enter The Customer id');
//     }

//     $customerId = mysqli_real_escape_string($conn, $storeInput['id']);

//     $name = mysqli_real_escape_string($conn, $storeInput['generate_date']);
//     $last_name = mysqli_real_escape_string($conn, $storeInput['customer_name']);
//     $number = mysqli_real_escape_string($conn, $storeInput['number']);
//     $email = mysqli_real_escape_string($conn, $storeInput['email']);

 

//         $query = "UPDATE api SET name = '$name', last_name ='$last_name', number='$number', email = '$email' WHERE id='$customerId' LIMIT 1 ";
    
//         $result = mysqli_query($conn, $query);

//         if($result){

//             $data = [
//                 'message' => $requestMethod. 'Customer Updated Successfully',
//             ];
//             header("HTTP/1.0 200 Success");
//             echo json_encode($data);

//         }
//         else {
//             $data = [
//                 'message' => $requestMethod. 'Internal Server Error',
//             ];
//             header("HTTP/1.0 500 Internal Server Error");
//             echo json_encode($data);
//         }
    

// }

// function deleteCustomer($customerParams){
//     global $conn;

//     if(!isset($customerParams['id'])){

//         return error422('customer id not found in URL');

//     } elseif($customerParams['id'] == null) {

//         return error422('Enter The Customer id');
//     }

//     $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    
   

//     $query = "DELETE FROM api WHERE id='$customerId' LIMIT 1";
    
//     $result = mysqli_query($conn, $query);
    

//     if($result){

//         $data = [
//             'message' => $requestMethod. 'Customer Deleted Successfully',
//         ];
//         header("HTTP/1.0 204 Deleted OK");
//         echo json_encode($data);

//     }else{
//         $data = [
//             'message' => $requestMethod. 'Customer Not Found',
//         ];
//         header("HTTP/1.0 404 Customer Not Found");
//         echo json_encode($data);
//     }
// }


function updateCustomer($storeInput, $customerParams) {
    global $conn;

    // Check if the 'id' parameter is set in the $customerParams array
    if (!isset($customerParams['id'])) {
        return 'customer id not found in URL';
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);

    // Use $storeInput to get the data to update
    $product_name = mysqli_real_escape_string($conn, $storeInput['product_name']);
    $product_price = mysqli_real_escape_string($conn, $storeInput['product_price']);

    $query = "UPDATE api SET product_name = '$product_name', product_price ='$product_price' WHERE id='$customerId' LIMIT 1 ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'message' => 'Customer Updated Successfully',
        ];
        header("HTTP/1.1 200 OK");
        echo json_encode($data);
    } else {
        $data = [
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode($data);
    }
}

function deleteCustomer($customerParams) {
    global $conn;

    // Check if the 'id' parameter is set in the $customerParams array
    if (!isset($customerParams['id'])) {
        return 'customer id not found in URL';
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);

    $query = "DELETE FROM api WHERE id='$customerId' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'message' => 'Customer Deleted Successfully',
        ];
        header("HTTP/1.1 204 No Content");
        echo json_encode($data);
    } else {
        $data = [
            'message' => 'Customer Not Found',
        ];
        header("HTTP/1.1 404 Customer Not Found");
        echo json_encode($data);
    }
}