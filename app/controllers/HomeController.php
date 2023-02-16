<?php

require_once('model/TodoList.php');

class HomeController {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public function index() {
        $list = new TodoList($this->db);
        $items = $list->getItems();
        require_once('view/home.php');
    }
}

?>
