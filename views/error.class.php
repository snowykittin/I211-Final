<?php

class ErrorView extends IndexView
{
public function display($message){
//display page header
$page_title = "Infinibank - About";
parent::displayHeader($page_title);
?>

        <div class="error-container">
            <h1>Sorry, an error has occurred.</h1>
            <p>Details: <?= $message ?></p>
        </div>

    <?php
    //display footer
    parent::displayFooter();

}

}