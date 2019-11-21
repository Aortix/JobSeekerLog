<?php
include("./../queries/adminQueries.php");

if (isset($_POST['register_submit'])) {
    session_start();
    $_SESSION['registerUserCalled'] = registerUser();
    if ($_SESSION['registerUserCalled'] === NULL) {
        header("Location: ./../views/Pages/Login.php");
    } else {
        header("Location: ../views/Pages/Register.php");
    }
}
