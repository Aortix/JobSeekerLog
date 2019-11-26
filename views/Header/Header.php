<?php
?>
<div style="width: 100%; text-align: center;">
    <h1 class="display-4 text-center text-dark pt-4">
        Store your records here.
    </h1>
    <p class="text-muted text-center">Max Jobs: 100</p>
    <?php include("./views/SearchBar/SearchBar.php") ?>
    <div class="text-center mt-3 mb-2">
        <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
    <?php if (isset($_SESSION['add_job_error'])) { ?>
        <div class="alert alert-danger" style="display: inline-block; font-size: 15px; margin: 10px auto;" role="alert">
            Error occured while adding a job.
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['update_job_error'])) { ?>
        <div class="alert alert-danger" style="display: inline-block; font-size: 15px; margin: 10px auto;" role="alert">
            Error occured while updating a job.
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['isError']) && $_SESSION['isError'] == true) { ?>
        <form method="post" action="./index.php">
            <button type="submit" class="btn btn-outline-danger" name="clear_errors">Clear Errors</button>
        </form>
    <?php } ?>
    <?php if (!isset($_COOKIE['login_id']) || !isset($_COOKIE['login_username'])) { ?>
        <div style="margin: 30px auto; font-size: 16px; max-width: 400px;" class="alert alert-danger text-center" role="alert">
            You must register and login before adding a job.
        </div>
    <?php } ?>
</div>