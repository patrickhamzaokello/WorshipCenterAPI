<?php

class Home
{
    public $page;
    private $conn;
    private $imagePathRoot  = "https://d2t03bblpoql2z.cloudfront.net/";



    public function __construct($con, $page)
    {
        $this->conn = $con;
        $this->page = $page;
    }

}