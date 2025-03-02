<?php  require __DIR__ . '/../public/index.php';

if (preg_match('/\.js$/', $_SERVER['REQUEST_URI'])) {
    header('Content-Type: application/javascript');
}
