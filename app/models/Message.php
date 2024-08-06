<?php
class Message {
    private $messages = [];

    public function addMessage($type, $message) {
        $this->messages[] = ['type' => $type, 'message' => $message];
    }

    public function getMessages() {
        return $this->messages;
    }

    public function display() {
        foreach ($this->getMessages() as $msg) {
            echo "<div class='alert alert-{$msg['type']}'>{$msg['message']}</div>";
        }
    }

    public function clear() {
        $this->messages = [];
    }
}

?>