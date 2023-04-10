<?php

class HomeController {
    public function index() {
        $view = new HomeIndex();
        $view->display();
    }

    public function about(){
        $view = new AboutView;
        $view->display();
    }
}