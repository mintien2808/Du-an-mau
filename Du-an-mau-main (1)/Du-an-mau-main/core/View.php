<?php
class View {
    public function render($view, $data = []) {
        extract($data);
        require_once 'app/view/' . $view . '.php';
    }
    
    public function redirect($url) {
        header("Location: ../index.php?url=$url");
        exit;
    }

}
?>
