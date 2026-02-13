<?php
session_start();

// Inclut ton “module logique” du login
require_once __DIR__ . '/../app/auth/login.inc.php';

// Si la requête est GET, affiche le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/blog/login_view.php';
}