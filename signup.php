<!DOCTYPE html>
<html>

<head>
    <title>Road King RC</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.typekit.net/qtr6lzm.css">
    <script src="js/validacija.js" type="text/javascript"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="pictures/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="pictures/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="pictures/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

</head>

<body>
    <?php
    include_once "php/Classes.php";
    Session::tryinit();
     ?>
    <div class="row">
        <div id="header" class="col-12 rk_header">
            <img src="pictures/RoadKing banner3.png"/>
        </div>


    </div>
    <br/>
    <?php Graphics::generateMenu();?>
    <div class="row">
        <div id="side_l" class="d-none d-lg-block col-lg-2 rk_sidecontent rk_border_collapse_top">
            <br />
        </div>
        <div id="main_content" class="col-12 col-lg-8 d-flex justify-content-center rk_maincontent rk_border_collapse_mid rk_border_collapse_top">
            <br />
            <div class="w-50 p-3 ">
            <form id="FORM_SIGNUP" action="" method="POST">
                <table>
                    <tbody>
                <tr><td>Username:</td><td><input id="FIELD_USERNAME" name="USERNAME" class="form-control" type="text"/></td><td><p id="LABEL_USERNAME_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td>Password:</td><td> <input id="FIELD_PASSWORD" name="PASSWORD" class="form-control" type="password"/></td><td><p id="LABEL_PASSWORD_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td>Repeat password:</td><td> <input id="FIELD_RPASSWORD" name="PASSWORD" class="form-control" type="password"/></td><td><p id="LABEL_RPASSWORD_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td>E-mail:</td><td> <input id="FIELD_EMAIL" name="EMAIL" class="form-control" type="text"/></td><td><p id="LABEL_EMAIL_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td></td><td class="login_form_table_btntd"><input type="button" onclick="frm_signup_Validate()" class="btn btn-danger" value="Sign up"/></td><td></td></tr> 
                    </tbody>
                </table>
            </form>
            <p id="LABEL_ERROR" class="rk_error" style="display:none"></p>
            <p id="LABEL_INFO" style="display:none"></p>
            </div>
            <?php
            if(isset($_POST["USERNAME"]) and isset($_POST["PASSWORD"]) and isset($_POST["EMAIL"]))
            {
                $uname = $_POST["USERNAME"];
                $email = $_POST["EMAIL"];
                $pword = $_POST["PASSWORD"];
               if(DataManager::checkUserOrEmailExists($uname,$email,$mysqli))
               {
                    Graphics::display_report("Username or Email already registered!", "LABEL_ERROR");
               }
               else
               {
                    $usr = new User($uname, $pword, $email, Roles::User);
                    DataManager::insertUser($usr, $mysqli);
                    $usr= DataManager::getUserByName($uname,$mysqli);
                    DataManager::insertLog($usr, "Registered.", $mysqli);
                    Graphics::display_report("Successfully registered! You may now log in!", "LABEL_INFO");

               }
            }
            ?>
        </div>
        <div id="side_r" class="d-none d-lg-block col-lg-2 rk_sidecontent rk_border_collapse_top">
            <br />
        </div>
    </div>
    <div class="row">
        <div id="footer" class="col-12 rk_footer rk_border_collapse_top">
            <br />
        </div>

    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>


</html>