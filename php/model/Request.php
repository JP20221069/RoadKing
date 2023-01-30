<?php
class Request
{
    public $id;
    public $userid;
    public $vehicleid;
    public $startdate;
    public $enddate;
    public $approved;

    function __construct($id=null,$userid=null,$vehicleid=null,$startdate=null,$enddate=null,$approved=null)
    {
        $this->approved = $approved;
        $this->id = $id;
        $this->userid = $userid;
        $this->vehicleid = $vehicleid;
        $this->startdate = $startdate;
        $this->enddate - $enddate;
    }
}


?>