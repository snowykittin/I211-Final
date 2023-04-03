<?php

class HomeIndex extends IndexView{
    public function display(){
        parent::displayHeader("Infinibank");
        ?>
        <div class="hero-banner">
            <div class="banner-text">
                Banking in the New Age
            </div>
        </div>

        <?php
        parent::displayFooter();
    }

}