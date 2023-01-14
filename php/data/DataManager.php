<?php

include_once __DIR__."/../Classes.php";
class DataManager
{


static function getUserByID($id,$mysqli)
{
    $comm = 'SELECT * FROM users WHERE ID=$id';
    $q = $mysqli->query($comm);
    if($q->num_rows==0)
    {
        return null;
    }
    else
    {
        $datarow = $q->fetch_object();
        return $datarow;
    }
}

static function getAllUsers($mysqli)
{
    $dt = new DataTable();
    $comm = 'SELECT * FROM users;';
    $q = $mysqli->query($comm);
    if($q->num_rows==0)
    {
        return null;
    }
    else
    {
            $usrs = array();
        while($row=$q->fetch_assoc())
        {
                $u = new User();
                $u->uid = $row["ID"];
                $u->username = $row["USER_NAME"];
                $u->e_mail = $row["EMAIL"];
                array_push($usrs, $u);
        }
            Graphics::generatetablefromobjarray($usrs);
    }
}

}
