<?php
/**
 * Created by PhpStorm.
 * User: www
 * Date: 12.07.2018
 * Time: 16:38
 */

if(isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}
