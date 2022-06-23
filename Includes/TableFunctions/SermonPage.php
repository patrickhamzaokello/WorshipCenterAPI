<?php

class SermonPage
{
    public $page;
    private $conn;
    private $sermonID;
    private $imagePathRoot = "https://d2t03bblpoql2z.cloudfront.net/";


    public function __construct($con, $page)
    {
        $this->conn = $con;
        $this->page = $page;
    }


    function selectedSermon(){
        $itemRecords = array();
        $page_no = floatval($this->page);
        $this->sermonID = htmlspecialchars(strip_tags($_GET["sermonID"]));

        $no_of_records_per_page = 1;
        $offset = ($page_no - 1) * $no_of_records_per_page;

        $sql = "SELECT COUNT(DISTINCT(sermonid)) as count FROM sermon WHERE sermonid != ".$this->sermonID."  ORDER BY `sermon`.`sermonid` DESC limit 1";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $total_rows = floatval($data['count']);
        $total_pages = ceil($total_rows / $no_of_records_per_page);


        $itemRecords["page"] = $page_no;
        $itemRecords["SelectedSermon"] = array();
        $itemRecords["total_pages"] = $total_pages;
        $itemRecords["total_results"] = $total_rows;

        if($page_no == 1){
            $menu_type_data = new Sermon($this->conn, $this->sermonID);

            $sel_category = array();

            if ($menu_type_data) {
                $temp = array();
                $temp['sermonid'] = $menu_type_data->getSermonid();
                $temp['sermonbanner'] = $menu_type_data->getSermonbanner();
                $temp['sermontitle'] = $menu_type_data->getSermontitle();
                $temp['sermondate'] = $menu_type_data->getSermondate();
                $temp['sermontime'] = $menu_type_data->getSermontime();
                $temp['sermonlocation'] = $menu_type_data->getSermonlocation();
                $temp['sermonauthor'] = $menu_type_data->getSermonauthor();
                $temp['sermonyoutube'] = $menu_type_data->getSermonyoutube();
                $temp['sermonsoundcloud'] =$menu_type_data->getSermonsoundcloud();
                $temp['sermondescription'] = $menu_type_data->getSermondescription();
                $temp['video'] = $menu_type_data->getVideo();
                $temp['audio'] = $menu_type_data->getAudio();
                $temp['file'] = $menu_type_data->getFile();
                $temp['cdate'] = $menu_type_data->getCdate();

                array_push($itemRecords["SelectedSermon"], $temp);

            }


        }


        //main arrays
        $sermon_ids = array();
        $sermon_feed = array();

        $home_sermons = array();
        // fetch all major sermons
        $home_sermons_stmt = "SELECT DISTINCT(sermonid) FROM sermon WHERE sermonid != ".$this->sermonID."   ORDER BY `sermon`.`sermondate` DESC LIMIT " . $offset . "," . $no_of_records_per_page . "";
        $menu_type_id_result = mysqli_query($this->conn, $home_sermons_stmt);

        while ($row = mysqli_fetch_array($menu_type_id_result)) {

            array_push($sermon_ids, $row['sermonid']);
        }


        foreach ($sermon_ids as $row) {
            $sermon = new Sermon($this->conn, intval($row));
            $temp = array();
            $temp['sermonid'] = $sermon->getSermonid();
            $temp['sermonbanner'] = $sermon->getSermonbanner();
            $temp['sermontitle'] = $sermon->getSermontitle();
            $temp['sermondate'] = $sermon->getSermondate();
            $temp['sermontime'] = $sermon->getSermontime();
            $temp['sermonlocation'] = $sermon->getSermonlocation();
            $temp['sermonauthor'] = $sermon->getSermonauthor();
            $temp['sermonyoutube'] = $sermon->getSermonyoutube();
            $temp['sermonsoundcloud'] = $sermon->getSermonsoundcloud();
            $temp['sermondescription'] = $sermon->getSermondescription();
            $temp['video'] = $sermon->getVideo();
            $temp['audio'] = $sermon->getAudio();
            $temp['file'] = $sermon->getFile();
            $temp['cdate'] = $sermon->getCdate();

            array_push($home_sermons, $temp);
        }

        $sermons_page_temps = array();
        $sermons_page_temps['id'] = 1;
        $sermons_page_temps['heading'] = "Similar Sermons";
        $sermons_page_temps['label'] = "Similar Sermons";
        $sermons_page_temps['home_sermons'] = $home_sermons;
        array_push($sermon_feed, $sermons_page_temps);



        $otherSermon = array();
        $otherSermon['OtherSermons'] = $sermon_feed;
        array_push($itemRecords["SelectedSermon"], $otherSermon);
        return $itemRecords;
    }



    function allSermons()
    {

        $page_no = floatval($this->page);
        $no_of_records_per_page = 10;
        $offset = ($page_no - 1) * $no_of_records_per_page;

        $sql = "SELECT COUNT(DISTINCT(sermonid)) as count FROM sermon  ORDER BY `sermon`.`sermonid` DESC limit 1";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $total_rows = floatval($data['count']);
        $total_pages = ceil($total_rows / $no_of_records_per_page);


        //main arrays
        $sermon_ids = array();
        $sermon_feed = array();

        $home_sermons = array();
        // fetch all major sermons
        $home_sermons_stmt = "SELECT DISTINCT(sermonid) FROM sermon  ORDER BY `sermon`.`sermondate` DESC LIMIT " . $offset . "," . $no_of_records_per_page . "";
        $menu_type_id_result = mysqli_query($this->conn, $home_sermons_stmt);

        while ($row = mysqli_fetch_array($menu_type_id_result)) {

            array_push($sermon_ids, $row['sermonid']);
        }


        foreach ($sermon_ids as $row) {
            $sermon = new Sermon($this->conn, intval($row));
            $temp = array();
            $temp['sermonid'] = $sermon->getSermonid();
            $temp['sermonbanner'] = $sermon->getSermonbanner();
            $temp['sermontitle'] = $sermon->getSermontitle();
            $temp['sermondate'] = $sermon->getSermondate();
            $temp['sermontime'] = $sermon->getSermontime();
            $temp['sermonlocation'] = $sermon->getSermonlocation();
            $temp['sermonauthor'] = $sermon->getSermonauthor();
            $temp['sermonyoutube'] = $sermon->getSermonyoutube();
            $temp['sermonsoundcloud'] = $sermon->getSermonsoundcloud();
            $temp['sermondescription'] = $sermon->getSermondescription();
            $temp['video'] = $sermon->getVideo();
            $temp['audio'] = $sermon->getAudio();
            $temp['file'] = $sermon->getFile();
            $temp['cdate'] = $sermon->getCdate();

            array_push($home_sermons, $temp);
        }

        $sermons_page_temps = array();
        $sermons_page_temps['id'] = 1;
        $sermons_page_temps['heading'] = "Sermons";
        $sermons_page_temps['label'] = "Access all sermons preached.";
        $sermons_page_temps['home_sermons'] = $home_sermons;
        array_push($sermon_feed, $sermons_page_temps);



        $itemRecords["page"] = $page_no;
        $itemRecords["all_sermons"] = $sermon_feed;
        $itemRecords["total_pages"] = $total_pages;
        $itemRecords["total_results"] = $total_rows;

        return $itemRecords;


    }

}