<?php ?>

<header>
    <?php if (isset($_COOKIE['login_id']) && isset($_COOKIE['login_username'])) { ?>
        <div style="display: flex; justify-content: flex-end; align-items: center;" class="pt-3 pr-4 pb-3 border-bottom">
            <h4 style="margin-right: auto; margin-bottom: 0px; padding-left: 15px; cursor: pointer;" onclick="switchToMainPage()">Job Seeker's Log</h4>
            <h5 class="mr-3 mb-0"><?php echo $_COOKIE['login_username'] ?></h5>
            <button class="btn btn-outline-dark" onclick="user_logout()">Logout</button>
        </div>
    <? } else { ?>
        <div style="display: flex; justify-content: flex-end; align-items: center;" class="pt-3 pr-4 pb-3 border-bottom">
            <h4 style="margin-right: auto; margin-bottom: 0px; padding-left: 15px; cursor: pointer;" onclick="switchToMainPage()">Job Seeker's Log</h4>
            <button type="button" class="btn btn-outline-dark" onclick="switchToRegisterPage()">Register</button>
            <button type="button" class="btn btn-outline-dark ml-2" onclick="switchToLoginPage()">Login</button>
        </div>
    <?php } ?>
</header>