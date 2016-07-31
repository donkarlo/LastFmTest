<?php

namespace Data\Dbs\Tables ;

class Users extends \Sol\Data\Dbs\Table
{

    public function __construct(){
        $this->setName ("users") ;
        $this->setCols (array("id_users" , "email" , "password" , "fname" , "lname" , "is_confirmed" , "confirmation_code")) ;
    }

    public function getUserIdByEmailAndPassword($email , $password){
        $sql = new \Sol\Data\Dbs\SqlFrame() ;
        $sql->SELECT ("id_users")->FROM ($this->getName ())
                ->WHERE ("email=? AND password=?")
        ;
        $user = $sql->fetchRow (array($email , $password)) ;
        return $user["id_users"] ;
    }

    public function userExistsByEmailAndPassword($email , $password){
        $sql = new \Sol\Data\Dbs\SqlFrame() ;
        $sql->SELECT ("id_users")->FROM ($this->getName ())
                ->WHERE ("email=? AND password=?")
        ;
        $user = $sql->fetchRow (array($email , $password)) ;
        if ( ! isEmpty ($user)) {
            return TRUE ;
        }
        return FALSE ;
    }

    public function getUserById($userId = NULL){
        if ( ! is_null ($userId)) {
            $sql = new \Sol\Data\Dbs\SqlFrame() ;
            $sql->SELECT ("id_users,email,password,fname,lname")->FROM ($this->getName ())
                    ->WHERE ("id_users=?")
            ;
            $user = $sql->fetchRow (array($userId)) ;

            $userObj = new \Modules\Auth\Models\User() ;
            $userObj->fillByAssocArray ($user) ;
        }

        return $userObj ;
    }

    public function insertData($data){
        $data["confirmed"] = 0 ;
        $data["confirmation_code"] = $this->generateUniqueSecurityCode () ;
        parent::insertData ($data) ;
    }

    /**
     * This code will generate a hashed code that is unique among it's couterparts
     */
    private function generateUniqueSecurityCode(){
        $confirmationCode = sha1 (rand (0 , 100000000000000)) ;

        $sql = new \Sol\Data\Dbs\SqlFrame() ;
        $foundedUserWithGivenConfCode = $sql->SELECT ("id_users")
                ->FROM ("users")
                ->WHERE ("confirmation_code=?")
                ->fetchAll (array($confirmationCode)) ;
        if ( ! empty ($foundedUserWithGivenConfCode)) {
            $this->generateUniqueSecurityCode () ;
        }
        else {
            return $confirmationCode ;
        }
    }
}