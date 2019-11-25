<?php

use Respect\Validation\Validator as v;

function getJobPostings()
{
    include('./vendor/autoload.php');

    $errors = array("isError" => false);

    if (!isset($_COOKIE['login_id'])) {
        $errors['job_postings'] = "Error getting the User id.";
        $errors['isError'] = true;
        return $errors;
    }

    $user_id = trim(htmlspecialchars($_COOKIE['login_id']));

    if (!v::stringType()->validate($user_id) || !v::alnum()->validate($user_id)) {
        $errors['job_postings'] = "The User ID is not valid.";
        $errors['isError'] = true;
        return $errors;
    }

    $mysqli = new mysqli("localhost", $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_TABLE_NAME']);

    if ($mysqli->connect_errno) {
        $errors['job_postings'] = 'Connect Failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("SELECT * FROM Job_posts WHERE user_identification=? ORDER BY post_timestamp DESC");

    if (false === $stmt) {
        $errors['job_postings'] = 'Prepare() failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $bind = $stmt->bind_param('s', $user_id);

    if (false === $bind) {
        $errors['job_postings'] = 'Bind_param failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        $errors['job_postings'] = 'Execute failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $res = $stmt->get_result();
    for ($set = array(); $row = $res->fetch_assoc(); $set[] = $row);

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();

    return $set;
}

function getCountOfUsersTotalJobPostings()
{
    include('./../vendor/autoload.php');

    $errors = array("isError" => false);

    if (!isset($_COOKIE['login_id'])) {
        $errors['job_postings'] = "Error getting the User id.";
        $errors['isError'] = true;
        return $errors;
    }

    $user_id = trim(htmlspecialchars($_COOKIE['login_id']));

    if (!v::stringType()->validate($user_id) || !v::alnum()->validate($user_id)) {
        $errors['job_postings'] = "The User ID is not valid.";
        $errors['isError'] = true;
        return $errors;
    }

    $dotenv = Dotenv\Dotenv::create("./..");
    $dotenv->load();

    $mysqli = new mysqli("localhost", $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_TABLE_NAME']);

    if ($mysqli->connect_errno) {
        $errors['job_postings'] = 'Connect Failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Job_posts WHERE user_identification=?");

    if (false === $stmt) {
        $errors['job_postings'] = 'Prepare() failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $bind = $stmt->bind_param('s', $user_id);

    if (false === $bind) {
        $errors['job_postings'] = 'Bind_param failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        $errors['job_postings'] = 'Execute failed.';
        $errors['isError'] = true;
        return $errors;
    }

    $res = $stmt->get_result();
    $row = $res->fetch_array(MYSQLI_NUM);

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();

    return $row;
}

function addJob()
{
    include('./../vendor/autoload.php');

    $errors = array("isError" => false);
    $id = 0;
    $timestamp;
    if (
        !isset($_COOKIE['login_id']) ||
        !v::stringType()->validate(htmlspecialchars($_COOKIE['login_id'])) ||
        !v::alnum()->validate(htmlspecialchars($_COOKIE['login_id']))
    ) {
        $errors['login_id'] = "Problem with the user id. Try logging out and logging back in.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $user_id = trim(htmlspecialchars($_COOKIE['login_id']));
    }
    if (
        !isset($_POST['company_name']) ||
        !v::stringType()->validate(htmlspecialchars($_POST['company_name'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['company_name']))
    ) {
        $errors['company_name'] = "Required. Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_name']))));
    }
    if (
        !isset($_POST['company_position']) ||
        !v::stringType()->validate(htmlspecialchars($_POST['company_position'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['company_position']))
    ) {
        $errors['company_position'] = "Required. Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_position']))));
    }
    if (
        $_POST['company_website'] === ""
    ) {
        $company_website = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['company_website'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['company_website']))
    ) {
        $errors['company_website'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_website = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_website']))));
        if ($company_website[0] !== "H" && $company_website[1] !== "t" && $company_website !== "N/A") {
            $company_website = "Https://" . $company_website;
        }
    }
    if (
        $_POST['date_applied'] === ""
    ) {
        $date_applied = date('m/d/Y');
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['date_applied'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['date_applied']))
    ) {
        $errors['date_applied'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['date_applied'])));
    }
    if ($_POST['company_location'] === "") {
        $location = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['company_location'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['company_location']))
    ) {
        $errors['company_location'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_location']))));
    }
    if ($_POST['about_company'] === "") {
        $about_company = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['about_company'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['about_company']))
    ) {
        $errors['about_company'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_company'])));
    }
    if ($_POST['about_position'] === "") {
        $about_position = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['about_position'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['about_position']))
    ) {
        $errors['about_position'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_position'])));
    }
    if ($_POST['company_notes'] === "") {
        $notes = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['company_notes'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['company_notes']))
    ) {
        $errors['company_notes'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['company_notes'])));
    }

    $dotenv = Dotenv\Dotenv::create("./..");
    $dotenv->load();

    $mysqli = mysqli_connect("localhost", $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_TABLE_NAME']);

    if (!$mysqli) {
        $errors['misc'] = "Connection error.";
        $errors['isError'] = true;
        return $errors;
    }

    if (!($stmt = $mysqli->prepare("INSERT INTO Job_posts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))) {
        $errors['misc'] = "Prepare failed.";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->bind_param(
        "issssssssss",
        $id,
        $user_id,
        $timestamp,
        $company_name,
        $company_position,
        $company_website,
        $date_applied,
        $location,
        $about_company,
        $about_position,
        $notes
    )) {
        $errors['misc'] = "Binding parameters failed.";
        $errors['isError'] = true;
        return $errors;
    }

    if (!$stmt->execute()) {
        $errors['misc'] = "Execute Failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt->close();

    mysqli_close($mysqli);

    if ($errors['isError'] === true) {
        return $errors;
    } else {
        return NULL;
    }
}

function updateJob()
{
    include('./../vendor/autoload.php');

    $errors = array("isError" => false);
    $id = htmlspecialchars($_POST['updating_id']);
    if (
        !isset($_COOKIE['login_id']) ||
        !v::stringType()->validate(htmlspecialchars($_COOKIE['login_id'])) ||
        !v::alnum()->validate(htmlspecialchars($_COOKIE['login_id']))
    ) {
        $errors['login_id'] = "Problem with the user id. Try logging out and logging back in.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $user_id = trim(htmlspecialchars($_COOKIE['login_id']));
    }
    if (
        !isset($_POST['updating_company_name']) ||
        !v::stringType()->validate(htmlspecialchars($_POST['updating_company_name'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_company_name']))
    ) {
        $errors['updating_company_name'] = "Required. Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_name']))));
    }
    if (
        !isset($_POST['updating_company_position']) ||
        !v::stringType()->validate(htmlspecialchars($_POST['updating_company_position'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_company_position']))
    ) {
        $errors['updating_company_position'] = "Required. Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_position']))));
    }
    if (
        $_POST['updating_company_website'] === ""
    ) {
        $company_website = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_company_website'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_company_website']))
    ) {
        $errors['updating_company_website'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $company_website = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_website']))));
        if ($company_website[0] !== "H" && $company_website[1] !== "t" && $company_website !== "N/A") {
            $company_website = "Https://" . $company_website;
        }
    }
    if (
        $_POST['updating_date_applied'] === ""
    ) {
        $date_applied = date('m/d/Y');
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_date_applied'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_date_applied']))
    ) {
        $errors['updating_date_applied'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_date_applied'])));
    }
    if ($_POST['updating_company_location'] === "") {
        $location = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_company_location'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_company_location']))
    ) {
        $errors['updating_company_location'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_location']))));
    }
    if ($_POST['updating_about_company'] === "") {
        $about_company = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_about_company'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_about_company']))
    ) {
        $errors['updating_about_company'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_company'])));
    }
    if ($_POST['updating_about_position'] === "") {
        $about_position = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_about_position'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_about_position']))
    ) {
        $errors['updating_about_position'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_position'])));
    }
    if ($_POST['updating_company_notes'] === "") {
        $notes = "N/A";
    } else if (
        !v::stringType()->validate(htmlspecialchars($_POST['updating_company_notes'])) ||
        !v::charset('ASCII')->validate(htmlspecialchars($_POST['updating_company_notes']))
    ) {
        $errors['updating_company_notes'] = "Can only use ASCII characters and must be a string.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_company_notes'])));
    }

    $dotenv = Dotenv\Dotenv::create("./..");
    $dotenv->load();

    $mysqli = new mysqli("localhost", $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_TABLE_NAME']);

    if ($mysqli->connect_errno) {
        $errors['misc'] = "Connect failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("UPDATE Job_posts SET company_name=?, company_position=?, 
    company_website=?, date_applied=?, company_location=?, about_company=?, 
    about_position=?, notes=? WHERE id=? AND user_identification=?");

    if (false === $stmt) {
        $errors['misc'] = "Prepare failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $bind = $stmt->bind_param(
        'ssssssssis',
        $company_name,
        $company_position,
        $company_website,
        $date_applied,
        $location,
        $about_company,
        $about_position,
        $notes,
        $id,
        $user_id
    );

    if (false === $bind) {
        $errors['misc'] = "Bind param failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        $errors['misc'] = "Execute failed.";
        $errors['isError'] = true;
        return $errors;
    }

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();
}

function deleteJob($jobId)
{
    include('./../vendor/autoload.php');

    $errors = array("isError" => false);

    if (
        !isset($_COOKIE['login_id']) ||
        !v::stringType()->validate(htmlspecialchars($_COOKIE['login_id'])) ||
        !v::alnum()->validate(htmlspecialchars($_COOKIE['login_id']))
    ) {
        $errors['login_id'] = "Problem with the user id. Try logging out and logging back in.";
        $errors['isError'] = true;
        return $errors;
    } else {
        $user_id = trim(htmlspecialchars($_COOKIE['login_id']));
    }

    if (is_int($jobId)) {
        $job_id = $jobId;
    } else {
        $job_id = -1;
    }

    $dotenv = Dotenv\Dotenv::create("./..");
    $dotenv->load();

    $mysqli = new mysqli("localhost", $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_TABLE_NAME']);

    if ($mysqli->connect_errno) {
        $errors['misc'] = "Connect Failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $stmt = $mysqli->prepare("DELETE FROM Job_posts WHERE id = ? AND user_identification=?");

    if (false === $stmt) {
        $errors['misc'] = "Prepare Failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $bind = $stmt->bind_param('is', $job_id, $user_id);

    if (false === $bind) {
        $errors['misc'] = "Bind Param Failed.";
        $errors['isError'] = true;
        return $errors;
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        $errors['misc'] = "Execute Failed.";
        $errors['isError'] = true;
        return $errors;
    }

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();
}
