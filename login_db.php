<?php
session_start();


require_once 'Database.php';

$db = new Database();

// for cheching if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
   
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $db->conn->query($sql);
   
    print_r($result);
    if ($result->num_rows > 0) {
        
        $_SESSION["loggedin"] = TRUE;
   
        header("Location: dashboard.php");

        exit();

    }
    else {
        // Authentication failed
        $error_message = "Invalid username or password";

    }
}
