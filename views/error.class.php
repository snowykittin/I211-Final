<?php

class ErrorView extends IndexView
{
public function display($message){
//display page header
$page_title = "Infinibank - About";
parent::displayHeader($page_title);
?>

    <p><?= $message ?></p>
    <?php
    //display footer
    parent::displayFooter();

}

}