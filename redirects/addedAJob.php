<?php
include("./../queries/jobQueries.php");

if (isset($_POST['submit']) && isset($_COOKIE['login_id']) && isset($_COOKIE['login_username'])) {
    session_start();
    $amount = getCountOfUsersTotalJobPostings();
    if (is_int($amount[0]) && $amount[0] < 100) {
        $errors = addJob();
        if ($errors !== null) {
            foreach ($errors as $key => $error) {
                $_SESSION[$key] = $error;
            }
            $_SESSION['add_job_error'] = true;
        } else {
            $_SESSION['isError'] = false;
        }
    }
    header("Location: ./../index.php");
} else {
    header("Location: ./../views/Pages/Register.php");
}
