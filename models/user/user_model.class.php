<?php


class UserModel
{
    // private data
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUsers;

    // constructor
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getMembersTable();
    }

    // static method to ensure there is a User instance
    public static function getUserModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }

    // list users
    public function list_user()
    {
        try {
            $sql = "SELECT * FROM $this->tblUsers";

            $query = $this->dbConnection->query($sql);

            // if the query failed, return false.
            if (!$query) {
                throw new DatabaseException("Error listing all users, check the sql or query statments.");
            }
        } catch (DatabaseException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        //if the query succeeded, but no user was found.
        if ($query->num_rows == 0)
            //echo 'no rows';
            return 0;

        //handle the result
        //create an array to store all users
        $users = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            //echo stripslashes($obj->title);
            //echo $query->num_rows;
            $user = new User (stripslashes($obj->id), stripslashes($obj->username), stripslashes($obj->password), stripslashes($obj->firstname), stripslashes($obj->lastname), stripslashes($obj->email), stripcslashes($obj->role));
            //echo $obj->id;
            //set the id for the user
            $user->setId($obj->id);

            //add the users into the array
            $users[] = $user;
        }
        return $users;
    }

    public function add_user()
    {
        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        // handles missing data before even reaching the sql statement
        try {
            if ($username == "" || $password == "" || $lastname == "" || $firstname == "" || $email == "") {
                throw new DataMissingException("There is missing data. Please make sure to fill out all fields.");
            }
            // verify email format
            if (!Utilities::checkemail($email)) {
                throw new EmailFormatException("Email entered does not follow format. Please follow the email format.");
            }
            // verify password exceptions
            if (strlen($password) < 8) {
                throw new PasswordLengthException("Password must be at least 8 characters long.");
            }
            if (!preg_match("@[A-Z]@", $password)) {
                throw new PasswordLengthException("Password must have at least one Uppercase Letter");
            }
            if (!preg_match("@[0-9]@", $password)) {
                throw new PasswordLengthException("Password must have at least one number.");
            }
        } catch (DataMissingException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        } catch (EmailFormatException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        } catch (PasswordLengthException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // set the users role to 2 (2 will be default user)
            $role = 2;

            $sql = "INSERT INTO " . $this->db->getMembersTable() . " VALUES(NULL, '$username', '$hashed_password', '$firstname', '$lastname', '$email', '$role')";

            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === TRUE) {
                return "Congratulations! You have added an account.";
            } else {
                throw new RegisterErrorException("There was an error registering the account.");
            }
        } catch (RegisterErrorException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        //  return true;
    }

    public function verify_user()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // setting login status
        $_SESSION['login_status'] = 2;


        // retrieve the username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        try {
            if ($username == "" || $password == "") {
                throw new DataMissingException("Please enter a username or password");
            }
        } catch (DataMissingException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }


        //sql statement to filter the users table data with a username
        $sql = "SELECT password FROM " . $this->db->getMembersTable() . " WHERE username='$username'";

        //execute the query
        $query = $this->dbConnection->query($sql);
        try {
            //verify password; if password is valid, set a temporary cookie
            if ($query and $query->num_rows > 0) {
                $result_row = $query->fetch_assoc();

                $hash = $result_row['password'];
                if (password_verify($password, $hash)) {
                    setcookie("username", $username, time() + 60, "/");
                    try {
                        $sql = "SELECT * FROM " . $this->db->getMembersTable() . " WHERE username='$username'";
                        $query = $this->dbConnection->query($sql);
                        if (!$query) {
                            throw new UserIssueException("The Sql or Query failed.");
                        }
                    } catch (UserIssueException $e) {
                        $view = new UserController();
                        $view->error($e->getMessage());
                        return false;
                    }
                    $result_row = $query->fetch_assoc();
                    $user_id = $result_row['id'];
                    $user_detail = $result_row['username'];
                    $user_role = $result_row['role'];
                    $user_email = $result_row['email'];

                    //Session variable that holds the user id
                    $_SESSION['user_id'] = $user_id;

                    // display the users first and last name as their login information.
                    $_SESSION['login_status'] = 1;

                    // session var to store logged in username
                    $_SESSION['name'] = $user_detail;

                    // obtain the user role, store it in a session variable
                    $_SESSION['role'] = $user_role;

                    // store the email for the checkout page
                    $_SESSION['user_email'] = $user_email;

                    return "Congratulations! You are a verified user.";
                }
                //no error message need
                //return false;
            }
            // no return statement. Just return the first catch.
        } catch (UserIssueException $e) {
            // in place catch block. Doesn't do anything but is a place holder. Hard code solution used instead.
        }
        // retrieve the username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        try {
            if ($username == "" || $password == "") {
                throw new DataMissingException("Please enter a username or password");
            }
        } catch (DataMissingException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }

        // put the user input into an session variable
        $_SESSION['attempted_username'] = $username;
        $_SESSION['attempted_password'] = $password;

        $verify = "There was an issue verifying your account. Please make sure your username and password are valid." . "<br><br>";
        $view = new UserNonVerify();
        $view->display($verify);
        return false;
    }


    public function view_user($id)
    {
        try {
            //the select sql statement
            $sql = "SELECT * FROM " . $this->tblUsers . " WHERE id='$id'";
            //execute the query
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                throw new DatabaseException("There was an error running the SQL");
            }
        } catch (DatabaseException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        try {
            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create an user object
                $user = new User (stripslashes($obj->id), stripslashes($obj->username), stripslashes($obj->password), stripslashes($obj->firstname), stripslashes($obj->lastname), stripslashes($obj->email), stripcslashes($obj->role));
                //set the id for the user
                $user->setId($obj->id);
                return $user;
            } else {
                throw new UserIssueException("There was an issue viewing the user");
            }
        } catch (UserIssueException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        //return true;
    }

    //the update_user method updates an existing user in the database. Details of the user are posted in a form. Return true if succeed; false otherwise.
    public function update_user($id)
    {
        try {
            if (!filter_has_var(INPUT_POST, 'username') ||
                !filter_has_var(INPUT_POST, 'password') ||
                !filter_has_var(INPUT_POST, 'firstname') ||
                !filter_has_var(INPUT_POST, 'lastname') ||
                !filter_has_var(INPUT_POST, 'email')) {
                throw new DataMissingException("Please fill out all information when updating. NO NULL VALUES.");
            }
        } catch (DataMissingException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
        $username = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)));
        $password = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
        $firstname = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
        $lastname = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
        $email = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));


        $role = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT)));

        if (!$role) {
            $role = 2;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            //update query
            $sql = "UPDATE " . $this->tblUsers .
                " SET username='$username', password='$hashed_password', firstname='$firstname', "
                . "lastname='$lastname' , email='$email' , role='$role'  WHERE id='$id'";
            //execute
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("Failed to update user.");
            } else {
                return $query;
            }
        } catch (DatabaseException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
        }
        return true;
    }

    // this is basically useless
    public function get_user_id()
    {

    }

    public function delete_user()
    {
        $deleter = filter_input(INPUT_POST, 'confirm');

        try {
            if ($deleter == 'YES') {
                echo "It is reading the confirmation message";

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['user_id'])) {
                    $Adminid = $_SESSION['user_id'];
                    $id = $Adminid;

                    // begin the delete process
                    $sql = " DELETE FROM " . $this->tblUsers . " WHERE id='$id'";
                    $query = $this->dbConnection->query($sql);
                    if (isset($_SESSION['role'])) {
                        $LOGGEDROLE = $_SESSION['role'];
                    }

                    try {

                        if (!$query) {
                            throw new DatabaseException("Failed to Execute the SQL");
                        } else {
                            return $query;
                        }
                    } catch (DatabaseException $e) {
                        $view = new UserController();
                        $view->error($e->getMessage());
                        return false;
                    }
                }
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['user_id'])) {
                    $Adminid = $_SESSION['user_id'];
                } else {
                    $Adminid = NULL;
                }
                try {
                    if ($Adminid === NULL) {
                        throw new ViewingErrorException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
                    } else {
                        throw new UserIssueException("Typo in the word YES." . "<br><br>" . "MAKE SURE IT IS IN ALL CAPS");
                    }
                } catch (ViewingErrorException $e) {
                    $view = new UserController();
                    $view->manierror($e->getMessage());
                    return false;
                } catch (UserIssueException $e) {
                    $view = new UserController();
                    $view->error($e->getMessage());
                    return false;
                }
            }
        } catch (ViewingErrorException $e) {
            $view = new UserController();
            $view->manierror($e->getMessage());
            return false;
        }
        return true;
    }
}