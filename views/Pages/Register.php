<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Job Seeker's Log - Register</title>
    <style type="text/css">
        body {
            background-color: #F8F8F8;
            min-height: 100vh;
        }

        .register_main_container {
            height: 100%;
        }

        .register_form_container {
            width: 85%;
            max-width: 650px;
            min-height: 360px;
            margin-right: auto;
            margin-left: auto;
            position: relative;
            margin-top: 40px;
        }

        .navbar_container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-right: 0;
        }

        @media only screen and (min-width: 650px) {
            .navbar_container {
                flex-direction: row;
                justify-content: flex-end;
                padding-right: 15px;
            }

            .navbar_title {
                margin-right: auto;
                margin-bottom: 0px;
                padding-left: 15px;
                cursor: pointer;
            }
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="register_main_container">
        <div style="min-height: 95vh;">
            <?php include("./../NavBar/NavBar.php") ?>
            <div class="register_form_container p-4 border">
                <h2 class="p-3 mb-2 bg-dark text-white">Register</h2>
                <form method="post" action="./../../redirects/register.php">
                    <div class="form-group">
                        <label for="register_username" class="mt-2">Username</label>
                        <input type="text" class="form-control" name="register_username" id="register_username" placeholder="Enter a Username">
                        <small id="emailHelp" class="form-text text-muted">Letters, numbers, and spaces allowed.</small>
                        <?php if (isset($_SESSION['registerUserCalled']['username'])) { ?>
                            <div class="alert alert-danger mt-2 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                                <?php echo $_SESSION['registerUserCalled']['username']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="register_password" class="mt-1">Password</label>
                        <input type="password" class="form-control" name="register_password" id="register_password" placeholder="Enter a Password">
                        <small id="emailHelp" class="form-text text-muted">Letters, numbers, spaces, and _-%#@^& allowed. Minimum 8 characters.</small>
                        <?php if (isset($_SESSION['registerUserCalled']['password'])) { ?>
                            <div class="alert alert-danger mt-2 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                                <?php echo $_SESSION['registerUserCalled']['password']; ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['registerUserCalled']['misc'])) { ?>
                            <div class="alert alert-danger mt-2 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                                <?php echo $_SESSION['registerUserCalled']['misc']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lf6XMQUAAAAAMLwxgZonuejdpZSBjJhATwjyPGq"></div>
                    <br />
                    <input type="submit" value="Register" name="register_submit" class="btn btn-outline-primary mt-2"></input>
                </form>
            </div>
        </div>
        <div style="min-height: 5vh; margin-top: 40px;">
            <?php include("./../Footer/Footer.php") ?>
        </div>
    </div>
    <script type="text/javascript">
        const switchToMainPage = () => {
            window.location.href = "./../../index.php";
        }

        const switchToRegisterPage = () => {
            window.location.href = "./Register.php";
        }

        const switchToLoginPage = () => {
            window.location.href = "./Login.php";
        }
    </script>
</body>

</html>