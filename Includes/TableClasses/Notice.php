<?php

class Notice
{
    private $Table = "notice";
    private $conn;
    private $noticeid, $noticetitle, $noticedescription, $cdate, $created_date;

    /**
     * @param $conn
     * @param $noticeid
     */
    public function __construct($conn, $noticeid)
    {
        $this->conn = $conn;
        $this->noticeid = $noticeid;

        $stmt = $this->conn->prepare("SELECT `noticeid`, `noticetitle`, `noticedescription`, `cdate`, `created_date` FROM " . $this->Table . " WHERE `noticeid` = ? LIMIT 1;");
        $stmt->bind_param("i", $this->noticeid);
        $stmt->execute();
        $stmt->bind_result($this->noticeid, $this->noticetitle, $this->noticedescription, $this->cdate, $this->created_date);

        while ($stmt->fetch()) {
            $this->noticeid = $this->noticeid;
            $this->noticetitle = $this->noticetitle;
            $this->noticedescription = $this->noticedescription;
            $this->cdate = $this->cdate;
            $this->created_date = $this->created_date;
        }
    }

    /**
     * @return mixed
     */
    public function getNoticeid()
    {
        return $this->noticeid;
    }

    /**
     * @return mixed
     */
    public function getNoticetitle()
    {
        return $this->noticetitle;
    }

    /**
     * @return mixed
     */
    public function getNoticedescription()
    {
        return $this->noticedescription;
    }

    /**
     * @return mixed
     */
    public function getCdate()
    {
        return $this->cdate;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        $phpdate = strtotime($this->created_date);
        $mysqldate = date('d M Y h:i A', $phpdate);
        // $mysqldate = date( 'd/M/Y H:i:s', $phpdate );

        return $mysqldate;
    }






}