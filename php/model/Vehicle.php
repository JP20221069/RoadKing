<?php
class Vehicle
{
    public $model;
    public $make;
    public $type;
    public $description;
    public $imgpath;

    public function __construct($model=null,$make=null,$type=null,$description=null,$imgpath=null)
    {
        $this->model = $model;
        $this->make = $make;
        $this->type = $type;
        $this->description = $description;
        $this->imgpath = $imgpath;
    }

}

?>