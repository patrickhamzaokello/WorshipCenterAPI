<?php

    class Radio {

        private $con;

        private $mysqliData;
        private $id;   
        private $title;
        private $description;
        private $summary;
        private $cover;
        private $path;
        private $tag;
        private $dateAdded;
        private $releaseDate;

        public function __construct($con , $id) {
            $this->con = $con;
            $this->id = $id;

            $song_query_sql = "SELECT `id`, `title`, `description`, `summary`, `cover`, `path`, `tag`, `dateAdded`, `releaseDate` FROM `radios` WHERE id = '$this->id'";
            $query = mysqli_query($this->con, $song_query_sql);


            if(mysqli_num_rows($query) == 0){
                $this->id = null;
                $this->title = null;
                $this->description = null;
                $this->summary = null;
                $this->cover = null;
                $this->path = null;
                $this->tag = null;
                $this->dateAdded = null;
                $this->releaseDate = null;
                return false;
            }

            else {
                $this->mysqliData = mysqli_fetch_array($query);
                $this->id = $this->mysqliData['id'];
                $this->title = $this->mysqliData['title'];
                $this->description = $this->mysqliData['description'];
                $this->summary =$this->mysqliData['summary'];
                $this->cover = $this->mysqliData['cover'];
                $this->path = $this->mysqliData['path'];
                $this->tag = $this->mysqliData['tag'];
                $this->dateAdded = $this->mysqliData['dateAdded'];
                $this->releaseDate = $this->mysqliData['releaseDate'];
                return true;
            }
       

        }

        /**
         * @return mixed|null
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return mixed|null
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @return mixed|null
         */
        public function getDescription()
        {
            // Get the raw description text
            $rawDescription = $this->description;
            return getPlainText($rawDescription);
        }

        /**
         * @return mixed|null
         */
        public function getSummary()
        {
            // Get the raw summary text
            $rawDescription = $this->summary;
            return $this->getPlainText($rawDescription);
        }

        /**
         * @return mixed|null
         */
        public function getCover()
        {
            return $this->cover;
        }

        /**
         * @return mixed|null
         */
        public function getPath()
        {
            return $this->path;
        }

        /**
         * @return mixed|null
         */
        public function getTag()
        {
            return $this->tag;
        }

        /**
         * @return mixed|null
         */
        public function getDateAdded()
        {
            // Get the raw SQL date string
            $rawDate = $this->dateAdded;
            return $this->formatSqlDate($rawDate);
        }

        /**
         * @return mixed|null
         */
        public function getReleaseDate()
        {
            // Get the raw SQL date string
            $rawDate = $this->releaseDate;
            return $this->formatSqlDate($rawDate);
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

?>