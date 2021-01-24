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

    public function timetable() {
        $this->render('timetable');
    }

    public function to_do() {
        $this->render('to-do');
    }

    public function user_account() {
        $this->render('user-account');
    }

}
