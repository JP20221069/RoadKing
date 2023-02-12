<!DOCTYPE html>
<html>

<head>
    <title>Road King RC</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.typekit.net/qtr6lzm.css">
    <link rel="apple-touch-icon" sizes="180x180" href="pictures/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="pictures/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="pictures/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

</head>
<?php 
include_once "php/Classes.php";
Session::tryinit(); ?>
<body>
    <div class="row">
        <div id="header" class="col-12 rk_header">
            <img class="img-fluid" class="img-fluid" src="pictures/RoadKing banner3.png" />

        </div>


    </div>
    <br />
    <?php Graphics::generateMenu();?>
    <div class="row">
        <div id="side_l" class="d-none d-lg-block col-lg-2 rk_sidecontent rk_border_collapse_top">
            <br />

        </div>
        <div id="main_content" class="col-12 col-lg-8 rk_maincontent rk_border_collapse_mid rk_border_collapse_top">
            <br />
            <?php
            include_once "php/Classes.php";
            $vehs = DataManager::getAllVehiclesAsObjArray($mysqli);
            Graphics::generatecards($vehs);
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