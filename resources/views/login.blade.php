<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="api/loginUser">
        <label for="Name">Name:</label>
        <input type="text" name="name" required>
        <label for="Password">Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login" id="btnSubmit">
    </form>
    <a href="register">No account yet? Register here</a>


    <?php
    if(isset($_GET["message"])){
     echo "<p class='error'>". $_GET["message"] ."</p>";
    }
    ?>

</body>
</html>
