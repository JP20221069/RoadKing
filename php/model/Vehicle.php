<?php
class Vehicle
{
    public $id;
    public $model;
    public $make;
    public $type;
    public $description;
    public $imgpath;

    public function __construct($id=null,$model=null,$make=null,$type=null,$description=null,$imgpath=null)
    {
        $this->id = $id;
        $this->model = $model;
        $this->make = $make;
        $this->type = $type;
        $this->description = $description;
        $this->imgpath = $imgpath;
    }

}

?>