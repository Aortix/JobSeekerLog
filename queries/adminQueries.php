<?php
function registerUser()
{
    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $username, $password, $job_database);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        var_dump($mysqli->connect_error);
        exit();
    }

    $stmt = $mysqli->prepare("INSERT INTO Users VALUES (?, ?, ?, ?)");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
        exit();
    }

    $id = uniqid();
    $validation = array(' ');
    $username = trim(htmlspecialchars($_POST['register_username']));
    $timestamp;

    if (!ctype_alnum(str_replace($validation, '', $username))) {
        error_log('Incorrect username!');
        var_dump("Incorrect username!");
        exit();
    }

    $password = trim(htmlspecialchars($_POST['register_password']));

    if (strlen($password) > 40) {
        error_log('Password is too long!');
        var_dump("Password is too long!");
        exit();
    }

    if (!$stmt->bind_param(
        "ssss",
        $id,
        $username,
        $password,
        $timestamp
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        exit();
    }

    if (!$stmt->execute()) {
        var_dump("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        exit();
    }

    $stmt->close();

    $mysqli->close();
}

function loginUser()
{
    include("./sql_connection_info.php");

    $mysqli = new mysqli("localhost", $username, $password, $job_database);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        var_dump($mysqli->connect_error);
        exit();
    }

    $stmt = $mysqli->prepare("SELECT id, user_username FROM Users WHERE user_username=? AND user_password=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
        exit();
    }

    $username = trim(htmlspecialchars($_POST['login_username']));
    $password = trim(htmlspecialchars($_POST['login_password']));
    $validation = " ";

    if (!ctype_alnum(str_replace($validation, '', $username))) {
        error_log('Incorrect username!');
        var_dump("Somethign went wrong");
        exit();
    }

    if (strlen($password) > 40) {
        error_log('Password is too long!');
        var_dump("Somethign went wrong");
        exit();
    }

    if (!$stmt->bind_param(
        "ss",
        $username,
        $password,
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        var_dump("Somethign went wrong");
        exit();
    }

    if (!$stmt->execute()) {
        var_dump("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        exit();
    }

    $stmt->bind_result($id, $user_username);

    $valueToReturn;

    while ($stmt->fetch()) {
        $valueToReturn['id'] = $id;
        $valueToReturn['username'] = $user_username;
    }

    $stmt->close();

    $mysqli->close();

    if (isset($valueToReturn)) {
        return $valueToReturn;
    } else {
        return -1;
    }
}
