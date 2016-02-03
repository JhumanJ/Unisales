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
    protected $userType;        // 1 is Regular User, 2 is ad manager, 3 is Admin
    protected $userStatus;      // 0 is banned, 1 is waiting for email confirm, 2 is confirmed but tutoriel not done, 3 is ok
    protected $email;
    protected $university;      // uni id
    protected $firstName;
    protected $lastName;
    protected $passWord;
    protected $emailChecker;

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

    public static function returnDataArrayFromData($userType, $userStatus, $email, $university, $firstName, $lastName, $passWord) {
        $arrayData = array(
            'userType' => $userType,
            'userStatus' => $userStatus,
            'email' => $email,
            'university' => $university,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'passWord' => $passWord
        );

        return $arrayData;
    }

    //getters
    public function getEmailChecker() {
        return $this->emailChecker;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUserStatus() {
        return $this->userStatus;
    }

    public function getUniversity() {
        return $this->university;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getPassWord()
    {
        return $this->passWord;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    //Setters

    public function setEmailChecker() {
        $this->emailChecker = md5(uniqid(rand(), true));
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id>0) {
            $this->id = $id;
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

    public function setUniversity($university)
    {
        $this->university = $university;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
    }


}