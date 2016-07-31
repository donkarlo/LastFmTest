<?php

class Signup
{

    /**
     * To handle insert and Update requests
     */
    public function Modify($args = NULL){

        function getIdUsers($args){
            if (isset ($args[0])) {
                $idUsers = intval ($args[0]) ;
            }
            else {
                $idUsers = NULL ;
            }
            return $idUsers ;
        }

        function layoutSignupForm($data = NULL , $errors = NULL){
            $layoutView = new \Sol\Mvc\Views\LayoutView() ;
            $layoutView->addTplPath (SITE_PATH . "Modules/Auth/Views/Signup.tpl") ;
            $layoutView->addVar ("data" , $data) ;
            $layoutView->addVar ("errors" , $errors) ;

            $layout = new \Sol\Mvc\Views\SimpleLayout() ;
            $layout->addView ($layoutView) ;
            $layout->render () ;
        }

        function getData($key = NULL , $idUsers = NULL , $errors = NULL){
            if ( ! empty ($errors)) {
                $data = $_REQUEST ;
            }
            elseif (empty ($errors) && ! empty ($idUsers)) {
                //@todo get the row from users matching $idUsers
                $usersTbl = new \Data\Dbs\Tables\Users() ;
                $data = $usersTbl->fetchRowByColVal ("id_users" , $idUsers) ;
            }
            else {
                $data = $_REQUEST ;
            }
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
            layoutSignupForm (getData (getIdUsers ($args))) ;
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
            //err2: email must be unique
            $usersTbl = new \Data\Dbs\Tables\Users() ;
            if ( ! isEmpty ($usersTbl->fetchRowByColVal ("email" , getData ("email")))) {
                $errors["email"]["alreadyRegistered"] = "Sorry someone has already registered with this email address" ;
            }
            //err3: fname cant be empty
            if (isEmpty (getData ("fname"))) {
                $errors["fname"]["empty"] = "First name cant be empty." ;
            }
            //lname cant be empty
            if (isEmpty (getData ("lname"))) {
                $errors["lname"]["empty"] = "Last name cant be empty." ;
            }
            if (isEmpty (getData ("password"))) {
                $errors["password"]["empty"] = "password cant be empty" ;
            }
            if (isEmpty (getData ("rPassword"))) {
                $errors["rPassword"]["empty"] = "repeated password cant be empty" ;
            }
            //rpassword cant be unequal password
            if (getData ("rPassword") != getData ("password")) {
                $errors["rPassword"]["mismatch"] = "your passwords do not match" ;
            }
            //if there are no errors, add to db table users
            if ( ! isEmpty ($errors)) {
                layoutSignupForm (getData () , $errors) ;
            }
            //When there is no error , do this
            else {
                
                if (isEmpty (getIdUsers ())) {
                    $insertingData = getData () ;
                    $insertingData["password"] = sha1($insertingData["password"]);
                    //insert
                    $usersTbl->insertData ($insertingData) ;
                }
                else {//update
                    $usersTbl->updateDataByPkVal (getData () , isEmpty (getIdUsers ())) ;
                }
                //Redirect to home page
                $http = new \Sol\Protocols\Http\Http() ;
                $http->redirect (URL . "Core/Index/Index") ;
            }
        }
    }

    public function Delete($args){
        
    }
}