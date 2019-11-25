<?php
include("./../queries/adminQueries.php");

if (isset($_POST['register_submit'])) {
    session_start();
    if (isset($_SESSION['user_registered']) && $_SESSION['user_registered'] >= 2) {
        $_SESSION['misc'] = "Too many accounts registered for now. Try again later.";
        header("Location: ../views/Pages/Register.php");
    } else {
        $_SESSION['registerUserCalled'] = registerUser();
        if ($_SESSION['registerUserCalled'] === NULL) {
            foreach ($_SESSION as $variable) {
                $variable = NULL;
            }
            if (!isset($_SESSION['user_registered'])) {
                $_SESSION['user_registered'] = 1;
            } else {
                $_SESSION['user_registered'] += 1;
            }
            header("Location: ./../views/Pages/Login.php");
        } else {
            header("Location: ../views/Pages/Register.php");
        }
    }
}
