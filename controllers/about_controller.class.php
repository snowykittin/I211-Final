<?php

class AboutController
{
    public function index(){
        $view = new AboutView;
        $view->display();
    }

}