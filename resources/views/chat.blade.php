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
    <link rel="stylesheet" href="assets/css/chat.css">
</head>
<body>
    <div id="centerdiv">
        <div id="intro">
            <h1>Welcome {[ {{ $user->name }}  ]}</h1>
        </div>
        <div id="list">

                <table class="fixed_headers">
                    <thead>
                    <tr>
                        <th>ChatBox</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($chats))
                        @foreach ($chats as $chat)
                            <tr><td>{{ $chat->username }}: {{  $chat->sentence }}</td></tr>
                        @endforeach
                    @endif
                    </tbody>


                </table>
                <form action="api/chat" method="POST">
                    <input type="text" name="chat" maxlength="50" placeholder="Type text here">
                    <input type="submit" value="Send">
                </form>
        </div>
    </div>
    <form method="POST" action="api/logout">
        <button id="logout" name="btnLogOut">Log Out</button>
    </form>
    <a href="landing    ">Wanna generate some random words? Click here</a>
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
