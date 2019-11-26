<?php ?>

<header>
    <?php if (isset($_COOKIE['login_id']) && isset($_COOKIE['login_username'])) { ?>
        <div class="navbar_container pt-3 pb-3 border-bottom">
            <h4 class="navbar_title" onclick="switchToMainPage()">Job Seeker's Log</h4>
            <div>
                <h5 class="mr-1 mb-0" style="display: inline-block;"><?php echo $_COOKIE['login_username'] ?></h5>
                <button class="btn btn-outline-dark" onclick="user_logout()">Logout</button>
            </div>
        </div>
    <?php } else { ?>
        <div class="navbar_container pt-3 pb-3 border-bottom">
            <h4 class="navbar_title" onclick="switchToMainPage()">Job Seeker's Log</h4>
            <div>
                <button type="button" class="btn btn-outline-dark" onclick="switchToRegisterPage()">Register</button>
                <button type="button" class="btn btn-outline-dark ml-2" onclick="switchToLoginPage()">Login</button>
            </div>
        </div>
    <?php } ?>
</header>