<?php

class AboutView extends IndexView
{
    public function display(){
        //display page header
        $page_title = "InfiniBank - About";
        parent::displayHeader($page_title);
        ?>
        <div class="about">
            <h1>About Infinibank</h1>
            <p>Insert message about infinibank here.</p>
        </div>
        <div class="disclaimer">
            <h3>Disclaimer</h3>
            <p>This application is created as a final course project for I211. It is solely for teaching and learning purposes. As a course project, the goal is to learn how to do things, but not to get things done. Therefore, the code used in this project may not be most efficient or most effective. Furthermore, the code has not been tested in any production environment. If you want to use any code in this project in any production environment, use it at your own risk.</p>
        </div>

        <?php
        //display footer
        parent::displayFooter();

    }

}