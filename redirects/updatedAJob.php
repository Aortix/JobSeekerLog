<?php
include("./../queries/jobQueries.php");

$scrollPosition = 0;

if (isset($_POST['submit'])) {
    session_start();
    $scrollPosition = $_POST['updating_scroll'];
    $errors = updateJob();
    if ($errors !== null) {
        foreach ($errors as $key => $error) {
            $_SESSION[$key] = $error;
        }
        $_SESSION['update_job_error'] = true;
    } else {
        $_SESSION['isError'] = false;
    }
}

header("Location: ./../index.php?y=$scrollPosition");
