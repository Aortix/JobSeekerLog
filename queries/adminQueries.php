<?php

use Respect\Validation\Validator as v;

function registerUser()
{
    include('./../vendor/autoload.php');

    $errors = array("isError" => false);

    if (isset($_POST['g-recaptcha-response'])) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = array(
            'secret' => $_SERVER['RECAPTCHA'],
            'response' => $_POST['g-recaptcha-response'],
        );
        $options = array('http' => array(
            'method' => 'POST',
            'content' => http_build_query($data),
        ));
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            $errors['misc'] = "Something went wrong with validating the recaptcha.";
            $errors['isError'] = true;
            return $errors;
        } else {
            $resultDecoded = json_decode($result, true);
            if ($resultDecoded["success"] === false) {
                $errors['misc'] = "Invalid recaptcha.";
                $errors['isError'] = true;
                return $errors;
            }
        }
    } else {
        $errors['misc'] = "Invalid recaptcha";
        $errors['isError'] = true;
        return $errors;
    }

    if (!isset($_POST['register_username'])) {
        $errors['username'] = "Error registering username.";
        $errors['isError'] = true;
        return $errors;
    }
    if (!isset($_POST['register_password'])) {
        $errors['password'] = "Error registering password.";
        $errors['isError'] = true;
        return $errors;
    }

    $username = trim(htmlspecialchars($_POST['register_username']));
    $password = trim(htmlspecialchars($_POST['register_password']));


    if (!v::stringType()->validate($username) || !v::alnum()->validate($username) || $username === "") {
        $errors['username'] = 'Username is not valid.';
        $errors['isError'] = true;
    } else if (strlen($username) > 40) {
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

    $mysqli = new mysqli(getenv('DB_HOST'), getenv(['DB_USERNAME']), getenv(['DB_PASSWORD']), getenv(['DB_TABLE_NAME']));

    if ($mysqli->connect_errno) {
        $errors['misc'] = "Connect Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("INSERT INTO Users VALUES (?, ?, ?, ?)");

    if (false === $stmt) {
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
        $errors['misc'] = "Binding parameters failed";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->execute()) {
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
    $errors = array("isError" => false);

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
    } else {
        $_SESSION['login_attempts'] += 1;
    }

    if ($_SESSION['login_attempts'] > 4) {
        if (isset($_SESSION['block_login_attempts'])) {
            $timePassed = time() - $_SESSION['block_login_attempts'];
            if ($timePassed > 600) {
                session_unset();
                session_destroy();
            } else {
                $errors['misc'] = "Too many incorrect login attempts. Try again later.";
                $errors['isError'] = true;
                return $errors;
            }
        } else {
            $_SESSION['block_login_attempts'] = time();
            $errors['misc'] = "Too many incorrect login attempts. Try again later.";
            $errors['isError'] = true;
            return $errors;
        }
    }

    if (!isset($_POST['login_username'])) {
        $errors['username'] = "Error registering username.";
        $errors['isError'] = true;
        return $errors;
    }
    if (!isset($_POST['login_password'])) {
        $errors['password'] = "Error registering password.";
        $errors['isError'] = true;
        return $errors;
    }

    $username = trim(htmlspecialchars($_POST['login_username']));
    $password = trim(htmlspecialchars($_POST['login_password']));

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

    $mysqli = new mysqli(getenv('DB_HOST'), getenv(['DB_USERNAME']), getenv(['DB_PASSWORD']), getenv(['DB_TABLE_NAME']));

    if ($mysqli->connect_errno) {
        $errors['misc'] = "Connect Failed";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("SELECT id, user_username FROM Users WHERE user_username=? AND user_password=?");

    if (false === $stmt) {
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

    $_SESSION['login_attempts'] = 0;
    $_SESSION['block_login_attempts'] = NULL;

    return $valueToReturn;
}
