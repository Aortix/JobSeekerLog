<?php
function getJobPostings()
{
    include("./sql_connection_info.php");

    $conn = mysqli_connect('localhost', $username, $password, $database_name);

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    //Write query for all job posts
    $sql = 'SELECT * FROM Job_posts';

    //Make query and get result
    $result = mysqli_query($conn, $sql);

    //Fetch the resulting rows as an array
    $job_posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //Free result from memory
    mysqli_free_result($result);

    //Close Connection
    mysqli_close($conn);

    return $job_posts;
}

function addJob()
{
    include("./../sql_connection_info.php");

    //Variables are coming from the sql_connection_info.php file
    $mysqli = mysqli_connect('localhost', $username, $password, $database_name);

    if (!$mysqli) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    if (!($stmt = $mysqli->prepare("INSERT INTO Job_posts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$stmt->bind_param(
        "isssssssss",
        $id,
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
    $timestamp;
    $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_name'])))) ?: "N/A";
    $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_position'])))) ?: "N/A";
    $company_website = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['company_website']))) ?: "N/A";
    $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['date_applied']))) ?: date('m/d/Y');
    $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['company_location'])))) ?: "N/A";
    $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_company']))) ?: "N/A";
    $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['about_position']))) ?: "N/A";
    $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['company_notes']))) ?: "N/A";

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $_POST = array();

    $stmt->close();

    mysqli_close($mysqli);
}

function updateJob()
{
    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $username, $password, $database_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        var_dump($mysqli->connect_error);
        exit();
    }

    $stmt = $mysqli->prepare("UPDATE Job_posts SET company_name=?, company_position=?, 
    company_website=?, date_applied=?, company_location=?, about_company=?, 
    about_position=?, notes=? WHERE id=?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        var_dump($stmt->error);
        exit();
    }

    $id = htmlspecialchars($_POST['updating_id']);
    $company_name = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_name'])))) ?: "N/A";
    $company_position = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_position'])))) ?: "N/A";
    $company_website = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_company_website']))) ?: "N/A";
    $date_applied = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_date_applied']))) ?: date('m/d/Y');
    $location = preg_replace('/\'|\\+|\s+/', ' ', ucfirst(trim(htmlspecialchars($_POST['updating_company_location'])))) ?: "N/A";
    $about_company = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_company']))) ?: "N/A";
    $about_position = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_about_position']))) ?: "N/A";
    $notes = preg_replace('/\'|\\+|\s+/', ' ', trim(htmlspecialchars($_POST['updating_company_notes']))) ?: "N/A";

    $bind = $stmt->bind_param(
        'ssssssssi',
        $company_name,
        $company_position,
        $company_website,
        $date_applied,
        $location,
        $about_company,
        $about_position,
        $notes,
        $id
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

    $_POST = array();

    //Close prepared statement
    $stmt->close();

    //Close db connection
    $mysqli->close();
}

function deleteJob($jobId)
{
    include("./../sql_connection_info.php");

    $mysqli = new mysqli("localhost", $username, $password, $database_name);

    if ($mysqli->connect_errno) {
        error_log("Connect Failed:");
        error_log(print_r($mysqli->connect_error, true));
        exit();
    }

    $stmt = $mysqli->prepare("DELETE FROM Job_posts WHERE id = ?");

    if (false === $stmt) {
        error_log('mysqli prepare() failed: ');
        error_log(print_r(htmlspecialchars($stmt->error), true));
        exit();
    }

    if (is_int($jobId)) {
        $bind = $stmt->bind_param('i', $jobId);
    } else {
        $bind = $stmt->bind_param('i', -1);
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
