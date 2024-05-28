<?php 


include 'dbconn.php';

if(isset($_POST['click']))
{
    // $umail =  "umang@gmail.com";
    // $pass =  "123456s";
    
    $umail =  $_POST['email'];
    $pass =  $_POST['password'];

    $sqluser =  "SELECT * FROM user WHERE email='$umail'";
    $result = mysqli_query($conn, $sqluser);
    $numRows = mysqli_num_rows($result); 
    $row = mysqli_fetch_assoc($result);
    $passofdatabase = $row['password'];
    // echo"here $passofdatabase";
    
    
    if($numRows==1)
    {
        $row = mysqli_fetch_assoc($result);               
        if($pass == $passofdatabase)
        {
            echo"Login Successfully";
          //redirect('index.php');
        }
        else
        {
            echo"Email or Password wrong! Try Again";
           
        }
    }
    else
    {
        // $action = 2;
        // $action_message = "Email or Password wrong! Try Again ";
        echo "<script>alert('Emailwrong! Try Again ')</script>";
        // redirect("login.php");
    }

    //redirect("login.php?loginsuccess=false&error=$showError");
}

$requestMethod =  $_SERVER["REQUEST_METHOD"];

if($requestMethod === 'POST'){
    
     
    
    $umail =  $_POST['email'];
    $pass =  $_POST['password'];

    $sqluser =  "SELECT * FROM user WHERE email='$umail'";
    $result = mysqli_query($conn, $sqluser);
    $numRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $passofdatabase = $_POST['email'];
    
    
    echo "here $_POST email";
    
    
    if($numRows==1)
    {
        $row = mysqli_fetch_assoc($result);
        
        if($pass == $passofdatabase)
        {
            echo"Login Successfully";
          //redirect('index.php');
        }
        else
        {
            echo"Email or Password wrong! Try Again";
           
        }
    }
}
else{
    echo"no Data";
}
?>

<html>
    <form action="" method="POST" >
        <input type="text" name="email"><br>
        <input type="text" name="password"><br>
        <button name="click">
            Click
        </button>
    </form>
</html>

