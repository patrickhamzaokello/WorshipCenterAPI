<?php

class RadioHandler
{
    private $conn;


    public function __construct($con)
    {
        $this->conn = $con;
    }

    function RadioHomeSingle(): array
    {
        // main arrays
        $home_feed = array();

        // get all radios
        $all_radios = array();
        $all_radios_stmt = "SELECT `id`, `title`, `description`, `summary`, `cover`, `path`, `tag`, `dateAdded`, `releaseDate` FROM `radios`";
        $all_radios_result = mysqli_query($this->conn, $all_radios_stmt);
        while ($row = mysqli_fetch_array($all_radios_result)) {
            $temp = array();
            $temp['id'] = $row['id'];
            $temp['title'] = $row['title'];
            $temp['summary'] = $this->getPlainText($row['summary']);
            $temp['description'] = $this->getPlainText($row['description']);
            $temp['cover'] = $row['cover'];
            $temp['path'] = $row['path'];
            $temp['dateAdded'] = $this->formatSqlDate($row['dateAdded']);
            $temp['releaseDate'] = $this->formatSqlDate($row['releaseDate']);
            array_push($all_radios, $temp);
        }
        shuffle($all_radios);
        // select random radios for sliders
        $sliders = array();
        $slider_ids = array_rand($all_radios, 4);
        foreach ($slider_ids as $id) {
            array_push($sliders, $all_radios[$id]);
        }

        $slider_temps = array();
        $slider_temps['Radio'] = $sliders;
        array_push($home_feed, $slider_temps);

        // select all radios for main page
        $radio_main_page = $all_radios;
        // shuffle main page array
        shuffle($radio_main_page);

        $home_sermons_temps = array();
        $home_sermons_temps['heading'] = "Discover Your Favorite Christian Radio Stations";
        $home_sermons_temps['label'] = "Explore our selection of Christian radio stations, featuring a variety of genres and topics to inspire and uplift you. Tune in to your favorites and discover new stations today!";
        $home_sermons_temps['Radio'] = $radio_main_page;
        array_push($home_feed, $home_sermons_temps);

        $itemRecords["page"] = 1;
        $itemRecords["radioPage"] = $home_feed;
        $itemRecords["total_pages"] = 1;
        $itemRecords["total_results"] = count($all_radios);

        return $itemRecords;
    }



    private function getPlainText($text): string
    {
        // Strip any HTML tags from the input text
        $cleanedText = strip_tags($text);
        // Decode any HTML entities in the input text
        $cleanedText = html_entity_decode($cleanedText);
        // Convert any special characters to their plain text equivalents
        return htmlspecialchars_decode($cleanedText);
    }

    function formatSqlDate($date): string
    {
        // Convert the SQL date to a Unix timestamp
        $timestamp = strtotime($date);

        // Get the day of the week in abbreviated form (e.g. "FRI")
        $dayOfWeek = date('D', $timestamp);

        // Get the day of the month with a suffix (e.g. "4th")
        $dayOfMonth = date('jS', $timestamp);

        // Get the month in full form (e.g. "April")
        $month = date('F', $timestamp);

        // Get the year (e.g. "2020")
        $year = date('Y', $timestamp);

        // Combine the formatted date components into a single string
        $formattedDate = $dayOfWeek . ' ' . $dayOfMonth . ' ' . $month . ' ' . $year;

        // Return the formatted date
        return $formattedDate;
    }


}