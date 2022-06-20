<?php

class Sermon
{
    private $Table = "sermon";
    private $conn;

    private $sermonid, $sermonbanner, $sermontitle, $sermondate, $sermontime, $sermonlocation, $sermonauthor, $sermonyoutube, $sermonsoundcloud, $sermondescription, $video, $audio, $file, $cdate;

    /**
     * @param $conn
     * @param $sermonid
     */
    public function __construct($conn, $sermonid)
    {
        $this->conn = $conn;
        $this->sermonid = $sermonid;

        $stmt = $this->conn->prepare("SELECT `sermonid`, `sermonbanner`, `sermontitle`, `sermondate`, `sermontime`, `sermonlocation`, `sermonauthor`, `sermonyoutube`, `sermonsoundcloud`, `sermondescription`, `video`, `audio`, `file`, `cdate` FROM " . $this->Table . " WHERE `sermonid` = ? LIMIT 1;");
        $stmt->bind_param("i", $this->sermonid);
        $stmt->execute();
        $stmt->bind_result($this->sermonid, $this->sermonbanner, $this->sermontitle, $this->sermondate, $this->sermontime, $this->sermonlocation, $this->sermonauthor, $this->sermonyoutube, $this->sermonsoundcloud, $this->sermondescription, $this->video, $this->audio, $this->file, $this->cdate);

        while ($stmt->fetch()) {
            $sermonid = $sermonid;
            $this->sermonbanner = $this->sermonbanner;
            $this->sermontitle = $this->sermontitle;
            $this->sermondate = $this->sermondate;
            $this->sermontime = $this->sermontime;
            $this->sermonlocation = $this->sermonlocation;
            $this->sermonauthor = $this->sermonauthor;
            $this->sermonyoutube = $this->sermonyoutube;
            $this->sermonsoundcloud = $this->sermonsoundcloud;
            $this->sermondescription = $this->sermondescription;
            $this->video = $this->video;
            $this->audio = $this->audio;
            $this->file = $this->file;
            $this->cdate = $this->cdate;
        }


    }

    /**
     * @return mixed
     */
    public function getSermonid()
    {
        return $this->sermonid;
    }

    /**
     * @return mixed
     */
    public function getSermonbanner()
    {
        return $this->sermonbanner;
    }

    /**
     * @return mixed
     */
    public function getSermontitle()
    {
        return $this->sermontitle;
    }

    /**
     * @return mixed
     */
    public function getSermondate()
    {
        return $this->sermondate;
    }

    /**
     * @return mixed
     */
    public function getSermontime()
    {
        return $this->sermontime;
    }

    /**
     * @return mixed
     */
    public function getSermonlocation()
    {
        return $this->sermonlocation;
    }

    /**
     * @return mixed
     */
    public function getSermonauthor()
    {
        return $this->sermonauthor;
    }

    /**
     * @return mixed
     */
    public function getSermonyoutube()
    {
        return $this->sermonyoutube;
    }

    /**
     * @return mixed
     */
    public function getSermonsoundcloud()
    {
        return $this->sermonsoundcloud;
    }

    /**
     * @return mixed
     */
    public function getSermondescription()
    {
        return $this->sermondescription;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return mixed
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getCdate()
    {
        return $this->cdate;
    }


}