<?php

class Event
{
    private $Table = "event";
    private $conn;
    private $eventid, $eventimage, $eventtitle, $eventdate, $eventtime, $eventlocation, $eventdescription, $eventstartdate, $eventenddate, $cdate;

    /**
     * @param $conn
     * @param $eventid
     */
    public function __construct($conn, $eventid)
    {
        $this->conn = $conn;
        $this->eventid = $eventid;

        $stmt = $this->conn->prepare("SELECT `eventid`, `eventimage`, `eventtitle`, `eventdate`, `eventtime`, `eventlocation`, `eventdescription`, `eventstartdate`, `eventenddate`, `cdate` FROM " . $this->Table . " WHERE eventid = ? LIMIT 1;");
        $stmt->bind_param("i", $this->eventid);
        $stmt->execute();
        $stmt->bind_result($this->eventid, $this->eventimage, $this->eventtitle, $this->eventdate, $this->eventtime, $this->eventlocation, $this->eventdescription, $this->eventstartdate, $this->eventenddate, $this->cdate);

        while ($stmt->fetch()) {
            $this->eventid = $this->eventid;
            $this->eventimage = $this->eventimage;
            $this->eventtitle = $this->eventtitle;
            $this->eventdate = $this->eventdate;
            $this->eventtime = $this->eventtime;
            $this->eventlocation = $this->eventlocation;
            $this->eventdescription = $this->eventdescription;
            $this->eventstartdate = $this->eventstartdate;
            $this->eventenddate = $this->eventenddate;
            $this->cdate = $this->cdate;

        }

    }

    /**
     * @return mixed
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * @return mixed
     */
    public function getEventimage()
    {
        return $this->eventimage;
    }

    /**
     * @return mixed
     */
    public function getEventtitle()
    {
        return $this->eventtitle;
    }

    /**
     * @return mixed
     */
    public function getEventdate()
    {
        return $this->eventdate;
    }

    /**
     * @return mixed
     */
    public function getEventtime()
    {
        return $this->eventtime;
    }

    /**
     * @return mixed
     */
    public function getEventlocation()
    {
        return $this->eventlocation;
    }

    /**
     * @return mixed
     */
    public function getEventdescription()
    {
        return $this->eventdescription;
    }

    /**
     * @return mixed
     */
    public function getEventstartdate()
    {
        return $this->eventstartdate;
    }

    /**
     * @return mixed
     */
    public function getEventenddate()
    {
        return $this->eventenddate;
    }

    /**
     * @return mixed
     */
    public function getCdate()
    {
        return $this->cdate;
    }


}