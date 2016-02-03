<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 20:54
 */
class UserManager
{
    protected $db;

    public function __construct($db) {
        $this->setDb($db);
    }

    protected function setDb($db) {
        $this->db=$db;
    }

    protected function create(User $user) {
        $q = $this->db->prepare('INSERT INTO users(userType, userStatus, email, university, firstName, lastName, passWord, emailChecker)
                                  VALUES(:userType, :userStatus, :email, :university, :firstName, :lastName, :passWord, :emailChecker)');
        $q->execute(array(
            'userType' => $user->getUserType(),
            'userStatus' => $user->getUserStatus(),
            'email' => $user->getEmail(),
            'university' => $user->getUniversity(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'passWord' => $user->getPassWord(),
            'emailChecker' => $user->getEmailChecker()
        ));
    }

    protected function update(User $user) {
        $q = $this->db->prepare('UPDATE users SET userType = :userType, userStatus = :userStatus, email = :email, university = :university,firstName =:firstName, lastName = :lastName, passWord = :passWord WHERE id = :id');
        $q->execute(array(
            'userType' => $user->getUserType(),
            'userStatus' => $user->getUserStatus(),
            'email' => $user->getEmail(),
            'university' => $user->getUniversity(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'passWord' => $user->getPassWord(),
            'id' => $user->getId()
        ));
    }

    public function getUnique($id) {
        $q = $this->db->prepare('SELECT id,userType,userStatus,email,university,firstName,lastName,passWord FROM users WHERE id = :id');
        $q->execute(array(
            'id' => $id
        ));

        $donnes = $q->fetch(PDO::FETCH_ASSOC);

        return new User($donnes);
    }

    public function getUniqueFromEmail($email) {
        $q = $this->db->prepare('SELECT id,userType,userStatus,email,university,firstName,lastName,passWord FROM users WHERE email = :email');
        $q->execute(array(
            'email' => $email
        ));

        if ($q->rowCount()!=0) {
            $donnes = $q->fetch(PDO::FETCH_ASSOC);
            return new User($donnes);
        } else {
            return 0;
        }
    }

    public function getUniqueFromConfirmCode($confirmCode) {
        $q = $this->db->prepare('SELECT id,userType,userStatus,email,university,firstName,lastName,passWord, emailChecker FROM users WHERE emailChecker = :emailChecker');
        $q->execute(array(
            'emailChecker' => $confirmCode
        ));

        if ($q->rowCount()!=0) {
            $donnes = $q->fetch(PDO::FETCH_ASSOC);
            return new User($donnes);
        } else {
            return 0;
        }
    }

    public function delete(User $user) {
        $q = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $q->execute(array(
            'id' => $user->getId()
        ));
    }

    public function save(User $user) {
        //Create or Update otherwise
        $q = $this->db->prepare('SELECT id,email,university,firstName,lastName,passWord FROM users WHERE id = :id');
        $q->execute(array(
            'id' => $user->getId()
        ));

        if ($q->rowCount()==0)
        {
            $this->create($user);
        }
        else
        {
            $this->update($user);
        }
    }
}