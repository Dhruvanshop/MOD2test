<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/style/login.css">
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="/Login_db">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="submit">Login</button>
    </form>

    <?php if (isset($error_message))
        echo "<p>$error_message</p>"; ?>

</body>

</html>