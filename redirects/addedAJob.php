<?php
include("./../queries/jobQueries.php");

if (isset($_POST['submit']) && isset($_COOKIE['login_id']) && isset($_COOKIE['login_username'])) {
    $amount = getCountOfUsersTotalJobPostings();
    if (is_int($amount[0]) && $amount[0] < 100) {
        addJob();
    }
    header("Location: ./../index.php");
} else {
    header("Location: ./../views/Pages/Register.php");
}
