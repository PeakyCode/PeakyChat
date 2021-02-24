<?php
session_start();

if (strlen($_POST['nick']) == 0)
    $_SESSION['name'] = "Anonim";
else
    $_SESSION['name'] = $_POST['nick'];

header("Location: ../index.php");
