<?php
include("./../queries/jobQueries.php");

if (isset($_POST['submit']) && isset($_COOKIE['id']) && isset($_COOKIE['username']) && $_COOKIE['id'] !== -1) {
    addJob();
    header("Location: ./../index.php");
} else {
    header("Location: ./../views/Pages/Register.php");
}
