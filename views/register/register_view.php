<?php
class RegisterView
{
    static public function show($form_data)
    {
        $page_title = "InfiniBank - Register";
        IndexView::displayHeader($page_title);
        ?>
        <h2>Register</h2>
        <form method="post" action="<?= BASE_URL ?>/controllers/register.php">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?= $form_data['first_name'] ?? '' ?>" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?= $form_data['last_name'] ?? '' ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= $form_data['email'] ?? '' ?>" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br><br>

            <input type="submit" name="register" value="Register">
        </form>
        <?php
        IndexView::displayFooter();
    }
}
