<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login() {
        $this->render('login');
    }

    public function notes() {
        $this->render('notes');
    }

    public function sign_up() {
        $this->render('sign-up');
    }

    public function to_do() {
        $this->render('to-do');
    }

    public function google() {
        $search_url = "https://www.google.com/search?q=";

        if (!$this->isPost()) {
            return $this->render('');
        }

        $keywords = $_POST['keywords'];
        header("Location: ".$search_url.$keywords);
    }
}
