<?php

use Respect\Validation\Validator as v;

function registerUser()
{
    include('./../vendor/autoload.php');

    //Validation
    $username = trim(htmlspecialchars($_POST['register_username']));
    $password = trim(htmlspecialchars($_POST['register_password']));
    $errors = array("isError" => false);

    if (!v::stringType()->validate($username) || !v::alnum()->validate($username) || $username === "") {
        $errors['username'] = 'Username is not valid.';
        $errors['isError'] = true;
    } else if (strlen($username > 40)) {
        $errors['username'] = 'Max username length is 40 characters.';
        $errors['isError'] = true;
    }
    if (!v::stringType()->validate($password) || !v::alnum('_-%#@^&')->validate($password) || $password === "") {
        $errors['password'] = "Password is not valid.";
        $errors['isError'] = true;
    } else if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long';
        $errors['isError'] = true;
    } else if (strlen($password) > 40) {
        $errors['password'] = 'Max password length is 40 characters';
        $errors['isError'] = true;
    }

    if ($errors['isError'] === true) {
        return $errors;
    }

    $id = uniqid();
    $timestamp = NULL;

    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $database_username, $database_password, $database_table_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        $errors['misc'] = "Connect Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("INSERT INTO Users VALUES (?, ?, ?, ?)");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        $errors['misc'] = "Prepare failed.";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->bind_param(
        "ssss",
        $id,
        $username,
        $password,
        $timestamp
    )) {
        error_log("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
        $errors['misc'] = "Binding parameters failed";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->execute()) {
        error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        $errors['misc'] = "Execute Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt->close();

    $mysqli->close();

    return NULL;
}

function loginUser()
{
    include('./vendor/autoload.php');

    //Validation
    $username = trim(htmlspecialchars($_POST['login_username']));
    $password = trim(htmlspecialchars($_POST['login_password']));
    $errors = array("isError" => false);

    if (!v::stringType()->validate($username) || !v::alnum()->validate($username) || $username === "") {
        $errors['username'] = 'Username is not valid.';
        $errors['isError'] = true;
    } else if (strlen($username > 40)) {
        $errors['username'] = 'Max username length is 40 characters.';
        $errors['isError'] = true;
    }
    if (!v::stringType()->validate($password) || !v::alnum('_-%#@^&')->validate($password) || $password === "") {
        $errors['password'] = "Password is not valid.";
        $errors['isError'] = true;
    } else if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long';
        $errors['isError'] = true;
    } else if (strlen($password) > 40) {
        $errors['password'] = 'Max password length is 40 characters';
        $errors['isError'] = true;
    }

    if ($errors['isError'] === true) {
        return $errors;
    }

    include("./sql_connection_info.php");

    $mysqli = new mysqli("localhost", $database_username, $database_password, $database_table_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        $errors['misc'] = "Connect Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("SELECT id, user_username FROM Users WHERE user_username=? AND user_password=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        $errors['misc'] = "Prepare Failed";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->bind_param(
        "ss",
        $username,
        $password,
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        $errors['misc'] = "Binding parameters failed";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->execute()) {
        error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        $errors['misc'] = "Execute Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt->bind_result($id, $user_username);

    $valueToReturn = NULL;

    while ($stmt->fetch()) {
        $valueToReturn['login_id'] = $id;
        $valueToReturn['login_username'] = $user_username;
    }

    $stmt->close();

    $mysqli->close();

    return $valueToReturn;
}
