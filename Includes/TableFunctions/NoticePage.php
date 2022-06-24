<?php

class NoticePage
{

    public $page;
    private $conn;
    private $noticeID;
    private $imagePathRoot = "https://d2t03bblpoql2z.cloudfront.net/";


    public function __construct($con, $page)
    {
        $this->conn = $con;
        $this->page = $page;
    }


    function allNotices()
    {

        $page_no = floatval($this->page);
        $no_of_records_per_page = 10;
        $offset = ($page_no - 1) * $no_of_records_per_page;

        $sql = "SELECT COUNT(DISTINCT(noticeid)) as count FROM notice  ORDER BY `notice`.`created_date` DESC limit 1";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $total_rows = floatval($data['count']);
        $total_pages = ceil($total_rows / $no_of_records_per_page);


        //main arrays
        $sermon_ids = array();
        $sermon_feed = array();

        $home_sermons = array();
        // fetch all major sermons
        $home_sermons_stmt = "SELECT DISTINCT(noticeid) FROM notice  ORDER BY `notice`.`created_date` DESC LIMIT " . $offset . "," . $no_of_records_per_page . "";
        $menu_type_id_result = mysqli_query($this->conn, $home_sermons_stmt);

        while ($row = mysqli_fetch_array($menu_type_id_result)) {

            array_push($sermon_ids, $row['noticeid']);
        }


        foreach ($sermon_ids as $row) {
            $sermon = new Notice($this->conn, intval($row));
            $temp = array();
            $temp['noticeid'] = $sermon->getNoticeid();
            $temp['noticetitle'] = $sermon->getNoticetitle();
            $temp['noticedescription'] = $sermon->getNoticedescription();
            $temp['cdate'] = $sermon->getCdate();
            $temp['created_date'] = $sermon->getCreatedDate();
            array_push($home_sermons, $temp);
        }

        $sermons_page_temps = array();
        $sermons_page_temps['id'] = 1;
        $sermons_page_temps['heading'] = "Live updates";
        $sermons_page_temps['label'] = "Dont miss anything happening happening around church";
        $sermons_page_temps['notice'] = $home_sermons;
        array_push($sermon_feed, $sermons_page_temps);



        $itemRecords["page"] = $page_no;
        $itemRecords["all_notices"] = $sermon_feed;
        $itemRecords["total_pages"] = $total_pages;
        $itemRecords["total_results"] = $total_rows;

        return $itemRecords;


    }
}