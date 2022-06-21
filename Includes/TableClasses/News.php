<?php

class News
{
    private $Table = "news";
    private $conn;
    private $id, $title, $description, $verse, $author, $cdate, $status;

    /**
     * @param $conn
     * @param $id
     */
    public function __construct($conn, $id)
    {
        $this->conn = $conn;
        $this->id = $id;


        $stmt = $this->conn->prepare("SELECT  `id`, `title`, `description`, `verse`, `author`, `cdate`, `status` FROM " . $this->Table . " WHERE `id` = ? LIMIT 1;");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->bind_result($this->id, $this->title, $this->description, $this->verse, $this->author, $this->cdate, $this->status);
        while ($stmt->fetch()) {
            $this->id = $this->id;
            $this->title = $this->title;
            $this->description = $this->description;
            $this->verse = $this->verse;
            $this->author = $this->author;
            $this->cdate = $this->cdate;
            $this->status = $this->status;
        }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getVerse()
    {
        return $this->verse;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
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
    public function getStatus()
    {
        return $this->status;
    }


}