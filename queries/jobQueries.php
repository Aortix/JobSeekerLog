<?php
function getJobPostings()
{
    include("./sql_connection_info.php");

    $mysqli = new mysqli("localhost", $database_username, $database_password, $database_table_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        exit();
    }

    $stmt = $mysqli->prepare("SELECT * FROM Job_posts WHERE user_identification=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    if (!isset($_COOKIE['id']) || $_COOKIE['id'] === -1) {
        return;
    }

    $user_id = $_COOKIE['id'];

    $bind = $stmt->bind_param('s', $user_id);

    if (false === $bind) {
        error_log('bind_param() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        error_log('mysqli execute() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    $res = $stmt->get_result();
    for ($set = array(); $row = $res->fetch_assoc(); $set[] = $row);

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();

    return $set;
}

function addJob()
{
    include("./../sql_connection_info.php");

    //Variables are coming from the sql_connection_info.php file
    $mysqli = mysqli_connect('localhost', $database_username, $database_password, $database_table_name);

    if (!$mysqli) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    if (!($stmt = $mysqli->prepare("INSERT INTO Job_posts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
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
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $id = 0;
    $user_id = $_COOKIE['id'];
    $timestamp;
    $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_name'])))) ?: "N/A";
    $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_position'])))) ?: "N/A";
    $company_website = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_website'])))) ?: "N/A";
    if ($company_website[0] !== "H" && $company_website !== "N/A") {
        $company_website = "Https://" . $company_website;
    }
    $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['date_applied']))) ?: date('m/d/Y');
    $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_location'])))) ?: "N/A";
    $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_company']))) ?: "N/A";
    $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_position']))) ?: "N/A";
    $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['company_notes']))) ?: "N/A";

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();

    mysqli_close($mysqli);
}

function updateJob()
{
    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $database_username, $database_password, $database_table_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        var_dump($mysqli->connect_error);
        exit();
    }

    $stmt = $mysqli->prepare("UPDATE Job_posts SET company_name=?, company_position=?, 
    company_website=?, date_applied=?, company_location=?, about_company=?, 
    about_position=?, notes=? WHERE id=? AND user_identification=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
        exit();
    }

    $id = htmlspecialchars($_POST['updating_id']);
    $user_id = htmlspecialchars($_COOKIE['id']);
    $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_name'])))) ?: "N/A";
    $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_position'])))) ?: "N/A";
    $company_website = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_website'])))) ?: "N/A";
    if ($company_website[0] !== "H" && $company_website[1] !== "t" && $company_website !== "N/A") {
        $company_website = "Https://" . $company_website;
    }
    $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_date_applied']))) ?: date('m/d/Y');
    $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_location'])))) ?: "N/A";
    $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_company']))) ?: "N/A";
    $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_position']))) ?: "N/A";
    $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_company_notes']))) ?: "N/A";

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
        error_log('bind_param() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
        exit();
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        error_log('mysqli execute() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
    }

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();
}

function deleteJob($jobId)
{
    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $database_username, $database_password, $database_table_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        exit();
    }

    $stmt = $mysqli->prepare("DELETE FROM Job_posts WHERE id = ? AND user_identification=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    $user_id = $_COOKIE['id'];

    if (is_int($jobId)) {
        $bind = $stmt->bind_param('is', $jobId, $user_id);
    } else {
        $bind = $stmt->bind_param('is', -1, $user_id);
    }

    if (false === $bind) {
        error_log('bind_param() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    $exec = $stmt->execute();

    if (false === $exec) {
        error_log('mysqli execute() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
    }

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();
}
