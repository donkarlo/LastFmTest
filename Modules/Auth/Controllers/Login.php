<?php

class Login
{

    public function __construct(){
        ;
    }

    public function Login(){

        function layoutSignupForm($data = NULL , $errors = NULL){
            $layoutView = new \Sol\Mvc\Views\LayoutView() ;
            $layoutView->addTplPath (SITE_PATH . "Modules/Auth/Views/Login.tpl") ;
            $layoutView->addVar ("data" , $data) ;
            $layoutView->addVar ("errors" , $errors) ;

            $layout = new \Sol\Mvc\Views\SimpleLayout() ;
            $layout->addView ($layoutView) ;
            $layout->render () ;
        }

        function getData($key = NULL , $idUsers = NULL , $errors = NULL){
            $data = $_REQUEST ;
            if (is_null ($key)) {
                if (isset ($data)) {
                    return $data ;
                }
            }
            else {
                if (isset ($data[$key])) {
                    return $data[$key] ;
                }
            }
        }
        //We are not submitting. We are show the form
        if (empty (getData ("submit"))) {
            layoutSignupForm (getData ()) ;
        }//If we are submitting
        else {
            //submit proccess
            //validate form
            //err1: email cant be empty\
            $errors = array() ;
            if (isEmpty (getData ("email"))) {
                $errors["email"]["empty"] = "The username cant be empty" ;
            }
            //err1: email must be a valid email - a valid email contains an "@" and a "." after @.
            if ( ! filter_var (getData ("email") , FILTER_VALIDATE_EMAIL)) {
                $errors["email"]["notValid"] = "Please enter a valid email." ;
            }
            if (isEmpty (getData ("password"))) {
                $errors["password"]["empty"] = "password cant be empty" ;
            }
            $userTbl = new \Data\Dbs\Tables\Users() ;
            if ( ! $userTbl->userExistsByEmailAndPassword (getData ("email") , sha1 (getData ("password")))) {
                $errors["wrong"] = "The user name and the password do not match" ;
            }

            //if there are no errors, add to db table users
            if ( ! isEmpty ($errors)) {
                layoutSignupForm (getData () , $errors) ;
            }
            //If there is no error lets set the userid in a session
            else {
                $userTbl = new \Data\Dbs\Tables\Users() ;
                session_regenerate_id () ;
                $_SESSION["id_users"] = $userTbl->getUserIdByEmailAndPassword (getData ("email")
                        , sha1 (getData ("password"))) ;
                setcookie ('id_users' , $_SESSION["id_users"] , time () + 60 * 60 * 24 * 30 , '/' , DOMAIN) ;
//                echo "You are successfuly logged in" ;
                $http = new \Sol\Protocols\Http\Http() ;
                $http->redirect (URL . "Core/Index/Index") ;
            }
        }
    }
}