<?php

include_once __DIR__."/../Classes.php";
class Graphics
{
    static function generatetablefromDBobjarray($acols,$objrows,$attr="",$header_options=HeaderOptions::Default,$null_options=NullValues::Default,$customcolumns=null)
    {
        echo "<table ".$attr.">";
        
        if($header_options!=HeaderOptions::NoHeader && $header_options!=HeaderOptions::Default)
        {
            if($header_options==HeaderOptions::Header)
            {
                echo "<thead>";
                echo "<tr>";
                foreach($acols as $col)
                {
                    echo "<th>" . $col . "</th>";
                }
                echo "</tr>";
                echo "</thead>";

            }
            else if($header_options==HeaderOptions::Custom)
            {
                if(count($customcolumns)!=count($acols))
                {
                    throw new Exception("Unable to create table! Different number of custom columns!");
                }
                else
                {
                echo "<thead>";
                echo "<tr>";
                foreach($customcolumns as $col)
                {
                    echo "<th>" . $col . "</th>";
                }
                echo "</tr>";
                echo "</thead>";
                }
            }
        }
        $defaultnull="";
        switch($null_options)
        {
            case NullValues::NullText:
                $defaultnull = "NULL";
                break;
            case NullValues::NA:
                $defaultnull = "N/A";
                break;
            case NullValues::NullTextSmall:
                $defaultnull = "null";
                break;
            case NullValues::Blanks:
                $defaultnull = " ";
                break;
        }
    
        foreach($objrows as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($acols);$i++)
            {
                echo "<td>";
                $ob= $obj[$acols[$i]];
                if($ob==null)
                {
                    echo $defaultnull;
                }
                else
                {
                    echo $ob;
                }
                echo "</td>";
            }
        }
        echo "</table>";
    }

    static function generatetablefromDT($dt,$attr="",$header_options=HeaderOptions::Default,$null_options=NullValues::Default,$customcolumns=null)
    {
        $objrows = $dt->Rows;
        $acols = $dt->Columns;

        echo "<table ".$attr.">";
        if($header_options!=HeaderOptions::NoHeader && $header_options!=HeaderOptions::Default)
        {
            if($header_options==HeaderOptions::Header)
            {
                echo "<thead>";
                echo "<tr>";
                foreach($acols as $col)
                {
                    echo "<th>" . $col . "</th>";
                }
                echo "</tr>";
                echo "</thead>";
            }
            else if($header_options==HeaderOptions::Custom)
            {
                if(count($customcolumns)!=count($acols))
                {
                    throw new Exception("Unable to create table! Different number of custom and predefined columns!");
                }
                else
                {
                echo "<thead>";
                echo "<tr>";
                foreach($customcolumns as $col)
                {
                    echo "<th>" . $col . "</th>";
                }
                echo "</tr>";
                echo "</thead>";
                }
            }
        }
        $defaultnull="";
        switch($null_options)
        {
            case NullValues::NullText:
                $defaultnull = "NULL";
                break;
            case NullValues::NA:
                $defaultnull = "N/A";
                break;
            case NullValues::NullTextSmall:
                $defaultnull = "null";
                break;
            case NullValues::Blanks:
                $defaultnull = " ";
                break;
        }
        foreach($objrows as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($acols);$i++)
            {
                echo "<td>";
                $ob= $obj[$acols[$i]];
                if($ob==null)
                {
                    echo $defaultnull;
                }
                else
                {
                    echo $ob;
                }
                echo "</td>";
            }
        }
        echo "</table>";
    }

    static function generatetablefromobjarray($objarray,$table_attr="",$header_options=HeaderOptions::Default,$null_options=NullValues::Default,$customcolumns=null)
    {
        if (count($objarray) == 0)
        {
            throw new Exception('Empty array.');
        }
        if($objarray[0]==null)
        {
            throw new Exception('Null array.');
        }
        $classname = get_class($objarray[0]);
        $RC = new ReflectionClass($classname);
        $props = $RC->getProperties(ReflectionProperty::IS_PUBLIC);

        echo "<table ".$table_attr.">";
        if($header_options!=HeaderOptions::NoHeader && $header_options!=HeaderOptions::Default)
        {
            if($header_options==HeaderOptions::Header)
            {
                echo "<thead>";
                echo "<tr>";
                foreach($props as $prop)
                {
                    echo "<th>" . $prop->name . "</th>";
                }
                echo "</tr>";
                echo "</thead>";
            }
            else if($header_options==HeaderOptions::Custom)
            {
                if(count($customcolumns)!=count($props))
                {
                    throw new Exception("Unable to create table! Different number of custom and predefined columns!");
                }
                else
                {
                echo "<thead>";
                echo "<tr>";
                foreach($customcolumns as $col)
                {
                    echo "<th>" . $col . "</th>";
                }
                echo "</tr>";
                echo "</thead>";
                }
            }
        }
        $defaultnull="";
        switch($null_options)
        {
            case NullValues::NullText:
                $defaultnull = "NULL";
                break;
            case NullValues::NA:
                $defaultnull = "N/A";
                break;
            case NullValues::NullTextSmall:
                $defaultnull = "null";
                break;
            case NullValues::Blanks:
                $defaultnull = " ";
                break;
        }
        foreach($objarray as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($props);$i++)
            {
                echo "<td>";
                $ob= $RC->getProperty($props[$i]->name)->getValue($obj);
                if($ob==null)
                {
                    echo $defaultnull;
                }
                else
                {
                    echo $ob;
                }
                echo "</td>";
            }
        }
        echo "</table>";
        
    }

    public static function display_report($reporttext,$label_id,$class=null)
    {
        $var= "<script type=\"text/javascript\">document.getElementById(\"" . $label_id . "\").innerText=\"" . $reporttext . "\";     document.getElementById(\"".$label_id."\").setAttribute(\"style\",\"\");</script>";
        if($class!=null)
        {
            $var = $var . "<script type=\"text/javascript\">document.getElementById(\"" . $label_id . "\").setAttribute(\"class\",\"" . $class . "\");</script>";
        }
        echo $var;
    }
    

    public static function set_vis($elementid)
    {
        $var= "<script type=\"text/javascript\">document.getElementById(\"".$elementid."\").setAttribute(\"style\",\"\");</script>";
        echo $var;
    }

    public static function set_invis($elementid)
    {
        $var= "<script type=\"text/javascript\">document.getElementById(\"".$elementid."\").setAttribute(\"style\",\"display:none;\");</script>";
        echo $var;
    }

    public static function generatecards($vehs)
    {
        $count = count($vehs);
        $rowcount = $count / 3;
        echo '<div class="container-fluid">';
        $array_count=0;
        for($i=0;$i<$rowcount;$i++)
        {
            echo '<div class="row justify-content-around mb-4">';
            for($j=0;$j<3 && $j<$count;$j++)
            {
                echo '<div class="col-lg-4">';
                echo'        <div class="card" style="width:400px">';
                echo'            <img class="card-img-top" src="'.$vehs[$array_count]->imgpath.'" alt="Card image">';
                echo'            <div class="card-body">';
                echo'                <h4 class="card-title">'.$vehs[$array_count]->make.' '.$vehs[$array_count]->model.'</h4>';
                echo'                <h5 class="card-title"></h5>';
                echo'                <p class="card-text">'.$vehs[$array_count]->description.' </p>';
                echo'                <a href="" target="" class="btn btn-primary" onclick="window.alert(\''.$vehs[$array_count]->description.'\');">More Information</a>';
                if(Session::try_get("CURRENT_USER")!=null)
                {

                    echo'                <a href="rentconfirm.php?v='.$vehs[$array_count]->id.'" target="" class="btn btn-primary">Rent</a>';
                }
                echo'            </div>';
                echo'        </div>';
                echo '    </div>';
                $array_count++;
            }
            echo '</div>';
        } 
        echo '</div>';
    }

    public static function generatevdetails(Vehicle $v)
    {
        echo '<img src="'.$v->imgpath.'" class="rounded mx-auto d-block" alt="Vehicle">';
        echo '<h1>'.$v->make.' '.$v->model.'</h1>';
    }

    public static function alertBox($text)
    {
        echo '<script type="text/javascript"> window.alert("' . $text . '");</script>';
    }

    public static function generateMenu()
    {

        $usr = new User();
        $li = false;
        $li = Session::try_get("LOGGED_IN");
        $usr = Session::try_get("CURRENT_USER");
        echo '    <div class="row">';
        echo '    <nav class="navbar navbar-expand-lg navbar-inner">';
        echo '                <div class="container-fluid">';
        echo '                    <a id="brand" class="navbar-brand rk_brand">Welcome to Road King!</a>';
        echo '                    <button class=" navbar-toggler navbar-dark " type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-controls="main_nav" aria-expanded="false">';
        echo '                        <span class="navbar-toggler-icon"></span>';
        echo '                    </button>';
        echo '                    <div class="collapse navbar-collapse " id="main_nav">';
        echo '                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        echo '                            <li class="nav-item">';
        echo '                                <a class="nav-link active rk_link" href="index.php">Home</a>';
        echo '                            </li>';
        echo '                            <li class="nav-item">';
        echo '                                <a class="nav-link active" href="ourservices.php">Our services</a>';
        echo '                            </li>';
        echo '                            <li class="nav-item">';
        echo '                                <a class="nav-link active" href="rental.php">Rental</a>';
        echo '                            </li>';
        echo '                            <li class="nav-item">';
        echo '                                <a class="nav-link active" href="aboutus.php">About us</a>';
        echo '                            </li>';
        echo '                            <li class="nav-item dropdown">';
        echo '                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>';
        echo '                                <ul class="dropdown-menu">';
        if ($li)
        {
            echo '                                    <li id="MENU_MYREQ"><a class="dropdown-item" href="myrequests.php">My Requests</a></li>';
            echo '                                    <li id="MENU_LOGOFF"><a class="dropdown-item" href="logoff.php">Log off</a></li>';
        }
        else
        {
            echo '                                    <li id="MENU_LOGIN"><a class="dropdown-item" href="login.php">Log in</a></li>';
            echo '                                    <li id="MENU_SIGNUP"><a class="dropdown-item" href="signup.php">Sign up</a></li>';
        }
        echo '                                </ul>';
        echo '                            </li>';

        if ($li)
        {
            if ($usr->role == Roles::Moderator || $usr->role == Roles::Administrator)
            {
                echo '                            <li id="MENU_MODTOOLS" class="nav-item dropdown">';
                echo '                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Moderator tools</a>';
                echo '                                <ul class="dropdown-menu">';
                echo '                                    <li><a class="dropdown-item" href="review.php">Review requests</a></li>';
                echo '                                </ul>';
                echo '                            </li>';
            }
        }
        if ($li)
        {
            if ($usr->role == Roles::Administrator)
            {
                echo '                            <li id="MENU_ADMINTOOLS" class="nav-item dropdown">';
                echo '                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Administrator tools</a>';
                echo '                                <ul class="dropdown-menu">';
                echo '                                    <li><a class="dropdown-item" href="log.php">Review log</a></li>';
                echo '                                </ul>';
                echo '                            </li>';
            }
        }
        echo '                        </ul>';
        echo '                    </div>';
        echo '                </div>';
        echo '            </nav>';
        echo '    </div>';
    }

    public static function generateRequestReviewPanel(DataTable $dt,$table_attr="")
    {
        echo '<form id="FORM_RQRVW" action="" method="POST">';
        echo '<table ' . $table_attr . '>';
        echo '<tr><th>Request ID</th><th>User ID</th><th>User name</th><th>Vehicle ID</th><th>Manufacturer</th><th>Model</th><th>Start Date</th><th>End Date</th><th>Approved</th><th>Allow</th><th>Deny</th>';
        $objrows = $dt->Rows;
        foreach($objrows as $r)
        {
            echo '<tr><td>' . $r["ID"] . '</td><td>' . $r["USER_ID"] . '</td><td>' . $r["USER_NAME"] . '</td><td>' . $r["VEHICLE_ID"] . '</td><td>' . $r["MANUFACTURERNAME"] . '</td><td>' . $r["MODEL"] . '</td><td>' . $r["START_DATE"] . '</td><td>' . $r["END_DATE"] . '</td><td>' . $r["APPROVED"] . '</td><td><button type="submit" name="allow" value="' . $r["ID"] . '">Allow</button></td><td><button type="submit" name="deny" value="' . $r["ID"] . '">Deny</button></td></tr>';
        }
        echo '</table>';
        echo '</form>';
    }
    public static function generateHTMLRequestReviewPanel(DataTable $dt,$table_attr="")
    {
        $res = "";
        $res.= '<form id="FORM_RQRVW" action="" method="POST">';
        $res.= '<table ' . $table_attr . '>';
        $res.= '<tr><th>Request ID</th><th>User ID</th><th>User name</th><th>Vehicle ID</th><th>Manufacturer</th><th>Model</th><th>Start Date</th><th>End Date</th><th>Approved</th><th>Allow</th><th>Deny</th>';
        $objrows = $dt->Rows;
        foreach($objrows as $r)
        {
            $res.= '<tr><td>' . $r["ID"] . '</td><td>' . $r["USER_ID"] . '</td><td>' . $r["USER_NAME"] . '</td><td>' . $r["VEHICLE_ID"] . '</td><td>' . $r["MANUFACTURERNAME"] . '</td><td>' . $r["MODEL"] . '</td><td>' . $r["START_DATE"] . '</td><td>' . $r["END_DATE"] . '</td><td>' . $r["APPROVED"] . '</td><td><button type="submit" name="allow" value="' . $r["ID"] . '">Allow</button></td><td><button type="submit" name="deny" value="' . $r["ID"] . '">Deny</button></td></tr>';
        }
        $res.= '</table>';
        $res.= '</form>';
        return $res;
    }
    static function generateHTMLtablefromDT($dt,$attr="",$header_options=HeaderOptions::Default,$null_options=NullValues::Default,$customcolumns=null)
    {
        $objrows = $dt->Rows;
        $acols = $dt->Columns;
        $res = "";
        $res.= "<table ".$attr.">";
        if($header_options!=HeaderOptions::NoHeader && $header_options!=HeaderOptions::Default)
        {
            if($header_options==HeaderOptions::Header)
            {
                $res.= "<thead>";
                $res.= "<tr>";
                foreach($acols as $col)
                {
                    $res.= "<th>" . $col . "</th>";
                }
                $res.= "</tr>";
                $res.= "</thead>";
            }
            else if($header_options==HeaderOptions::Custom)
            {
                if(count($customcolumns)!=count($acols))
                {
                    throw new Exception("Unable to create table! Different number of custom and predefined columns!");
                }
                else
                {
                $res.= "<thead>";
                $res.= "<tr>";
                foreach($customcolumns as $col)
                {
                    $res.= "<th>" . $col . "</th>";
                }
                $res.= "</tr>";
                $res.= "</thead>";
                }
            }
        }
        $defaultnull="";
        switch($null_options)
        {
            case NullValues::NullText:
                $defaultnull = "NULL";
                break;
            case NullValues::NA:
                $defaultnull = "N/A";
                break;
            case NullValues::NullTextSmall:
                $defaultnull = "null";
                break;
            case NullValues::Blanks:
                $defaultnull = " ";
                break;
        }
        foreach($objrows as $obj)
        {
            $res.= "<tr>";
            for($i=0;$i<count($acols);$i++)
            {
                $res.= "<td>";
                $ob= $obj[$acols[$i]];
                if($ob==null)
                {
                    $res.= $defaultnull;
                }
                else
                {
                    $res.= $ob;
                }
                $res.= "</td>";
            }
        }
        $res.= "</table>";
        return $res;
    }

}

?>