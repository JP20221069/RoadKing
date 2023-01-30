<!DOCTYPE html>
<html>

<head>
    <title>Road King RC</title>
    <!-- DODATI FAVICON -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.typekit.net/qtr6lzm.css">
    <script src="js/validacija.js" type="text/javascript"></script>
    <script src="js/priprema.js" type="text/javascript"></script>
</head>
<?php 
include_once "php/Classes.php";
Session::tryinit(); ?>
<body onload="frm_confirm_Setup()">
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
        <div id="main_content" class="col-12 col-lg-8 rk_maincontent rk_border_collapse_mid rk_border_collapse_top" style="text-align:center">
            <br />

            <h1>Checkout</h1><br/>
            <?php
                include_once "php/Classes.php";

                if(isset($_GET["v"]))
                {
                    $v_id = $_GET["v"];
                    $v = DataManager::getvehicleByID($v_id,$mysqli);
                    Graphics::generatevdetails($v);
                }
            ?>
            <form id="FORM_RENTCONFIRM" action="" method="POST">
            <table class="center">
                <tbody>
                <tr><td>From:</td><td><input id="FIELD_FROM" name="FROM" class="form-control" type="date"/></td><td><p id="LABEL_FROM_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td>To:</td><td> <input id="FIELD_TO" name="TO" class="form-control" type="date"/></td><td><p id="LABEL_TO_ERROR" class="rk_error" style="display:none">*</p></td></tr>
                <tr><td></td><td id="BT_VALIDATE" class="login_form_table_btntd"><input type="button" onclick="frm_rc_Validate()" class="btn btn-danger" value="Confirm"/></td><td></td></tr> 
                </tbody>
            </table>
            </form>
            <p id="LABEL_ERROR" class="rk_error"></p> <br/>
            <a class="btn btn-primary" href="rental.php" id="LNK_RENTAL">Back to rental</a> &nbsp; &nbsp; <a class="btn btn-primary" href="index.php" id="LNK_INDEX">Back to index</a>
            <?php
            include_once "php/Classes.php";
           
            if (isset($_POST["FROM"]) && isset($_POST["TO"]))
            {
                $r = new Request();
                $curr = new User();
                $curr = Session::get_current("CURRENT_USER");
                $r->userid = $curr->uid;
                $r->vehicleid = $_GET["v"];
                $r->startdate = $_POST["FROM"];
                $r->enddate = $_POST["TO"];
                $r->approved = false;
                DataManager::insertRequest($r, $mysqli);
                Graphics::set_invis("FORM_RENTCONFIRM");
                Graphics::display_report("Request submitted. Please wait for review.", "LABEL_ERROR", "rk_info");
                Graphics::alertBox("Request submitted. Please wait for review.");
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