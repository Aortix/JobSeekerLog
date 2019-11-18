<?php
?>

<header>
    <?php if (isset($_COOKIE['id']) && isset($_COOKIE['username'])) { ?>
        <div style="display: flex; justify-content: flex-end;" class="pt-3 pr-4">
            <h5><?php echo $_COOKIE['username'] ?></h5>
            <h5>Logout</h5>
        </div>
    <? } else { ?>
        <div style="display: flex; justify-content: flex-end;" class="pt-3 pr-4">
            <button type="button" class="btn btn-outline-dark" onclick="switchToRegisterPage()">Register</button>
            <button type="button" class="btn btn-dark ml-2" onclick="switchToLoginPage()">Login</button>
        </div>
    <?php } ?>
    <h2 class="display-4 text-center text-dark pt-4">
        Job Seeker's Log
    </h2>
    <p class="text-muted text-center">Record your job search.</p>
    <?php include("./views/SearchBar/SearchBar.php") ?>
    <div class="text-center mt-4 mb-2">
        <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
</header>