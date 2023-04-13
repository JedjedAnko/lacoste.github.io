<?php
session_start();

function isSessionActive()
{
    if (isset($_SESSION['userSession'])) {
        return true;
    } else {
        return false;
    }
}

?>