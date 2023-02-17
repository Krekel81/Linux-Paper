<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login to your account</h1>
    <form method="POST" action="api/loginUser">
        <label for="Name">Name:</label>
        <input type="text" name="name" placeholder="Fill in your name" required>
        <label for="Password">Password:</label>
        <input type="password" name="password" placeholder="Fill in your password" required>
        <input type="submit" value="Submit" id="btnSubmit">
    </form>
</body>
</html>