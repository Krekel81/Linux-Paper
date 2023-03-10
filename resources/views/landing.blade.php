<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
    <link rel="stylesheet" href="assets/css/landing.css">
</head>
<body>
    <div id="centerdiv">
        <div id="intro">
            <h1>Welcome {[ {{ $user->name }}  ]}</h1>
            <?php
            echo "<br><p style='text-align:center;'>You clicked the button $user->clicks times</p>";
            ?>
            <div id="forms">
                <form method="POST" action="api/clicked">
                    <button name="btnRandom">Click me</button>
                </form>
            </div>
        </div>
        <div id="list">
            <table class="fixed_headers">
                <thead>
                <tr>
                    <th>Word History</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($history))
                    @foreach ($history as $hist)
                        <tr><td>{{ $hist->word }}</td></tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <form method="POST" action="api/logout">
        <button id="logout" name="btnLogOut">Log Out</button>
    </form>
    <a href="chat">Wanna chat with some friends? Click here</a>
    <?php
    if (isset($_POST['btnLogOut'])) {
        $user->loggedIn = false;
        $user->save();
        header('Location: login');
        exit;
    }
    ?>
</body>
</html>
