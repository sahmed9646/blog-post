<?php 
class AdminAuth extends Controller{
   public function __construct(){
      $this->adminModel = $this->model('Admin');
   }

   public function adminRegister(){
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
            'bio' => trim($_POST['bio']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'bio_err' => ''
         ];

         //validate all input fields
         if(empty($data['name'])){
            $data['name_err'] = "Please Enter Name";
         }
         if(empty($data['email'])){
            $data['email_err'] = "Please Enter Email";
         }else{
            //check if the email is already taken
            if ($this->adminModel->findAdminByEmail($data['email'])) {
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

         // Make sure errors are empty
         if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['bio_err'])) {
            // success
            //hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // if everythin entered correctly
            // move procced
            if ($this->adminModel->register($data)) {

               //if success, send a flash message, and redirect to Login page
               flash('registerd_success', "You Have Registerd Successfully. Now You Can Log In");
               redirect('admins/adminLogin');
            }else{
               die("Oops! Something went wrong");
            }
         }else{
            $this->view('admin/register', $data);
         }

      }else{
         // init data
         $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'bio' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'bio_err' => ''
         ];

         // load view
         $this->view("admin/register", $data);
      }
   
   }

   public function adminLogin(){
   if (adminLoggedIn()) {
      redirect("admins");
   }
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
         'email' => trim($_POST['email']),
         'password' => trim($_POST['password']),
         'email_err' => '',
         'password_err' => ''
      ];

      if (empty($data['email'])) {
         $data['email_err'] = "Please Enter Registered Email";
      }else{
         if ($this->adminModel->findAdminByEmail($data['email'])) {
            //user found
         }else{
            //user not found
            $data['email_err'] = "No Admin Found";
         }
      }

      if (empty($data['password'])) {
         $data['password_err'] = "Please Enter Your Password";
      }

      //check user email registered or not
      

      if (empty($data['email_err']) && empty($data['password_err'])) {
      
         $loggedIn = $this->adminModel->login($data['email'], $data['password']);
         if ($loggedIn) {
            $this->createAdminSession($loggedIn);
         }else{
            $data['password_err'] = "Password Incorrect";
            $this->view("admin/login", $data);
         }
      }else{
         $this->view('admin/login', $data);
      }

   }else{
      // if someone doesn't press log in
      $data = [
         'email' => '',
         'password' => '',
         'email_err' => '',
         'password_err' => ''
      ];
      $this->view('admin/login', $data);
   }

   }
   public function createAdminSession($admin){
   $_SESSION['admin-id'] = $admin->id;
   $_SESSION['admin-email'] = $admin->email;
   $_SESSION['admin-name'] = $admin->name;
   $_SESSION['admin-label'] = $admin->label;
   redirect('admins/index');
   }

   public function adminLogout(){
   unset($_SESSION['admin-id']);
   unset($_SESSION['admin-email']);
   unset($_SESSION['admin-name']);
   unset($_SESSION['admin-label']);
   session_destroy();
   redirect('AdminAuth/adminLogin');
   }
   
}