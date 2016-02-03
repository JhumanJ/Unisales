<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 20:56
 */
class UniversityManager
{
    protected $db;

    public function __construct($db) {
        $this->setDb($db);
    }

    protected function setDb($db) {
        $this->db=$db;
    }

    public function create(University $university) {
        $q = $this->db->prepare('INSERT INTO universities(uniName, emailFormat)
                                  VALUES(:uniName, :emailFormat)');
        $q->execute(array(
            'uniName' => $university->getUniName(),
            'emailFormat' => $university->getEmailFormat()
        ));
    }

    public function update(University $university) {
        $q = $this->db->prepare('UPDATE universities SET uniName = :uniName, userStatus = :emailFormat WHERE id = :id');
        $q->execute(array(
            'uniName' => $university->getUniName(),
            'emailFormat' => $university->getEmailFormat(),
            'id' => $university->getId()
        ));
    }

    public function getUniqueFromUniName($uniName) {
        $q = $this->db->prepare('SELECT id, uniName, emailFormat FROM universities WHERE uniName = :uniName');
        $q->execute(array(
            'uniName' => $uniName
        ));

        if ($q->rowCount()!=0) {
            $donnes = $q->fetch(PDO::FETCH_ASSOC);
            return new University($donnes);
        } else {
            return 0;
        }
    }

    public function getUnique($id) {
        $q = $this->db->prepare('SELECT id, uniName, emailFormat FROM universities WHERE id = :id');
        $q->execute(array(
            'id' => $id
        ));

        if ($q->rowCount()!=0) {
            $donnes = $q->fetch(PDO::FETCH_ASSOC);
            return new University($donnes);
        } else {
            return 0;
        }
    }

    public function delete(University $university) {
        $q = $this->db->prepare('DELETE FROM universities WHERE id = :id');
        $q->execute(array(
            'id' => $university->getId()
        ));
    }
}