<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 20:41
 */
class University
{
    protected $id;
    protected $uniName;
    protected $emailFormat;

    public function __construct($donnes)
    {
        foreach ($donnes as $key => $value){
            $method = 'set'.ucfirst($key);

            if (method_exists($this,$method)) {
                $this->$method($value);
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUniName()
    {
        return $this->uniName;
    }


    public function setUniName($uniName)
    {
        $this->uniName = $uniName;
    }

    public function getEmailFormat()
    {
        return $this->emailFormat;
    }

    public function setEmailFormat($emailFormat)
    {
        $this->emailFormat = $emailFormat;
    }


}