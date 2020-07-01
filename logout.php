<?php

// Confirm session
require_once __DIR__ . '/session.php';
require_logined_session();

// Discard session cookie
setcookie(session_name(), '', 1);

// Discard session file
session_destroy();

header('location: ./bbs.php');