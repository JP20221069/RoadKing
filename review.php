<!DOCTYPE html>
<html>

<head>
    <title>Road King RC</title>
 
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.typekit.net/qtr6lzm.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/validacija.js" type="text/javascript"></script>
    <script src="js/ajx_main.js" type="text/javascript"></script>
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
    <?php Graphics::generateMenu();
        $x=Session::try_get("CURRENT_USER");
        if (Permission::checkHasRights($x, Roles::Administrator)==false && Permission::checkHasRights($x, Roles::Moderator)==false)
        {
            echo 'You do not have the required rights to view this page.';
            exit;
        }?>
    <div class="row">
        <div id="side_l" class="d-none d-lg-block col-lg-2 rk_sidecontent rk_border_collapse_top">
            <br />
        </div>
        <div id="main_content" class="col-12 col-lg-8 d-flex justify-content-center rk_maincontent rk_border_collapse_mid rk_border_collapse_top">
            <div class="centeredcontent">
            <br />
            <button id="requestrefresher">Refresh</button>
            <br/>
            <?php
            $dt = DataManager::getRequestsModifiedAsDT($mysqli);
            Graphics::generateRequestReviewPanel($dt, "id=\"TBL_RVW\" class=\"basic_table\"");
            if(isset($_POST["allow"]))
            {
                DataManager::setRequestApproved($_POST["allow"], true,$mysqli);
                echo '<p id="LABEL_ERROR" class="rk_info">Approved request ID ' . $_POST["allow"] . '</p>';
            }
            if(isset($_POST["deny"]))
            {
                DataManager::setRequestApproved($_POST["deny"], false,$mysqli);
                echo '<p id="LABEL_ERROR" class="rk_info">Denied request ID ' . $_POST["deny"] . '</p>';
            }
            ?>
            <br/>
            
        </div>
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