<?php

namespace Modules\Auth\Models ;

class User
{
    private $userId = NULL ;
    private $fname = NULL ;
    private $lname = NULL ;
    private $email = NULL ;
    private $password = NULL ;

    public function __construct(){
        
    }

    protected function areValuesSet(){
        if ( ! is_null ($this->fname) || ! is_null ($this->userId) || ! is_null ($this->lname) || ! is_null ($this->email) || ! is_null ($this->password)) {
            return TRUE ;
        }
        return FALSE ;
    }

    public function fillByAssocArray($userAssocArray){
        $this->setUserId ($userAssocArray["id_users"]) ;
        $this->setFname ($userAssocArray["fname"]) ;
        $this->setLname ($userAssocArray["lname"]) ;
        $this->setEmail ($userAssocArray["email"]) ;
        $this->setPassword ($userAssocArray["password"]) ;
    }

    public function fillUserByItSelf(self $user){
        $this->setUserId ($user->getUserId ()) ;
        $this->setFname ($user->getFname ()) ;
        $this->setLname ($user->getLname ()) ;
        $this->setEmail ($user->getEmail ()) ;
        $this->setPassword ($user->getPassword ()) ;
    }

    public function getUserId(){
        return $this->userId ;
    }

    protected function setUserId($userId){
        $this->userId = $userId ;
    }

    public function getFname(){
        return $this->fname ;
    }

    protected function setFname($fname){
        $this->fname = $fname ;
    }

    public function getLname(){
        return $this->lname ;
    }

    protected function setLname($lname){
        $this->lname = $lname ;
    }

    public function getPassword(){
        return $this->password ;
    }

    protected function setPassword($password){
        $this->password = $password ;
    }

    public function getEmail(){
        return $this->email ;
    }

    public function setEmail($email){
        $this->email = $email ;
    }
}