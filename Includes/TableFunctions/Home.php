<?php

class Home
{
    public $page;
    private $conn;
    private $imagePathRoot = "https://d2t03bblpoql2z.cloudfront.net/";


    public function __construct($con, $page)
    {
        $this->conn = $con;
        $this->page = $page;
    }


    function allCombined()
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
        $home_feed = array();


        if ($page_no == 1) {

//            get sliders begin
            $sliders = array();
            $slidermeta_img_path = array();
            $home_slider_stmt = "SELECT DISTINCT(sliderid) FROM slider  ORDER BY `slider`.`cdate` DESC LIMIT 4 ";
            $slider_id_result = mysqli_query($this->conn, $home_slider_stmt);
            while ($row = mysqli_fetch_array($slider_id_result)) {
                array_push($sliders, $row['sliderid']);
            }
            foreach ($sliders as $row) {
                $slider = new Slider($this->conn, intval($row));
                $temp = array();
                $temp['sliderid'] = $slider->getSliderid();
                $temp['serialid'] = $slider->getSerialid();
                $temp['filename'] = $slider->getFilename();
                $temp['cdate'] = $slider->getCdate();

                array_push($slidermeta_img_path, $temp);
            }
            $slider_temps = array();
            $slider_temps['sliderBanners'] = $slidermeta_img_path;
            array_push($home_feed, $slider_temps);

//            end sliders

//            get dailyhighlights

            $dailyhighlights = array();
            $home_highlights = array();
            $home_highlights_stmt = "SELECT DISTINCT(id) FROM news WHERE status= 1  ORDER BY `news`.`id` DESC LIMIT 5 ";
            $highlights_id_result = mysqli_query($this->conn, $home_highlights_stmt);
            while ($row = mysqli_fetch_array($highlights_id_result)) {
                array_push($dailyhighlights, $row['id']);
            }
            foreach ($dailyhighlights as $row) {
                $news = new News($this->conn, intval($row));
                $temp = array();
                $temp['news_id'] = $news->getId();
                $temp['news_title'] = $news->getTitle();
                $temp['news_description'] = $news->getDescription();
                $temp['verse'] = $news->getVerse();
                $temp['author'] = $news->getAuthor();
                $temp['cdate'] = $news->getCdate();
                $temp['status'] = $news->getStatus();
                array_push($home_highlights, $temp);
            }
            $home_highlights_temps = array();
            $home_highlights_temps['daily_highlights'] = $home_highlights;
            array_push($home_feed, $home_highlights_temps);

            //            end dailyhighlights


//            get events
            $events = array();
            $home_events = array();
            $home_events_stmt = "SELECT DISTINCT(eventid) FROM event  ORDER BY `event`.`eventid` DESC LIMIT 10 ";
            $home_id_result = mysqli_query($this->conn, $home_events_stmt);
            while ($row = mysqli_fetch_array($home_id_result)) {
                array_push($events, $row['eventid']);
            }
            foreach ($events as $row) {
                $event = new Event($this->conn, intval($row));
                $temp = array();
                $temp['eventid'] = $event->getEventid();
                $temp['eventimage'] = $event->getEventimage();
                $temp['eventtitle'] = $event->getEventtitle();
                $temp['eventdate'] = $event->getEventdate();
                $temp['eventtime'] = $event->getEventtime();
                $temp['eventlocation'] = $event->getEventlocation();
                $temp['eventdescription'] = $event->getEventdescription();
                $temp['eventstartdate'] = $event->getEventstartdate();
                $temp['eventenddate'] = $event->getEventenddate();
                $temp['cdate'] = $event->getCdate();
                array_push($home_events, $temp);
            }
            $events_temps = array();
            $events_temps['home_events'] = $home_events;
            array_push($home_feed, $events_temps);

//            end events

        }


        // fetch all major sermons
        $category_stmt = "SELECT DISTINCT(sermonid) FROM sermon  ORDER BY `sermon`.`sermondate` DESC LIMIT " . $offset . "," . $no_of_records_per_page . "";
        $menu_type_id_result = mysqli_query($this->conn, $category_stmt);

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

            array_push($home_feed, $temp);
        }


        $itemRecords["page"] = $page_no;
        $itemRecords["home_feed"] = $home_feed;
        $itemRecords["total_pages"] = $total_pages;
        $itemRecords["total_results"] = $total_rows;

        return $itemRecords;


    }

}