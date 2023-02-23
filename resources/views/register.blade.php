<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
</head>
<body>
    <h1>Create account</h1>
    <form method="POST" action="api/user">
        <label for="Name">Name:</label>
        <input type="text" name="name" required maxlength="18">
        <label for="Password">Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Register" id="btnSubmit">
    </form>
    <a href="login">Do you already have an account? Log in here</a>

    <?php
    if(isset($_GET["message"])){
     echo "<p class='error'>". $_GET["message"] ."</p>";
    }
    ?>
</body>
</html>
