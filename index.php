<?php
include("./queries/adminQueries.php");

if (isset($_POST['login_submit'])) {
    $userData = loginUser();
    session_start();
    if (isset($userData['login_id']) && isset($userData['login_username'])) {
        $_POST = array();
        setcookie('login_id', $userData['login_id']);
        setcookie('login_username', $userData['login_username']);
        foreach ($_SESSION as $variable) {
            $variable = NULL;
        }
        header("Refresh:0");
    } else if ($userData === NULL) {
        $_POST = array();
        $_SESSION['login_username_error'] = "Username or Password is wrong.";
        $_SESSION['login_password_error'] = "Username or Password is wrong.";
        header("Location: ./views/Pages/Login.php");
    } else {
        $_POST = array();
        $_SESSION['login_username_error'] = $userData['username'];
        $_SESSION['login_password_error'] = $userData['password'];
        $_SESSION['login_misc_error'] = $userData['misc'];
        header("Location: ./views/Pages/Login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7e63e75969.js" crossorigin="anonymous"></script>
    <title>Job Seeker's Log</title>
    <style type="text/css">
    </style>
</head>

<body onload="onloadFunction()">
    <div id="Index" style="min-height: 95vh;">
        <?php include("./views/AddingAJobPopup/AddingAJobPopup.php"); ?>
        <?php include("./views/UpdatingAJobPopup/UpdatingAJobPopup.php"); ?>
        <?php include("./views/NavBar/NavBar.php"); ?>
        <?php include("./views/Header/Header.php") ?>
        <?php include("./views/JobCards/JobCards.php") ?>
    </div>
    <div style="min-height: 5vh;">
        <?php include("./views/Footer/Footer.php") ?>
    </div>
    <script type="text/javascript">
        const onloadFunction = () => {
            let scrollPosition = window.location.search.substring(3);
            if (scrollPosition !== "") {
                window.scrollTo(0, Number(scrollPosition));
            }

            let findRegex = document.cookie.indexOf("regex");
            if (findRegex === -1) {
                return;
            }
            let regexFound = document.cookie.substring(findRegex);
            let findEqualSign = regexFound.indexOf("=");
            let findSemiColon = regexFound.indexOf(";") !== -1 ? regexFound.indexOf(";") : regexFound.length;
            let valueFound = regexFound.substring(findEqualSign + 1, findSemiColon);
            document.getElementById("job-search").value = valueFound;
        }

        const setRegexCookie = (e) => {
            document.cookie = `regex=${e.replace(/\//, "")}`;
        }

        const user_logout = () => {
            document.cookie = "login_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=./index.php;";
            document.cookie = "login_username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=./index.php;";
            window.location.reload();
        }

        //Header Functions
        const onclickAddJobButton = () => {
            document.body.style.overflow = "hidden";
            document.getElementById("AddingAJobPopup").style.display = "block";
        }

        const onclickUpdateJobButton = () => {
            document.body.style.overflow = "hidden";
            document.getElementById("UpdatingAJobPopup").style.display = "block";
        }

        //AddingAJobPopup Functions
        const onclickCloseAddJobForm = () => {
            document.body.style.overflow = "visible";
            document.getElementById("AddingAJobPopup").style.display = "none";

            document.getElementById("company_name").value = "";
            document.getElementById("company_position").value = "";
            document.getElementById("company_website").value = "";
            document.getElementById("date_applied").value = "";
            document.getElementById("company_location").value = "";
            document.getElementById("about_company").value = "";
            document.getElementById("about_position").value = "";
            document.getElementById("company_notes").value = "";
        }

        const onclickCloseUpdateJobForm = () => {
            document.body.style.overflow = "visible";
            document.getElementById("UpdatingAJobPopup").style.display = "none";
        }

        //JobCard Functions
        const updatingACard = (e) => {
            for (const key in e) {
                document.getElementById("updating_" + key).value = e[key];
            }
            document.getElementById("updating_scroll").value = Math.floor(document.documentElement.scrollTop);
            onclickUpdateJobButton();
        }

        const deletingACard = (e) => {
            fetch("./queries/deleteJob.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "functionName": "deleteJob",
                    "arguments": Number(e)
                })
            }).then(() => {
                window.location.reload();
            }).catch((error) => {
                console.log("Catch all error: ", error);
            })
        }

        const switchToRegisterPage = () => {
            window.location.href = "./views/Pages/Register.php";
        }

        const switchToLoginPage = () => {
            window.location.href = "./views/Pages/Login.php";
        }

        const switchToMainPage = () => {
            window.location.href = "./index.php";
        }
    </script>
</body>

</html>