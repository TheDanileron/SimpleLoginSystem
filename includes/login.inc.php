<?php
/**
 * Created by PhpStorm.
 * User: www
 * Date: 12.07.2018
 * Time: 15:53
 */
session_start();

if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';

    $login = $_POST['login'];
    $password = $_POST['pwd'];

    if (empty($login) || empty($password)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {

        $sql = "SELECT * FROM USERS WHERE EMAIL = :email OR LOGIN = :login";
        $statement = oci_parse($conn, $sql);
        oci_bind_by_name($statement, ':login', $login);
        oci_bind_by_name($statement, ':email', $login);

        $result = oci_execute($statement);
        $user = oci_fetch_assoc($statement);
        if($user) {
            $userPassword = $user['PASSWORD'];
            if($userPassword != hash('ripemd160', $password)){
                file_put_contents('passwords.json', $userPassword . ' ' . password_hash($password, PASSWORD_DEFAULT));
                header("Location: ../index.php?login=failed");
                exit();
            } else {
                $_SESSION['u_login'] = $user['LOGIN'];
                $_SESSION['u_fName'] = $user['FNAME'];
                $_SESSION['u_lName'] = $user['LNAME'];
                $_SESSION['u_email'] = $user['EMAIL'];

                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            header("Location: ../index.php?login=failed");
            exit();
        }

    }
} else {
    header("Location: ../index.php");
    exit();
}
