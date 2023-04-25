<?php


class UserController
{
    private $user_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the UserModel class
        $this->user_model = UserModel::getUserModel();
        //verify session has been started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    //show details of a user
    public function detail()
    {
        //don't let them see this if they ain't signed in
        try{
            if(!isset($_SESSION['member-id'])){
                throw new UnauthorizedAccessException("You must sign in to view this page.");
            }

            $user = $this->user_model->view_user();
            if(!$user){
                throw new PageloadException("Couldn't load user data.");
            }

            //display user details
            $view = new UserDetailView();
            $view->display($user);
        }catch (UnauthorizedAccessException $e){
            $this->error($e->getMessage());
        }catch (PageloadException $e){
            $this->error($e->getMessage());
        }
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

    //register
    public function register()
    {
        $register = new UserRegister();
        $register->display();
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

    //make the new account
    public function create(){
        try{
            $member = $this->user_model->add_user();

            if(!$member){
                throw new PageloadException("We're sorry, your account could not be created.");
            }
        }catch (PageloadException $e){
            $this->error($e->getMessage());
            exit;
        }

        //go to accounts page
        $view = new RegisterSuccessView();
        $view->display();
    }
    public function verify()
    {
        try{
            $user = $this->user_model->verify_user();

            //if no user, throw error
            if(!$user){
                throw new PageloadException("Invalid login details. Please try again.");
            }

            //reroute to details page
            $this->detail();
        }catch (PageloadException $e){
            $this->error($e->getMessage());
        }

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