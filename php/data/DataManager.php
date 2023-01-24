<?php

include_once __DIR__."/../Classes.php";
class DataManager
{
    //get single objects
    static function getUserByID($id, $mysqli)
    {
        $comm = "SELECT * FROM users WHERE ID=".$id.";";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                $u = new User();
                $u->uid = $row["ID"];
                $u->username = $row["USER_NAME"];
                $u->e_mail = $row["EMAIL"];
                $u->role = Roles::FromNumber(intval($row["USER_ROLE"]));
                $u->password = null;
                return $u;
            }
        }
    }
    static function getUserByName($username, $mysqli)
    {
        $comm = "SELECT * FROM users WHERE USER_NAME='" . $username . "';";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                $u = new User();
                $u->uid = $row["ID"];
                $u->username = $row["USER_NAME"];
                $u->e_mail = $row["EMAIL"];
                $u->role = Roles::FromNumber(intval($row["USER_ROLE"]));
                $u->password = null;
                return $u;
            }
        }
    }
    static function getUserUIDByName($username, $mysqli)
    {
        $comm = "SELECT * FROM users WHERE USER_NAME='".$username."';";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                return $row["ID"];
            }
        }
    }
    static function checkUserPass($username,$password, $mysqli)
    {
        $comm = "SELECT * FROM users WHERE USER_NAME='".$username."' AND PASS='".$password."';";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                $u = new User();
                $u->uid = $row["ID"];
                $u->username = $row["USER_NAME"];
                $u->e_mail = $row["EMAIL"];
                $u->role = Roles::FromNumber(intval($row["USER_ROLE"]));
                $u->password = $row["PASS"];;
                if($u->password==$password && $u->username==$username)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }
    //get multiple objects
    static function getAllUsersAsObjArray($mysqli)
    {
        $comm = "SELECT * FROM users;";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            $usrs = array();
            while ($row = $q->fetch_assoc())
            {
                $u = new User();
                $u->uid = $row["ID"];
                $u->username = $row["USER_NAME"];
                $u->e_mail = $row["EMAIL"];
                $u->role = Roles::FromNumber(intval($row["USER_ROLE"]));
                array_push($usrs, $u);
            }
        }
        return $usrs;
    }
    static function getAllUsersAsDT($mysqli)
    {
        $dt = new DataTable();
        $comm = "SELECT * FROM users;";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            $dt = DataTable::fromQuery($q);
        }
        return $dt;
    }

    static function getAllVehiclesAsObjArray($mysqli)
    {
        $comm = "SELECT VEHICLES.ID,MODEL,MANUFACTURERS.MANUFACTURERNAME AS MAKE ,VEHICLE_TYPE.VEHTYPE AS VTYPE,DESCRIPTION,IMAGE_PATH FROM VEHICLES INNER JOIN VEHICLE_TYPE ON VEHICLES.VTYPE=VEHICLE_TYPE.ID INNER JOIN MANUFACTURERS ON VEHICLES.MAKE=MANUFACTURERS.ID;";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            $vehs = array();
            while ($row = $q->fetch_assoc())
            {
                $v = new Vehicle();
                $v->make = $row["MAKE"];
                $v->model = $row["MODEL"];
                $v->type = $row["VTYPE"];
                $v->description = $row["DESCRIPTION"];
                $v->imgpath = $row["IMAGE_PATH"];

                array_push($vehs,$v);
            }
        }
        return $vehs;
    }

    //insert
    static function insertUser(User $usr,$mysqli)
    {
        $comm = "INSERT INTO USERS(USER_NAME,EMAIL,PASS,USER_ROLE,LOGGED_IN) VALUES(" . $usr->username. "," . $usr->e_mail . "," . $usr->password . "," . $usr->role . ",0);";
        if($q=$mysqli->query($comm))
        {
            return 1;
        }
        else
        {
            throw new Exception("MYSQLI error: " . $mysqli->error);
        }
    }
    //update
    static function setUserLogged($uid, $loggedin, $mysqli)
    {
        $l_i = $loggedin ? "1" : "0";
        $comm = "UPDATE USERS SET LOGGED_IN=" . $l_i . " WHERE ID=".$uid.";";
        if($q=$mysqli->query($comm))
        {
            return 1;
        }
        else
        {
            throw new Exception("MYSQLI error: " . $mysqli->error);
        }
    }

}
