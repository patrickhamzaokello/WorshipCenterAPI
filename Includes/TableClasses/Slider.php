<?php

class Slider
{

    private $Table = "slider";
    private $conn;
    private $sliderid, $serialid, $filename, $cdate;


    public function __construct($conn, $sliderid)
    {
        $this->conn = $conn;
        $this->sliderid = $sliderid;

        $stmt = $this->conn->prepare("SELECT `sliderid`, `serialid`, `filename`, `cdate` FROM " . $this->Table . " WHERE sliderid = ? LIMIT 1;");
        $stmt->bind_param("i", $this->sliderid);
        $stmt->execute();
        $stmt->bind_result($this->sliderid, $this->serialid, $this->filename, $this->cdate);

        while ($stmt->fetch()) {
            $this->sliderid = $this->sliderid;
            $this->serialid = $this->serialid;
            $this->filename = $this->filename;
            $this->cdate = $this->cdate;
        }


    }

    /**
     * @return mixed
     */
    public function getSliderid()
    {
        return $this->sliderid;
    }

    /**
     * @return mixed
     */
    public function getSerialid()
    {
        return $this->serialid;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        $imagePath =  "https://ad.worshipcenterdowntown.com/assets/assets/images/website/slider/";

//        if link doesnt start with http, add the default image path
        if (!(strpos($this->filename, 'http') === 0)) {
            $this->filename = $imagePath.$this->filename;
        }
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getCdate()
    {
        return $this->cdate;
    }


}