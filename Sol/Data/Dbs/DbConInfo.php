<?php

namespace Sol\Data\Dbs ;

/**
 * 
 */
class DbConInfo
{
    private $server ;
    private $name ;
    private $username ;
    private $password ;

    public function __construct($server , $name , $username , $password){
        $this->setServer ($server) ;
        $this->setName ($name) ;
        $this->setUsername ($username) ;
        $this->setPassword ($password) ;
    }

    public function getServer(){
        return $this->server ;
    }

    public function getName(){
        return $this->name ;
    }

    public function getUsername(){
        return $this->username ;
    }

    public function getPassword(){
        return $this->password ;
    }

    private function setServer($server){
        $this->server = $server ;
    }

    private function setName($name){
        $this->name = $name ;
    }

    private function setUsername($username){
        $this->username = $username ;
    }

    private function setPassword($password){
        $this->password = $password ;
    }
}