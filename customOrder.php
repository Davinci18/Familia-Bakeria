<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn === false){
    die("Connection failed: ".mysqli_connect_error());
}
//handling the custom order request
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['email']) && isset($_POST['first-name'])  && isset($_POST['last-name'])  && isset($_POST['custom-order'])){
               $first_name = mysqli_real_escape_string($conn,$_POST['first-name']);
               $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
               $email = mysqli_real_escape_string($conn,$_POST['email']);
               $custom_order = mysqli_real_escape_string($conn, $_POST['custom-order']);

        //inserting the entered information
        $sql_custom_order = "INSERT INTO customorder (first_name, last_name, email, description) VALUES ('$first_name','$last_name','$email','$custom_order')";
        if(mysqli_query($conn,$sql_custom_order)){
            $message = "Thank you for the custom order!";
        }else{
            $message = "Error: ".mysqli_error($conn);
        }
        echo"<script>window.location.href='customorder.html';
                confirm('$message');
             </script>";
        exit();
    }
}
mysqli_close($conn);

?>