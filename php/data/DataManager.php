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
    static function checkUserOrEmailExists($username,$email, $mysqli)
    {
        $comm = "SELECT COUNT(*) AS CNT FROM USERS WHERE USER_NAME='" . $username . "' OR EMAIL='" . $email . "';";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                if(intval($row["CNT"])>0)
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

    static function getVehicleByID($id, $mysqli)
    {
        $comm = "SELECT VEHICLES.ID,MODEL,MANUFACTURERS.MANUFACTURERNAME AS MAKE ,VEHICLE_TYPE.VEHTYPE AS VTYPE,DESCRIPTION,IMAGE_PATH FROM VEHICLES INNER JOIN VEHICLE_TYPE ON VEHICLES.VTYPE=VEHICLE_TYPE.ID INNER JOIN MANUFACTURERS ON VEHICLES.MAKE=MANUFACTURERS.ID WHERE VEHICLES.ID=".$id.";";
        $q = $mysqli->query($comm);
        if ($q->num_rows == 0)
        {
            return null;
        }
        else
        {
            while ($row = $q->fetch_assoc())
            {
                $v = new Vehicle();
                $v->id = $row["ID"];
                $v->make = $row["MAKE"];
                $v->model = $row["MODEL"];
                $v->type = $row["VTYPE"];
                $v->description = $row["DESCRIPTION"];
                $v->imgpath = $row["IMAGE_PATH"];

                return $v;
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
                $v->id = $row["ID"];
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

    static function getLogAsDT($mysqli)
    {
        $dt = new DataTable();
        $comm = "SELECT * FROM log;";
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
    static function getRequestsModifiedAsDT($mysqli)
    {
        $dt = new DataTable();
        $comm = "SELECT `rental_request`.`ID`,`rental_request`.`USER_ID`,USERS.USER_NAME,`rental_request`.`VEHICLE_ID`,MANUFACTURERS.MANUFACTURERNAME,VEHICLES.MODEL,`rental_request`.`START_DATE`,`rental_request`.`END_DATE`,`rental_request`.`APPROVED` FROM `data_roadking`.`rental_request` INNER JOIN USERS ON RENTAL_REQUEST.USER_ID=USERS.ID INNER JOIN VEHICLES ON VEHICLE_ID=VEHICLES.ID INNER JOIN MANUFACTURERS ON MANUFACTURERS.ID=VEHICLES.MAKE;";
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

    static function insertRequest(Request $req,$mysqli)
    {
        $temp = $req->approved ? '1' : '0';
        $comm = "INSERT INTO `data_roadking`.`rental_request`(`USER_ID`,`VEHICLE_ID`,`START_DATE`,`END_DATE`,`APPROVED`) VALUES(".$req->userid.",".$req->vehicleid.",'".$req->startdate."','".$req->enddate."',".$temp.");";
        if($q=$mysqli->query($comm))
        {
            return 1;
        }
        else
        {
            throw new Exception("MYSQLI error: " . $mysqli->error);
        }
    }

    static function insertLog(User $usr,$description,$mysqli)
    {
        $datetime = date('d-m-y h:i:s');
        $comm = "INSERT INTO `data_roadking`.`log` (`USER_ID`,`ACTION_DESCRIPTION`,`ACTION_TIME`) VALUES(".$usr->uid.",'".$description."','".$datetime."');"; 
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

    static function setRequestApproved($id, $approved, $mysqli)
    {
        $ap = $approved ? "1" : "0";
        $comm = "UPDATE RENTAL_REQUEST SET APPROVED=" . $ap . " WHERE ID=".$id.";";
        if($q=$mysqli->query($comm))
        {
            return 1;
        }
        else
        {
            throw new Exception("MYSQLI error: " . $mysqli->error);
        }
    }

    //delete
    static function deleteUser($usr, $mysqli)
    {
        $comm = "DELETE FROM USERS WHERE USERS.ID=" . $usr->uid;
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
