<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Job Seeker's Log - Login</title>
    <style type="text/css">
        body {
            background-color: #F8F8F8;
            min-height: 100vh;
        }

        .login_main_container {
            height: 100%;
        }

        .login_form_container {
            width: 50%;
            height: 360px;
            margin-right: auto;
            margin-left: auto;
            position: relative;
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="login_main_container">
        <div style="display: flex; justify-content: flex-end; align-items: center;" class="pt-3 pr-4 pb-3 border-bottom">
            <h4 style="margin-right: auto; margin-bottom: 0px; padding-left: 15px; cursor: pointer;" onclick="switchToMainPage()">Job Seeker's Log</h4>
            <button type="button" class="btn btn-outline-dark" onclick="switchToRegisterPage()">Register</button>
            <button type="button" class="btn btn-dark ml-2" onclick="switchToLoginPage()">Login</button>
        </div>
        <div class="login_form_container p-4 border">
            <h2 class="p-3 mb-2 bg-dark text-white">Login</h2>
            <form method="post" action="./../../index.php">
                <div class="form-group">
                    <label for="login_username" class="mt-2">Username</label>
                    <input type="text" class="form-control" name="login_username" id="login_username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="login_password" class="mt-1">Password</label>
                    <input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password">
                </div>
                <input type="submit" value="Login" name="login_submit" class="btn btn-outline-primary mt-2"></input>
            </form>
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

        const login = () => {

        }
    </script>
</body>

</html>