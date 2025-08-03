<?php
require_once('../config.php');
require_once('../log.php');


$oldconn = mysqli_connect("mysql", "root", "z3bral0") or die(mysqli_error($oldconn));
$newconn = mysqli_connect("mysql", "root", "z3bral0") or die(mysqli_error($newconn));

mysqli_select_db($newconn, DB_NAME) or die(mysqli_error($newconn));
mysqli_select_db($oldconn, OLD_DB_NAME) or die(mysqli_error($oldconn));

function keyIdFor($key)
{
    global $newconn, $oldconn;
    $query = "SELECT * FROM licenses WHERE licensekey='$key' LIMIT 1;";

    $gUser = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
    $verify = mysqli_num_rows($gUser);
    if ($verify > 0) {
        $row = mysqli_fetch_array($gUser);
        return $row['id'];
    }
    return -1;
}

function eligibleForUpgrade($key)
{
    global $oldconn;
    $query = "SELECT * FROM licenses WHERE licensekey='$key' LIMIT 1;";
    $gUser = mysqli_query($oldconn, $query) or die(mysqli_error($oldconn));
    $verify = mysqli_num_rows($gUser);
    return ($verify > 0);
}

function keysRemainingFor($keyId)
{
    global $newconn;
    $query = "SELECT * FROM licenses WHERE id='$keyId' LIMIT 1;";
    $gUser = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
    $verify = mysqli_num_rows($gUser);
    if ($verify > 0) {
        $row = mysqli_fetch_array($gUser);
        return $row['remaining'];
    }
    return -1;
}

function machineExistsForKeyId($machineId, $keyId)
{
    global $newconn;
    $query = "SELECT * FROM users WHERE key_id = '$keyId' AND machine_id = '$machineId' LIMIT 1;";
    $gUser = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
    $verify = mysqli_num_rows($gUser);
    return $verify > 0;
}

function decrementKeysLeftForKeyId($keyId)
{
    global $newconn;
    $query = "UPDATE licenses SET remaining = remaining - 1 WHERE id = '$keyId';";
    $result = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
}

function addNewMachine($keyId, $machineId)
{
    global $newconn;
    $query = "INSERT INTO users (key_id, machine_id) VALUES ('$keyId','$machineId')";
    $result = mysqli_query($newconn, $query) or die(mysqli_error($newconn));
}

function printResponse($machineId)
{
    echo hash_hmac('sha1', $machineId, '%gebebor%');
}


if (isset($_REQUEST['key']) && isset($_REQUEST['machineid'])) {
    // Verify
    $licensekey = substr(mysqli_escape_string($newconn, $_REQUEST['key']), 0, 36);
    $machineid = mysqli_escape_string($newconn, $_REQUEST['machineid']);
    log_action("Checking for " . $licensekey . " with " . $_REQUEST['machineid']);
    $keyId = keyIdFor($licensekey);
    log_action("KeyId".$keyId);
    if ($keyId > 0) {
        if (machineExistsForKeyId($machineid, $keyId)) {
            printResponse($machineid);
        } else if (keysRemainingFor($keyId) > 0) {
            decrementKeysLeftForKeyId($keyId);
            addNewMachine($keyId, $machineid);
            printResponse($machineid);
        } else {
            echo 'INVALID';
        }
    } else {
        if (eligibleForUpgrade($licensekey)) {
            echo 'UPGRADE';
        } else {
            echo 'INVALID';
        }
    }
}
?>
