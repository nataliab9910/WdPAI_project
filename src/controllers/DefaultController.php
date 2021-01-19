<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login() {
        // TODO
        $this->render('login');
    }

    public function notes() {
        // TODO
        $this->render('notes');
    }

    public function sign_up() {
        // TODO
        $this->render('sign-up');
    }

    public function timetable() {
        // TODO
        $this->render('timetable');
    }

    public function to_do() {
        // TODO
        $this->render('to-do');
    }

    public function user_account() {
        // TODO
        $this->render('user-account');
    }

    public function welcome() {
        // TODO
        $this->render('welcome');
    }

}
