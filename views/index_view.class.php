<?php

class IndexView
{
    // this method displays the page header
    static public function displayHeader($page_title)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title><?php echo $page_title ?></title>
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/styles.css' />
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
        </head>
        <body>
            <div class="header">
                <div class="title-bar">
                    <!-- LOGO AND INFO HERE -->
                    <a href="<?= BASE_URL ?>/index.php"><img src="<?= BASE_URL ?>/www/images/infinibank-1.png"></a>
                </div>
                <nav>
<!--                    ADD NAVIGATION -->
                    <a href="<?= BASE_URL ?>/index.php">HOME</a>
                    <a href="<?= BASE_URL ?>/index.php">ABOUT</a>
                    <a href="<?= BASE_URL ?>/index.php">LOG IN</a>
                    <a href="<?= BASE_URL ?>/register.php">REGISTER</a>
                </nav>
            </div>
            <div class="content">

        <?php

    } // end of display header function

    //footer function
    public static function displayFooter(){
        ?>
        </div>

        <footer>
            &copy; 2023 Joseph Floreancig & Summer Sexton
        </footer>
        </body>
        </html>
        <?php
    } // end of footer
}