<?php
include("./../queries/adminQueries.php");

if (isset($_POST['register_submit'])) {
    registerUser();
}

header("Location: ./login.php");
