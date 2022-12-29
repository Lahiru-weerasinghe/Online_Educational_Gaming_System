<?php

/*signup functions*/
function emptyInputSignup($fname, $lname, $email, $username, $pwd, $pwdRepeat) {
    $result;

    /*check the empty input fields */
    if (empty($fname) || empty($lname) || empty($email) || empty($username) ||empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } 
    else {
        $result = false;
    }
}

function invalidEmail($email) {
    $result;
    /*check the email */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result;
    /*check the passwords are match */
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


/*check whether the username or email already exists in the database */
function uidExists($conn, $username) {
    $sql = "SELECT * FROM Member WHERE username = ?;";
    /*initialize new prepare statement */
    $stmt = mysqli_stmt_init($conn);
    /*check whether any mistake happens in prepare statement */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }

    /*if no errors, then pass the data from the user */
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; /*return all the data from the databse if the user exists inside the database */
    }
    else {
        $result = false;
        return $result;
    }
    /*close the prepare statement */
    mysqli_stmt_close($stmt);
}
function aidExists($conn, $username) {
    $sql = "SELECT * FROM Admin WHERE username = ?;";
    /*initialize new prepare statement */
    $stmt = mysqli_stmt_init($conn);
    /*check whether any mistake happens in prepare statement */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../admin-login.php?error=stmtfailed");
        exit();
    }

    /*if no errors, then pass the data from the user */
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; /*return all the data from the databse if the user exists inside the database */
    }
    else {
        $result = false;
        return $result;
    }
    /*close the prepare statement */
    mysqli_stmt_close($stmt);
}


function emailExists($conn, $email) {
    $sql = "SELECT * FROM Member_email WHERE email = ?;";
    /*initialize new prepare statement */
    $stmt = mysqli_stmt_init($conn);
    /*check whether any mistake happens in prepare statement */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }

    /*if no errors, then pass the data from the user */
    mysqli_stmt_bind_param($stmt, "s",  $email);  
    mysqli_stmt_execute($stmt); 
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;     /*return all the data from the databse if the user exists inside the database */
    }
    else {
        $result = false;
        return $result;
    }
    /*close the prepare statement */
    mysqli_stmt_close($stmt);
}


function createUser($conn, $username, $fname, $lname, $pwd , $email) {
    /*insert data into the datbase */
    $sql = "INSERT INTO Member (username, firstName, lastName, m_password, TID) VALUES (?, ?, ?, ?, 2);";
    $stmt = mysqli_stmt_init($conn);
    /*check whether any mistake happens in prepare statement */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    /*if no errors, then pass the data from the user */
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $fname, $lname, $hashedPwd);   
    mysqli_stmt_execute($stmt);        //execute the statement
    mysqli_stmt_close($stmt);         //close the statement

    //Insert email to the email table
    $sql = "INSERT INTO Member_email (memberID, email, emailType) VALUES (LAST_INSERT_ID(), ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }
    $eType = 'Primary';
    mysqli_stmt_bind_param($stmt, "ss", $email, $eType);
    mysqli_stmt_execute($stmt);        //execute the statement
    mysqli_stmt_close($stmt);         //close the statement

    //Inser data to the membership table
    $sql = "INSERT INTO Membership (memberID, m_plan, m_status, start_date) VALUES (LAST_INSERT_ID(), '', '', ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }
    $sDate = date("Y-m-d");
    mysqli_stmt_bind_param($stmt, "s", $sDate);
    mysqli_stmt_execute($stmt);        //execute the statement
    mysqli_stmt_close($stmt);         //close the statement

    header ("location: ../login.php?successfully signed up!");
    exit();
    
}


/*login functions*/

function emptyInputLogin($username, $pwd) {
    $result;
    /*check whether inputs are empty */
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


function  loginUser($conn, $username, $pwd) {
    $uidExists = uidExists( $conn, $username);

    /*check whether the email is already exists */
    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
            exit();
    }
    $pwdHashed = $uidExists["m_password"];            //read the encrypted password
    $checkPwd = password_verify($pwd, $pwdHashed);   //verify the password in the databse
    /*check whether the encrypted password and entered password are different */
    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
            exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["memberID"] = $uidExists["memberID"];
        $_SESSION["username"] = $uidExists["username"];
        $_SESSION["firstName"] = $uidExists["firstName"];
        $_SESSION["lastName"] = $uidExists["lastName"];
        $_SESSION["TID"] = $uidExists["TID"];
        $_SESSION["proPic"] = $uidExists["profile_pic"];
        $_SESSION["role"] = 'Member';
        header("location: ../index.php");
        exit();
    }        
}

function  loginAdmin($conn, $username, $pwd) {
    $aidExists = aidExists( $conn, $username);

    /*check whether the email is already exists */
    if ($aidExists === false) {
        header("location: ../admin-login.php?error=wronglogin");
            exit();
    }
    $pwdHashed = $aidExists["a_password"];            //read the encrypted password
    $checkPwd = password_verify($pwd, $pwdHashed);   //verify the password in the databse
    /*check whether the encrypted password and entered password are different */
    if ($checkPwd === false) {
        header("location: ../admin-login.php?error=wronglogin");
            exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["adminID"] = $aidExists["adminID"];
        $_SESSION["username"] = $aidExists["username"];
        $_SESSION["firstName"] = $aidExists["firstName"];
        $_SESSION["lastName"] = $aidExists["lastName"];
        $_SESSION["proPic"] = $aidExists["profile_pic"];
        $_SESSION["role"] = 'Admin';
        header("location: ../admin-db.php");
        exit();
    }        
}

?>