<?php
include("./../queries/jobQueries.php");

if (isset($_POST['submit']) && isset($_COOKIE['login_id']) && isset($_COOKIE['login_username'])) {
    addJob();
    header("Location: ./../index.php");
} else {
    header("Location: ./../views/Pages/Register.php");
}
