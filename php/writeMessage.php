<?php
session_start();

$div = '<div class = "msg"> 
            <p class ="nickname">' . $_SESSION['name']  . '</p>
            <p class = "content">' . $_POST["message"] . '</p>
            </div>';

echo $div;

file_put_contents("../log/log.html", $div, FILE_APPEND | LOCK_EX);
