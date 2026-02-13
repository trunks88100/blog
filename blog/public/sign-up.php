<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../app/auth/signup.inc.php';
} else {
    header('login_view.php');
    exit();
}