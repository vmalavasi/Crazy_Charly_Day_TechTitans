<?php

require_once('config/config.php');
require_once('controller/HomeController.php');

$controller = new HomeController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

$controller->{$action}();

?>
