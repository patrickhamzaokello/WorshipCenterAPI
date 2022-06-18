<?php

class User
{
    private $Table = "users";
    private $userid, $userstatus, $username, $profileimage,$fname, $lname, $phone, $email, $password, $mediaIdentifier, $position, $bpdate,
        $blood, $dob, $nationality, $about, $address, $city, $country, $postal, $terms_and_condition,
        $cdate, $facebook, $twitter, $googleplus, $linkedin, $youtube, $pinterest,$instagram, $whatsapp;

    private $conn;


    public function __construct($conn, $userid)
    {
        $this->conn = $conn;
        $this->userid = $userid;

        $stmt = $this->conn->prepare("SELECT  `userid`, `userstatus`, `username`, `profileimage`, `fname`, `lname`, `phone`, `email`, `password`, `mediaIdentifier`, `position`, `bpdate`, `blood`, `dob`, `nationality`, `about`, `address`, `city`, `country`, `postal`, `terms_and_condition`, `cdate`, `facebook`, `twitter`, `googleplus`, `linkedin`, `youtube`, `pinterest`, `instagram`, `whatsapp` FROM " . $this->Table . " WHERE userid = ? LIMIT 1;");
        $stmt->bind_param("i", $this->userid);
        $stmt->execute();
        $stmt->bind_result($userid, $this->userstatus, $this->username, $this->profileimage, $this->fname, $this->lname, $this->phone, $this->email, $this->password, $this->mediaIdentifier, $this->position, $this->bpdate, $this->blood, $this->dob, $this->nationality, $this->about, $this->address, $this->city, $this->country, $this->postal, $this->terms_and_condition, $this->cdate, $this->facebook, $this->twitter, $this->googleplus, $this->linkedin, $this->youtube, $this->pinterest, $this->instagram, $this->whatsapp);

        while ($stmt->fetch()) {
            $this->userid = $this->userid;
            $this->userstatus = $this->userstatus;
            $this->username =  $this->username;
            $this->profileimage =  $this->profileimage;
            $this->fname =  $this->fname;
            $this->lname = $this->lname;
            $this->phone = $this->phone;
            $this->email= $this->email;
            $this->password = $this->password;
            $this->mediaIdentifier = $this->mediaIdentifier;
            $this->position = $this->position;
            $this->bpdate = $this->bpdate;
            $this->blood = $this->blood;
            $this->dob = $this->dob;
            $this->nationality = $this->nationality;
            $this->about = $this->about;
            $this->address = $this->address;
            $this->city = $this->city;
            $this->country = $this->country;
            $this->postal = $this->postal;
            $this->terms_and_condition = $this->terms_and_condition;
            $this->cdate = $this->cdate;
            $this->facebook = $this->facebook;
            $this->twitter = $this->twitter;
            $this->googleplus = $this->googleplus;
            $this->linkedin = $this->linkedin;
            $this->youtube = $this->youtube;
            $this->pinterest = $this->pinterest;
            $this->instagram = $this->instagram;
            $this->whatsapp = $this->whatsapp;
        }
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @return mixed
     */
    public function getUserstatus()
    {
        return $this->userstatus;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getProfileimage()
    {
        return $this->profileimage;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getMediaIdentifier()
    {
        return $this->mediaIdentifier;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getBpdate()
    {
        return $this->bpdate;
    }

    /**
     * @return mixed
     */
    public function getBlood()
    {
        return $this->blood;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * @return mixed
     */
    public function getTermsAndCondition()
    {
        return $this->terms_and_condition;
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
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @return mixed
     */
    public function getGoogleplus()
    {
        return $this->googleplus;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @return mixed
     */
    public function getPinterest()
    {
        return $this->pinterest;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @return mixed
     */
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }







}