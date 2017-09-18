<?php 
require_once("connect.php");

ob_start();
session_start();

// Login
function _loggedin(){
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        
        return true;
        
    } else {
        return false;
    }

}


// Unique ID Generation Starts
function _invoiceid(){
$timestampz=time();
function generateRandomString($length = 3) {
    $characters = '012345';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$tokenparta = generateRandomString();
$token = $timestampz*3 . rand(6,9);
return $token;
}


// GET USER INFORMATION
function _getuserinfo($userid){
    global $link;
    $query = "SELECT * FROM users_tbl WHERE id = '$userid' " ;
    $query_run = mysqli_query($link, $query);
    $usersarray = array();
    if ($query_run) {
        while ( $usersrow = mysqli_fetch_assoc($query_run)) {
            # code...
            $usersarray[] = $usersrow;
        }
    }
        return $usersarray;    
}


function _getuserfield($field){
    global $link;
    $query = "SELECT $field FROM users_tbl WHERE id = ' ".$_SESSION['user_id']."'" ;
    if($query_run = mysqli_query($link, $query)){
    $useridrow = mysqli_fetch_assoc($query_run);
    if($userid = $useridrow[$field]){
        return $userid;
        }
    }
}

function _getuserfieldbyid($field,$userid){
    global $link;
    $query = "SELECT $field FROM users_tbl WHERE id = '".$userid."' " ;
    if($query_run = mysqli_query($link, $query)){
    $uidrow = mysqli_fetch_assoc($query_run);
    if($uid = $uidrow[$field]){
        return $uid;
        }
    }
}

function _getbudgetfield($field, $budgetid){
    global $link;
    $query = "SELECT $field FROM budget_tbl WHERE id = '$budgetid'" ;
    if($query_run = mysqli_query($link, $query)){
    $brow = mysqli_fetch_assoc($query_run);
    if($bid = $brow[$field]){
        return $bid;
        }
    }
}

// GET ALL USERS
function _getallusers(){
    global $link;
    $query = "SELECT * FROM users_tbl WHERE auth_level = 2" ;
    $query_run = mysqli_query($link, $query);
    $usersarray = array();
    if ($query_run) {
        while ( $usersrow = mysqli_fetch_assoc($query_run)) {
            # code...
            $usersarray[] = $usersrow;
        }
    }
        return $usersarray;    
}
// GET ALL USERS
function _getmytransactions($userid1){
    global $link;
    $query = "SELECT * FROM budget_tbl WHERE userid = '$userid1' ORDER BY dated DESC " ;
    $query_run = mysqli_query($link, $query);
    $barray = array();
    if ($query_run) {
        while ( $brow = mysqli_fetch_assoc($query_run)) {
            # code...
            $barray[] = $brow;
        }
    }
        return $barray;    
}

function _getmytrannumrows($userid1){
    global $link;
    $query = "SELECT * FROM budget_tbl WHERE userid = '$userid1' " ;
    $query_run = mysqli_query($link, $query);
    $numrows = mysqli_num_rows($query_run);
    return $numrows;
}

// GET ALL USERS
function _getalltransactions(){
    global $link;
    $query = "SELECT * FROM budget_tbl " ;
    $query_run = mysqli_query($link, $query);
    $barray = array();
    if ($query_run) {
        while ( $brow = mysqli_fetch_assoc($query_run)) {
            # code...
            $barray[] = $brow;
        }
    }
        return $barray;    
}
// GET ALL USERS
function _getalltranlimited(){
    global $link;
    $query = "SELECT * FROM budget_tbl ORDER BY dated DESC LIMIT 4" ;
    $query_run = mysqli_query($link, $query);
    $barray = array();
    if ($query_run) {
        while ( $brow = mysqli_fetch_assoc($query_run)) {
            # code...
            $barray[] = $brow;
        }
    }
        return $barray;    
}

// GET ALL USERS
function _getusertranlimited($userid){
    global $link;
    $query = "SELECT * FROM budget_tbl WHERE userid = '$userid' ORDER BY dated DESC LIMIT 4" ;
    $query_run = mysqli_query($link, $query);
    $barray = array();
    if ($query_run) {
        while ( $brow = mysqli_fetch_assoc($query_run)) {
            # code...
            $barray[] = $brow;
        }
    }
        return $barray;    
}

// GET ALL USERS
function _getalluserslimited(){
    global $link;
    $query = "SELECT * FROM users_tbl ORDER BY dated DESC LIMIT 4" ;
    $query_run = mysqli_query($link, $query);
    $usersarray = array();
    if ($query_run) {
        while ( $usersrow = mysqli_fetch_assoc($query_run)) {
            # code...
            $usersarray[] = $usersrow;
        }
    }
        return $usersarray;    
}

function _getallpositions(){
    global $link;
    $query = "SELECT * FROM positions_tbl " ;
    $query_run = mysqli_query($link, $query);
    $posarray = array();
    if ($query_run) {
        while ( $posrow = mysqli_fetch_assoc($query_run)) {
            # code...
            $posarray[] = $posrow;
        }
    }
        return $posarray;    
}
function _getallamounts(){
    global $link;
    $query = "SELECT * FROM amounts_tbl " ;
    $query_run = mysqli_query($link, $query);
    $amtarray = array();
    if ($query_run) {
        while ( $amtrow = mysqli_fetch_assoc($query_run)) {
            # code...
            $amtarray[] = $amtrow;
        }
    }
        return $amtarray;    
}

// NEW STAFF  
function _newStaff($fname, $lname, $email, $password, $phone, $NewImageName, $position, $allocatedamount, $balance ,$authlevel, $date){
    global $link;

    $query = "INSERT INTO users_tbl (firstname, lastname, email, password, phone, avatar, position, allocated_amount, balance, auth_level, dated) 
    VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$NewImageName', '$position', '$allocatedamount', '$balance', '$authlevel', '$date') " ;
    $query_run = mysqli_query($link, $query);
        if($query_run){
            return true;
        } else {
            return false;
        }
    }

// NEW STAFF  
function _newBudget($userid0, $bname, $binfo, $amount, $rname, $address, $remail, $rphone, $budgetid, $date){
    global $link;

    $query = "INSERT INTO budget_tbl (userid, budgetname, budgetdescription, budgetamount, recipientname, recipientaddress, recipientemail, recipientphone, invoicenumber, dated) 
    VALUES ('$userid0','$bname', '$binfo', '$amount', '$rname', '$address', '$remail', '$rphone', '$budgetid', '$date') " ;
    $query_run = mysqli_query($link, $query);
        if($query_run){
            return true;
        } else {
            return false;
        }
    }

function _updatebalance($userid, $balance){
    global $link;
    $query = "UPDATE users_tbl SET balance = '$balance' WHERE id = '$userid' ";
    $query_run = mysqli_query($link, $query);
        if($query_run){
            return true;
        } else {
            return false;
        }
    }
