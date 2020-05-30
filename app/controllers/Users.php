<?php 
class Users extends Controller{
   public function __construct(){
      $this->userModel = $this->model('User');
   }

   public function register(){
      //check for post
      if($_SERVER['REQUEST_METHOD'] == "POST"){
         //process form
         
         // Sanitize POST data
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         //init data
         $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
         ];

         //validate all input fields
         if(empty($data['name'])){
            $data['name_err'] = "Please Enter Name";
         }
         if(empty($data['email'])){
            $data['email_err'] = "Please Enter Email";
         }else{
            //check if the email is already taken
            if ($this->userModel->findUserByEmail($data['email'])) {
               $data['email_err'] = "This email has already taken";
            }
         }



         if(empty($data['password'])){
            $data['password_err'] = "Please Enter Password";
         }else{
            //check minimum characters of password
            if (strlen($data['password']) < 6) {
               $data['password_err'] = "Password should be at least 6 character";
            }
         }

         if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = "Confirm your password";
         }else{
            // macthing the both password field
            if ($data['password'] != $data['confirm_password']) {
               $data['confirm_password_err'] = "Password does not match";
            }
         }

         // Make sure errors are empty
         if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
            // success
            //hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // if everythin entered correctly
            // move procced
            if ($this->userModel->register($data)) {

               //if success, send a flash message, and redirect to Login page
               flash('registerd_success', "You Have Registerd Successfully. Now You Can Log In");
               redirect('users/login');
            }else{
               die("Oops! Something went wrong");
            }
         }else{
            $this->view('users/register', $data);
         }

      }else{
         // init data
         $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
         ];

         // load view
         $this->view("users/register", $data);
      }
   }

   public function login(){
      //check for post
      if($_SERVER['REQUEST_METHOD'] == "POST"){
         //process form
         
         // Sanitize POST data
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         //init data
         $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',
         ];

         //validate all input fields
         
         if(empty($data['email'])){
            $data['email_err'] = "Please Enter Email";
         }

         if(empty($data['password'])){
            $data['password_err'] = "Please Enter Password";
         }

          //check user email registered or not
         if ($this->userModel->findUserByEmail($data['email'])) {
            //user found
         }else{
            //user not found
            $data['email_err'] = "User Not Found";
         }

         // Make sure errors are empty
         if (empty($data['email_err']) && empty($data['password_err']) ) {
            // validated
            //check and set loggedin user
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            if ($loggedInUser) {
               //create session
               $this->createUserSession($loggedInUser);
            }else{
               $data['password_err'] = "Password Incorrect";
               $this->view("users/login", $data);
            }
            
         }else{
            $this->view('users/login', $data);
         }
      }else{
         // init data
         $data = [
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',
         ];

         // load view
         $this->view("users/login", $data);
      }
   }

   public function createUserSession($user){
      $_SESSION['user-id'] = $user->id;
      $_SESSION['user-email'] = $user->email;
      $_SESSION['user-name'] = $user->name;
      redirect('posts/index');
   }

   // Logout Functionality
   public function logout(){
      unset($_SESSION['user-id']);
      unset($_SESSION['user-email']);
      unset($_SESSION['user-name']);
      session_destroy();
      redirect('users/login');
   }

   
}