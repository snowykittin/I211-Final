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

    //autosuggest cities
    public function search_cities($term){

        //search query
        $sql = "SELECT * FROM countries WHERE city_ascii LIKE '%" . $term . "%' LIMIT 6";

        try{
            $query = $this->dbConnection->query($sql);

            if (!$query)
                throw new DatabaseException("We're having trouble connecting to the database right now. Please try again.");

            //search succeeded, but no transactions were found.
            if ($query->num_rows == 0)
                return 0;

            //successfully found at least one city
            $locations = array();

            while ($obj = $query->fetch_object()){
                $location = new Location(stripslashes($obj->city_ascii),stripslashes($obj->country),stripslashes($obj->admin_name));

                $locations[] = $location;
            }

            return $locations;
        }catch (DatabaseException $e) {
            $view = new ErrorView();
            $view->display($e->getMessage());
            return false;
        }
    }


    public function add_user(){
        //retrieve user inputs from the registration form
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $home_address = filter_input(INPUT_POST, "home_address", FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT);
        $country = filter_input(INPUT_POST, "country", FILTER_SANITIZE_STRING);

        // handles missing data before even reaching the sql statement
        try {
            if ($home_address == "" || $password == "" || $lastname == "" || $firstname == "" || $email == "" || $country == "") {
                throw new DataMissingException("There is missing data. Please make sure to fill out all fields.");
            }
            // verify email format
            if (!Utilities::checkemail($email)) {
                throw new EmailFormatException("Email entered does not follow format. Please follow the email format.");
            }
        } catch (DataMissingException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            exit();
        } catch (EmailFormatException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            exit();
        }

        try {
            $sql = "INSERT INTO " . $this->db->getMembersTable() . " VALUES(NULL, '$firstname', '$lastname', '$email', '$password', '$home_address', '$city', '$state', '$zip', '$country', 2)";

            $query = $this->dbConnection->query($sql);
            //execute the query and return true if successful or false if failed
            if (!$query) {
                throw new PageloadException("There was an error registering the account.");
            }

            //set the user's id
            $sql2 = "SELECT * FROM member WHERE email_address = '$email' AND password = '$password'";
            $query2 =  $this->dbConnection->query($sql2);

            if (!$query2) {
                throw new PageloadException("There was an error signing into the account.");
            }else{
                //set member id
                $row = $query2->fetch_assoc();
                $_SESSION['member-id'] = $row['member_id'];
                //set privilege
                $_SESSION['privilege'] = false;
            }

            return true;
        } catch (PageloadException $e) {
            $view = new UserController();
            $view->error($e->getMessage());
            return false;
        }
    }



    public function view_user()
    {
        try {
            //the select sql statement
            $sql = "SELECT * FROM " . $this->db->getMembersTable() . " WHERE member_id =" . $_SESSION['member-id'];
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
                $user = new User (stripslashes($obj->first_name), stripslashes($obj->last_name), stripslashes($obj->email_address), stripslashes($obj->password), stripslashes($obj->home_address), stripslashes($obj->city), stripslashes($obj->state), stripslashes($obj->zip), stripslashes($obj->country), stripslashes($obj->role));
                //set the id for the user
                $user->setId($obj->id);
                return $user;
            } else {
                throw new PageloadException("There was an issue viewing the user");
            }
        } catch (PageloadException $e) {
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
    //verify user
    public function verify_user($email, $password)
    {
        $email = $this->dbConnection->real_escape_string(trim($email));
        $sql = "SELECT * FROM " . $this->db->getMembersTable() . " WHERE email_address='$email'";

        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $user = $query->fetch_object();
            // Verify the password
            if (password_verify($password, $user->password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}