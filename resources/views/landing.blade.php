<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
</head>
<body>
    <h1>Welcome { {{$user->name}} }!</h1>
    <p>Click on the button below to generate a random word</p>

    <form method="GET">
        <button name="btnRandom">Click me</button>
    </form>

    <?php
    if (isset($_GET['btnRandom'])) {
        $theword = $word[0]->word;
        echo "<p id='word'>$theword</p>";
    }

    ?>
</body>
</html>
