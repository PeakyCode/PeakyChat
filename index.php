<?php
session_start();
// include 'php/readMessage.php';
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeakyChat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div id="login">
        <form action="php/login.php" name="login" method="POST">
            <input type="text" name="nick" id="nick" placeholder="Podaj nick">
            <input type="submit" name="submit" class="submit" value="Zatwierdz">
        </form>
    </div>

    <div id="wrapper">
        <div id="chatHeader">
            <p>Welcome <?php echo $_SESSION['name'] ?> </p>
            <a class="button" href="php/logout.php"><button>Exit</button> </a>
        </div>
        <div id="messageBox">
            <?php
            $message = file_get_contents("log/log.html");
            echo $message;
            ?>
        </div>

        <div id="messageForm">
            <form name="message" id="form">
                <input type="text" name="usermsg" id="message" placeholder="Napisz wiadomość...">
                <input type="submit" name="send" class="button" value="Wyślij">
            </form>
        </div>
        <script>
            $('#form').submit(function(event) {
                $.ajax({
                    url: 'php/writeMessage.php',
                    method: 'post',
                    dataType: 'text',
                    data: {
                        name: "",
                        message: $("#message").val()
                    }
                });
            });
        </script>
    </div>

    <?php
    if (isset($_SESSION['name'])) {
        echo '
            <script>
                $("#wrapper").css("display","block");
                $("#login").css("display","none");
            </script>';
    } else {
        echo '
        <script>
            $("#wrapper").css("display","none");
            $("#login").css("display","block");
        </script>';
    }
    ?>

    <script>
        $("#messageBox").scrollTop($("#messageBox")[0].scrollHeight);

        setInterval(() => {
            $.ajax({
                url: 'log/log.html',
                cache: false,
                success: function(html) {
                    $("#messageBox").html(html);
                }
            })
        }, 0);
    </script>


</body>




</html>