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
        $q = $this->db->prepare('INSERT INTO users(userType, userName, imgURL, homePageURL, profileColour, description, passWord)
                                  VALUES(:userType, :userName, :imgURL, :homePageURL, :profileColour, :description, :passWord)');
        $q->execute(array(
            'userType' => $user->getUserType(),
            'userName' => $user->getUserName(),
            'imgURL' => $user->getImgURL(),
            'homePageURL' => $user->getHomePageURL(),
            'profileColour' => $user->getProfileColour(),
            'description' => $user->getDescription(),
            'passWord' => $user->getPassWord(),
        ));
    }

    protected function update(User $user) {
        $q = $this->db->prepare('UPDATE users SET userType = :userType, userName = :userName, imgURL = :imgURL, homePageURL = :homePageURL,profileColour =:profileColour, description = :description, passWord = :passWord WHERE id = :id');
        $q->execute(array(
            'userType' => $user->getUserType(),
            'userName' => $user->getUserName(),
            'imgURL' => $user->getImgURL(),
            'homePageURL' => $user->getHomePageURL(),
            'profileColour' => $user->getProfileColour(),
            'description' => $user->getDescription(),
            'passWord' => $user->getPassWord(),
            'id' => $user->getId()
        ));
    }

    public function getUnique($id) {
        $q = $this->db->prepare('SELECT id,userType, userName, imgURL, homePageURL, profileColour, description, passWord FROM users WHERE id = :id');
        $q->execute(array(
            'id' => $id
        ));

        $donnes = $q->fetch(PDO::FETCH_ASSOC);

        return new User($donnes);
    }

    public function getUniqueUserName($userName) {
        $q = $this->db->prepare('SELECT id,userType, userName, imgURL, homePageURL, profileColour, description, passWord FROM users WHERE userName = :userName');
        $q->execute(array(
            'userName' => $userName
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
        $q = $this->db->prepare('SELECT id,userType, userName, imgURL, homePageURL, profileColour, description, passWord FROM users WHERE id = :id');
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