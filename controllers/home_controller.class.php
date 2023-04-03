<?php

class HomeController {
    public function index() {
        $view = new HomeIndex();
        $view->display();
    }
}