<?php

namespace App;

session_start();

use App\Database;
$db = new Database();
/**
 * Login db class for authentication
 */
class Login_db
{
    /**
     * constructor for authentication
     */
    public function __construct()
    {
        global $db;

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $result = $db->conn->query($sql);

            print_r($result);
            if ($result->num_rows > 0) {

                $_SESSION["loggedin"] = TRUE;

                header("Location: /dashboard");

                exit();

            } else {
                $error_message = "Invalid username or password";
            }
        }
    }
}
$login = new Login_db;