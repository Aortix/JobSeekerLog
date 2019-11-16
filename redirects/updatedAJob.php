<?php
include("./../queries/jobQueries.php");

$scrollPosition = 0;

if (isset($_POST['submit'])) {
    $scrollPosition = $_POST['updating_scroll'];
    updateJob();
}

header("Location: ./../index.php?y=$scrollPosition");
