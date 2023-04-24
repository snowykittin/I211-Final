<?php


class UserController
{
    private $user_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the UserModel class
        $this->user_model = UserModel::getUserModel();
    }

    //index action that displays all users
    public function index()
    {
        // retrieve all users and store them in an array
        $users = $this->user_model->list_user();

        if (!$users) {
            return false;
        }
        // display all users
        $view = new UserIndex();
        $view->display($users);
        return true;
    }

    //register page autosuggest
    public function suggest_cities($query){
        //retrieve query terms
        $query_terms = urldecode(trim($query));
        $locations = $this->user_model->search_cities($query_terms);

        $cities = array();
        if($locations){
            foreach ($locations as $location){
                $cities[] = $location->getCity();
            }
        }

        echo json_encode($cities);
    }

    public function addDisplay()
    {
        // create an object
        $error = new UserRegister();
        $error->display();
    }

    public function add()
    {
        //retrieve all users and store them in an array
        $users = $this->user_model->add_user();
        if (!$users) {
            return false;
        }
        $detail = new UserLogin();
        $detail->display();
    }

    //show details of a user
    public function detail($id)
    {
        //retrieve the specific user
        $user = $this->user_model->view_user($id);
        //  $reviews = $this->review_model->list_review($id);

        if (!$user) {
            return false;
        }

        //display user details
        $view = new UserDetail();
        $view->display($id, $user);
    }

    // edit a users information
    public function edit($id)
    {
        // retrieve user info
        $user = $this->user_model->view_user($id);

        // error handle
        if (!$user) {
            return false;
        }

        $view = new UserEdit();
        $view->display($user);
        return true;
    }

    //update a user in the database
    public function update($id)
    {
        //update the user
        $update = $this->user_model->update_user($id);

        if (!$update) {
            return false;
        }

        //display the updated user details
        $confirm = "The user was successfully updated.";
        $view = new UserUpdate();
        $view->display($confirm, $id);
        return true;
    }

    //register
    public function register()
    {
        $register = new UserRegister();
        $register->display();
    }

    //login
    public function login()
    {
        $login = new UserLogin();
        $login->display();
    }

    // logout
    public function logout()
    {
        $_SESSION['privilege'] = NULL;
        $_SESSION['member-id'] = NULL;
        setcookie("privilege", false);
        setcookie("member-id", false);

        header('Location: ../index.php');
    }

    //handle an error
    public function error($message)
    {
        //create an object of the Error class
        $error = new ErrorView();
        //display the error page
        $error->display($message);
    }

}