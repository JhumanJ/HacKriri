<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 19:25
 */
class User
{
    protected $id;
    protected $userType;        // 1 is Regular User, 100 is Admin
    protected $userName; //max is 50 char
    protected $passWord;
    protected $imgURL;
    protected $homePageURL;
    protected $profileColour;
    protected $description;

    /**
     * user constructor.
     */

    public function __construct($donnes)
    {
        foreach ($donnes as $key => $value){
            $method = 'set'.ucfirst($key);

            if (method_exists($this,$method)) {
                $this->$method($value);
            }
        }
    }

    public static function returnDataArrayFromData($userType, $userName, $passWord) {
        $arrayData = array(
            'userType' => $userType,
            'userName' => $userName,
            'passWord' => $passWord,
        );

        return $arrayData;
    }

//    Getter Setters

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * @param mixed $passWord
     */
    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
    }

    /**
     * @return mixed
     */
    public function getImgURL()
    {
        return $this->imgURL;
    }

    /**
     * @param mixed $imgURL
     */
    public function setImgURL($imgURL)
    {
        $this->imgURL = $imgURL;
    }

    /**
     * @return mixed
     */
    public function getHomePageURL()
    {
        return $this->homePageURL;
    }

    /**
     * @param mixed $homePageURL
     */
    public function setHomePageURL($homePageURL)
    {
        $this->homePageURL = $homePageURL;
    }

    /**
     * @return mixed
     */
    public function getProfileColour()
    {
        return $this->profileColour;
    }

    /**
     * @param mixed $profileColour
     */
    public function setProfileColour($profileColour)
    {
        $this->profileColour = $profileColour;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }




}