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
    Session::tryinit();?>
    <div class="row">
        <div id="header" class="col-12 rk_header">
            <img class="img-fluid" src="pictures/RoadKing banner3.png"/>
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
            <p id="LABEL_GOODBYE" class="rk_goodbye"></p>
            <?php

            if(Session::check("LOGGED_IN"))
            {
                $curr_usr = new User();
                $curr_usr= Session::get_current("CURRENT_USER");
                DataManager::setUserLogged($curr_usr->uid,false,$mysqli);
                Graphics::display_report("Goodbye, " . $curr_usr->username. "!", "LABEL_GOODBYE");
                Session::delete("CURRENT_USER");
                Session::delete("LOGGED_IN");
                DataManager::insertLog($curr_usr, "Logged off.", $mysqli);
            }

            ?>
            </div>
        </div>
        <div id="side_r" class="d-none d-lg-block col-lg-2 rk_sidecontent rk_border_collapse_top">
            <br />
        </div>
    </div>
    <div class="row">
        <div id="footer" class="col-12 rk_footer rk_border_collapse_top">
            
        </div>

    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>


</html>