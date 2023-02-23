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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getNewChat() {
            $.ajax({
                url: '{{ route("get-new-chat") }}',
                type: 'GET',
                success: function(response) {
                    // Append the new chat HTML to the chat containerµ
                    let html = '';
                    const chats = response["chats"].reverse();

                    chats.forEach(chat => {
                        html+= "<tr class='chat' id='thechat'><td>" + chat["username"] + ": " + chat["sentence"] + "</td></tr>";
                        console.log(chat["username"] + ": " + chat["sentence"]);
                    });

                    document.querySelector("#bodychat").innerHTML = html;
                },
                error: function(xhr, status, error) {
                    // Handle error response here
                }
            });
        }

setInterval(() => getNewChat(), 2000);
    </script>
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
                    <tbody id="bodychat">
                    @if (isset($chats))
                        @foreach ($chats->reverse() as $chat)
                            <tr class="chat" id="thechat"><td>{{ $chat->username }}: {{  $chat->sentence }}</td></tr>
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
    <a href="landing">Wanna generate some random words? Click here</a>
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
