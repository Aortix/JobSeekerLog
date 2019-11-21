<?php
?>
<div>
    <h1 class="display-4 text-center text-dark pt-4">
        Store your records here.
    </h1>
    <p class="text-muted text-center">All in once place.</p>
    <?php include("./views/SearchBar/SearchBar.php") ?>
    <div class="text-center mt-3 mb-2">
        <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
    <?php if (!isset($_COOKIE['login_id']) || !isset($_COOKIE['login_username'])) { ?>
        <div style="margin: 30px auto; font-size: 16px; max-width: 400px;" class="alert alert-danger text-center" role="alert">
            You must register and login before adding a job.
        </div>
    <?php } ?>
</div>