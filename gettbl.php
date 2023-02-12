<?php

    include_once "php/Classes.php";
    if(isset($_GET["v"]))
    {
        Session::tryinit();
        $v_id = $_GET["v"];
        $content = "";
        $dt = new DataTable();
        $customcolumns=array();
        switch($v_id)
        {
        case "1":

            $dt=DataManager::getLogAsDT($mysqli);
            $customcolumns = array("ID", "USER ID", "ACTION", "TIMESTAMP");
            $content=Graphics::generateHTMLtablefromDT($dt, "id=\"TBL_LOG\" class=\"basic_table\"", HeaderOptions::Custom, NullValues::Default , $customcolumns);
            break;

        case "2":
            $dt = DataManager::getRequestsModifiedAsDT($mysqli);
            $content=Graphics::generateHTMLRequestReviewPanel($dt, "id=\"TBL_RVW\" class=\"basic_table\"");
            break;
        case "3":
            $x = Session::try_get("CURRENT_USER");
            $uid = $x->uid;
                $dt = DataManager::getRequestsFromUserModifiedAsDT($uid,$mysqli);
                $customcolumns = array("ID", "USER ID", "USERNAME", "VEHICLE ID", "MANUFACTURER", "MODEL", "DATE FROM", "DATE TO","APPROVED");
                $content=Graphics::generateHTMLtablefromDT($dt, "id=\"TBL_RVW\" class=\"basic_table\"",HeaderOptions::Custom,Nullvalues::Default,$customcolumns);
                break;
        }
        echo $content;

    }


?>