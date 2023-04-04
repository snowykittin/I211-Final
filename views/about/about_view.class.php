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


        <?php
        //display footer
        parent::displayFooter();

    }

}