<?php 
    include("./../queries/jobQueries.php");

    if(isset($_POST['submit'])) {
        addJob();
    }

    header("Location: ./../index.php");
