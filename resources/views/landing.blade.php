<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="assets/css/landing.css">
</head>
<body>
    <div id="left">
        <h1>Welcome { {{ $user->name }}  }!</h1>
        <p>Click on the button below to generate a random word</p>
        <?php
        echo "<p>You have clicked the button $user->clicks times</p>";
        ?>
        <form method="POST" action="api/clicked">
            <button name="btnRandom">Click me</button>
            <button id="logout" name="btnLogOut">Log Out</button>
        </form>
        <?php
        if(isset($word))
        {
            $theword = $word[0]->word;
            echo "<p id='word'>$theword</p>";
        }
        ?>
    </div>
    <div id="right">
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
