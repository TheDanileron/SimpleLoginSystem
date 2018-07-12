<?php
// Check if submit button was clicked
if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
    // I strongly urge you not to build queries by appending strings together. SQL Injection danger
    $login = $_POST['login'];
    $email = trim($_POST['email']);
    $firstName = $_POST['first'];
    $lastName = $_POST['last'];
    $password = $_POST['pwd'];
    $hashedPWD = hash('ripemd160', $password);

    // oci_bind_by_name reduces SQL Injection concerns
    $statement = oci_parse($conn, 'insert into USERS(LOGIN, EMAIL, FNAME, LNAME, PASSWORD) values (:login, :email, :firstName, :lastName, :pass)');
    oci_bind_by_name($statement, ':login', $login);
    oci_bind_by_name($statement, ':email', $email);
    oci_bind_by_name($statement, ':firstName', $firstName);
    oci_bind_by_name($statement, ':lastName', $lastName);
    oci_bind_by_name($statement, ':pass', $hashedPWD);

    //Error handlers

    if (empty($login) || empty($email) || empty($password)) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        // Validate
        if (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?signup=invalidEmail");
                exit();
            } else {
                $sql = "SELECT * FROM USERS WHERE EMAIL = :email OR LOGIN = :login";
                $s = oci_parse($conn, $sql);
                oci_bind_by_name($s, ':email', $email);
                oci_bind_by_name($s, ':login', $login);

                $ex = oci_execute($s);
                $result = oci_fetch_assoc($s);

                if($result) {
                    header("Location: ../signup.php?signup=emailTaken");
                    exit();
                } else {
                    $insertResult = oci_execute ($statement);

                    if($errors = oci_error($statement)) {
                        file_put_contents('ociError.json', json_encode($errors));
                    }

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}