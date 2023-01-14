<?php
include_once __DIR__ . "/Data_Utillity.php";
class DataTable
{
    public $Columns;
    public $Rows;

    public $Empty=true;

    public function __construct($Columns=null,$Rows=null)
    {
        $this->Columns = $Columns;
        $this->Rows = $Rows;
        if (!$Rows == null)
        {
            if (count($Rows) > 0)
            {
                $Empty = false;
            }
        }
    }

    public static function fromQuery($q)
    {
        $acols = Data_Utillity::getcolnamearray($q->fetch_fields());
        $arows = array();
        while ($datarow = $q->fetch_assoc())
        {
            array_push($arows, $datarow);
        }
        $instance = new DataTable($acols, $arows);
        return $instance;
    }



}
?>