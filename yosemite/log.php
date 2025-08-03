<?php

function log_action($msg) {
    file_put_contents('php://stdout', $msg);
}
?>
