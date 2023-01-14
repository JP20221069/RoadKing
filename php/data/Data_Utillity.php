<?php
class Data_Utillity
{
    public static function getcolnamearray($cols)
    {
        $ret = array();
        foreach($cols as $col)
        {
            array_push($ret, $col->name);
        }
        return $ret;
    }
}