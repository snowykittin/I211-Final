<?php

$page_title = "Error";
//display header
IndexView::displayHeader($page_title);

?>
    <hr>
    <table style = "width: 100%; border: none">
        <tr>
            <td style = "text-align: left; vertical-align: top;">
                <h3> Sorry, but an error has occurred.</h3>
                <div style = "color: red">
                    <?= urldecode($message)
                    ?>
                </div>
                <br>
            </td>
        </tr>
    </table>

<?php
//display footer
IndexView::displayFooter();
