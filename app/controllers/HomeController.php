<?php
require_once 'core/View.php';
class HomeController {
    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    public function loadModel($model) {
        require_once 'models/' . $model . '.php';
        return new $model();
    }
    public function index() {
        $this->view->render('home');
    }
}
?>
