<?php
    if (isset($_POST["submit"])) {
        /*echo "It works";*/

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $username = $_POST["uname"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["repwd"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';

   
        /*check whether the inputs are empty*/
        if (emptyInputSignup($fname, $lname, $email, $username, $pwd, $pwdRepeat) !== false) {
            header ("location: ../signup.php?error=emptyinput");
            exit();
        }

        /*check whether the user name is invalid */      
        // if (invalidUid($username) !== false) {
        //     header ("location: ../signup.php?error=invaliduid");
        //     exit();
        // }   

        /*check whether the  e-mail is invalid */
        if (invalidEmail($email) !== false) {
            header ("location: ../signup.php?error=invalidemail");
            exit();
        }
         
        /*check whether the passwords does not match */
        if (pwdMatch($pwd, $pwdRepeat) !== false) {
            header ("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }

        /*check whether the username is exist */
        if (uidExists($conn, $username) !== false) {
            header ("location: ../signup.php?error=usernametaken");
            exit();
        }

        /*check whether the email is exist */
        if (emailExists($conn, $email) !== false) {
            header ("location: ../signup.php?error=emailtaken");
            exit();
        }

        /*no errors occur, then signup the user into the database */
        createUser($conn, $username, $fname, $lname, $pwd, $email);
       
    }

    else {
        header ("location: ../signup.php");
        exit();
    }
 

?>