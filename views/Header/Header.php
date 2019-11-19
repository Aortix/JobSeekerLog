<?php
?>
<div style="width: 100%;">
    <h1 class="display-4 text-center text-dark pt-4">
        Job Seeker's Log
    </h1>
    <p class="text-muted text-center">Record your job search.</p>
    <?php include("./views/SearchBar/SearchBar.php") ?>
    <div class="text-center mt-4 mb-2">
        <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
    <?php if (!isset($_COOKIE['id']) || !isset($_COOKIE['username']) || $_COOKIE['id'] === -1) { ?>
        <div style="margin: 30px auto; font-size: 16px; width: 400px;" class="alert alert-danger text-center" role="alert">
            You must register and login before adding a job.
        </div>
    <?php } ?>
</div>