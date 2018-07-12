<?php
/**
 * Created by PhpStorm.
 * User: www
 * Date: 12.07.2018
 * Time: 13:59
 */
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function () {
            $('#main-wrapper').load('php/userActions.php');
        });
    </script>
</head>
<body>
<header>
    <nav>
        <div class="main-wrapper" id="main-wrapper">

        </div>
    </nav>
</header>
