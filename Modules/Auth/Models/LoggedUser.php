<?php

namespace Modules\Auth\Models ;

class LoggedUser extends \Modules\Auth\Models\User
{

    public function getUser(){
        if ( ! $this->areValuesSet ()) {
            if (isset ($_SESSION["id_users"])) {
                $userId = $_SESSION["id_users"] ;
            }
            elseif (isset ($_COOKIE["id_users"])) {
                $userId = $_COOKIE["id_users"] ;
            }
            if (isset ($userId)) {
                $usersTbl = new \Data\Dbs\Tables\Users() ;
                $user = $usersTbl->getUserById ($userId) ;
                $this->fillUserByItSelf ($user) ;
            }
        }
        return $this ;
    }
}