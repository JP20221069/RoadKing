<!DOCTYPE html>
<html>

<head>
    <title>Road King RC</title>
    <!-- DODATI FAVICON -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.typekit.net/qtr6lzm.css">
    <script src="js/validacija.js" type="text/javascript"></script>
</head>

<body>
    <?php
    include_once "php/Classes.php";
    Session::tryinit();
    if(Session::check("LOGGED_IN"))
    {
        Graphics::set_invis("MENU_LOGIN");
        Graphics::set_invis("MENU_SIGNUP");
        Graphics::set_vis("MENU_LOGOFF");
    }
    else
    {
        Graphics::set_invis("MENU_LOGOFF");
    } ?>
    <div class="row">
        <div id="header" class="col-12 rk_header">
            <img class="img-fluid" src="pictures/RoadKing banner3.png"/>
        </div>


    </div>
    <br/>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-inner">
                <div class="container-fluid">
                    <!-- <a class="navbar-brand rk_brand" href="#">Welcome to Road King!</a> -->
                    <img src="pictures/roadking_brand.png" width="300px" height="35px"/>
                    <button class=" navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-controls="main_nav" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Our services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="rental.php">Rental</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">About us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>
                                <ul class="dropdown-menu">
                                    <li id="MENU_LOGIN"><a class="dropdown-item" href="login.php">Log in</a></li>
                                    <li id="MENU_SIGNUP"><a class="dropdown-item" href="#">Sign up</a></li>
                                    <li id="MENU_LOGOFF" style="display:none;"><a class="dropdown-item" href="#">Log off</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
    </div>
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