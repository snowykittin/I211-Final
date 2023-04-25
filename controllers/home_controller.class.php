<?php

class HomeController {
    public function index() {
        //verify session has been started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $view = new HomeIndex();
        $view->display();
    }

    public function about(){
        $view = new AboutView;
        $view->display();
    }
}