<?php
/*These variable will be used to estblish the connection to sql database*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "familia_bakeria";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn === false) {
    die("Connection failed: " .mysqli_connect_error());
}

// Handle login form submission
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password before storing (recommended for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

    mysqli_query($conn, $sql);
     
}

// Handle create account form submission
if (isset($_POST['new-email']) && isset($_POST['new-password'])) {
    $new_email = mysqli_real_escape_string($conn, $_POST['new-email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new-password']);

    // Hash the password before storing (recommended for security)
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES ('$new_email', '$hashed_new_password')";

    mysqli_query($conn, $sql);
    
}

// Handle forgot password form submission
if (isset($_POST['reset-email'])) {
    $reset_email = mysqli_real_escape_string($conn, $_POST['reset-email']);

    // Here you would handle the password reset logic, such as sending an email
    echo "Password reset instructions sent to: " . $reset_email;
}

mysqli_close($conn);
?>
