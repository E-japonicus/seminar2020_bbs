<?php

function require_unlogined_session()
{
    @session_start();
    // If you are logged in, transition to admin.php
    if (isset($_SESSION['username'])) {
        header('Location: ./admin.php');
        exit;
    }
}

function require_logined_session()
{
    @session_start();
    // If you are not logged in, transition to /login.php
    if (!isset($_SESSION['username'])) {
        header('location: ./login.php');
        exit;
    }
}

// wrapper function for htmlspecialchars
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}