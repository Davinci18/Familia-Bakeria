<?php

/*These variable will be used to estblish the connection to sql database*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn === false) {
    die("Connection failed: " .mysqli_connect_error());
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

    //checking if user is in database
    $sql = "SELECT * FROM testing WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        //email was found, now verify password
        $password_row = mysqli_fetch_assoc($result);
        //Now you compare the password the user gave($password) with the password in the database which is stored under 'password'
        if($password == $password_row['password']){
            $message = "login succesful!";
        }else{
            $message ="Invalid password.";
        }
    }else{
        $message = "The email was not found.";
    }
    echo"<script>window.location.href='index.html';
        confirm('$message');
        </script>";
    exit();
    }
}

// Handle create account form submission
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['new-email']) && isset($_POST['new-password'])) {
    $new_email = mysqli_real_escape_string($conn, $_POST['new-email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new-password']);

    $sql = "SELECT * FROM testing WHERE email = '$new_email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        $message = "This email already exists. Please eneter a different email.";
    }else{
        //since email doesnt exist create a new one with the given information
        $sql_insert_acc = "INSERT INTO testing(email, password) VALUES ('$new_email','$new_password')";
        if(mysqli_query($conn, $sql_insert_acc)){
            $message = "Account created!";
        }else{
            $message = "Error: ".mysqli_error($conn);
        }
    }
}
echo"<script>window.location.href='index.html';
            confirm('$message');
    </script>";
    exit();
}

// Handle forgot password form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['reset-email'])) {
    $reset_email = "Forgot password process has been sent to: ". mysqli_real_escape_string($conn, $_POST['reset-email']) ." Please check your email.";

    // Here you would handle the password reset logic, such as sending an email
    echo "<script>window.location.href='index.html';
            confirm('$reset_email');
        </script>";
        exit();
}
}

mysqli_close($conn);
?>
