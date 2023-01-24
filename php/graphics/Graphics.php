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

    public static function display_report($reporttext,$label_id)
    {
        $var= "<script type=\"text/javascript\">document.getElementById(\"" . $label_id . "\").innerText=\"" . $reporttext . "\";     document.getElementById(\"".$label_id."\").setAttribute(\"style\",\"\");</script>";
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
                echo'                <a href="" target="" class="btn btn-primary">More Information</a>';
                echo'                <a href="" target="" class="btn btn-primary">Rent</a>';
                echo'            </div>';
                echo'        </div>';
                echo '    </div>';
                $array_count++;
            }
            echo '</div>';
        } 
        echo '</div>';
    }
}

?>