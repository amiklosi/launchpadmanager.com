<?php
require_once('../config.php');

$oldconn = mysqli_connect("mysql", "root", "z3bral0") or die(mysqli_error($oldconn));
$newconn = mysqli_connect("mysql", "root", "z3bral0") or die(mysqli_error($newconn));

mysqli_select_db($newconn, DB_NAME) or die(mysqli_error($newconn));
mysqli_select_db($oldconn, OLD_DB_NAME) or die(mysqli_error($oldconn));

function check_key($key)
{
    global $newconn, $oldconn;
    
    // Check new database first
    $query = "SELECT * FROM licenses WHERE licensekey='" . mysqli_escape_string($newconn, $key) . "' LIMIT 1;";
    $result = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['appgrid_blocked'] == 1) {
            return false;
        }
        return true;
    }
    
    // Check old database
    $query = "SELECT * FROM licenses WHERE licensekey='" . mysqli_escape_string($oldconn, $key) . "' LIMIT 1;";
    $result = mysqli_query($oldconn, $query) or die(mysqli_error($oldconn));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['appgrid_blocked'] == 1) {
            return false;
        }
        return true;
    }
    
    return false;
}

// If called directly with key parameter
if (isset($_REQUEST['key'])) {
    $licensekey = substr(mysqli_escape_string($newconn, $_REQUEST['key']), 0, 36);
    
    if (check_key($licensekey)) {
        // Log the check to appgrid_checks table only when key is found
        $insert_query = "INSERT INTO appgrid_checks (licensekey) VALUES ('" . mysqli_escape_string($newconn, $licensekey) . "')";
        mysqli_query($newconn, $insert_query);
        
        echo 'EXISTS';
    } else {
        echo 'NOT_FOUND';
    }
}
?>