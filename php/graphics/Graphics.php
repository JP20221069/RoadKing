<?php

include_once __DIR__."/../Classes.php";
class Graphics
{
    static function generatetablefromdbobjarray($acols,$objrows,$attr="")
    {
        echo "<table".$attr.">";
        foreach($objrows as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($acols);$i++)
            {
                echo "<td>";
                echo $obj[$acols[$i]];
                echo "</td>";
            }
        }
        echo "</table>";
    }

    static function generatetablefromDT($dt,$attr="")
    {
        $objrows = $dt->Rows;
        $acols = $dt->Columns;
        echo "<table".$attr.">";
        foreach($objrows as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($acols);$i++)
            {
                echo "<td>";
                echo $obj[$acols[$i]];
                echo "</td>";
            }
        }
        echo "</table>";
    }

    static function generatetablefromobjarray($objarray,$attr="")
    {
        if (count($objarray) == 0)
        {
            return; //ADD THROW
        }
        if($objarray[0]==null)
        {
            return; //ADD THROW
        }
        $classname = get_class($objarray[0]);
        $RC = new ReflectionClass($classname);
        $props = $RC->getProperties(ReflectionProperty::IS_PUBLIC);
        echo "<table".$attr.">";
        foreach($objarray as $obj)
        {
            echo "<tr>";
            for($i=0;$i<count($props);$i++)
            {
                echo "<td>";
                echo $RC->getProperty($props[$i]->name)->getValue($obj);
                echo "</td>";
            }
        }
        echo "</table>";
        
    }
}

?>