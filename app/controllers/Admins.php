<?php 
class Admins extends Controller{

   public function __construct(){

      if (!adminLoggedIn()) {
         redirect("AdminAuth/adminLogin");
      }

      $this->adminModel = $this->model("Admin");   
      $this->userModel = $this->model("User");
      $this->postModel = $this->model("Post");
      $this->catModel = $this->model("Category");
   }
   public function index(){
      $totalPosts = $this->postModel->totalPosts();
      $totalCategories = $this->catModel->totalCategories();
      $totalUsers = $this->userModel->totalUsers();

      //pagination
      $perPage = 10;
      $totalPages = ceil($totalPosts/$perPage);

      //get all posts
      //I want to show latest 10 post and 10 post per pages
      $startFrom = 0;   
      $getPosts = $this->postModel->getPosts($startFrom, $perPage);
      $data = [
         'totalPosts' => $totalPosts,
         'totalUsers' => $totalUsers,
         'totalCategories' => $totalCategories,
         'getPosts' => $getPosts,
         'totalPages' => $totalPages
      ];
      $this->view('admin/index', $data);
   }

  public function postDetails($id){
      if (!adminLoggedIn()) {
         redirect("admins/adminLogin");
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data = [
            'id' => $id,
            'title' => trim($_POST['title']),
            'cat_id' => trim($_POST['cat_id']),
            'body' => trim($_POST['body'])
            
         ];

         if (!empty($data['cat_id']) && !empty($data['title']) && !empty($data['body'])) {
            // Validated, let's procced next functionality
            if($this->postModel->updatePost($data)){
               flash("postMsg", "Saved Changes Successfully");
               redirect("admins");
            }else{
               die("Somethin went wrong");
            }
            
         }else{
            $getPost = $this->postModel->getPostById($id);
            $getCategories = $this->catModel->getCategories();
            $data = [
               'post' => $getPost,
               'cat_id' => $getPost->cat_id,
               'categories' => $getCategories
            ];
            $this->view('admin/postDetails', $data);
         }
      }else{
         $getPost = $this->postModel->getPostById($id);
         $getCategories = $this->catModel->getCategories();
         $data = [
            'post' => $getPost,
            'cat_id' => $getPost->cat_id,
            'categories' => $getCategories
         ];
         $this->view('admin/postDetails', $data);
      }
   }

   public function postDelete($id){
      if (!adminLoggedIn()) {
         redirect("admins/adminLogin");
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if ($_SESSION['admin-label'] == 0) {
            if ($this->postModel->deletePost($id)) {
               flash("postMsg", "Post Removed");
               redirect('admins');
            }    
         }else{
            flash("postMsg", "You are forbidden to delete");
            redirect('admins');
         }   
      }else{
         redirect('admins');
      }
   }

   public function pagination($page){
      
      //get all categories
      $categories = $this->catModel->getCategories();
      //get posts as popular by random() function
      $postByRandom = $this->postModel->getPostByRandom();

      $totalPosts = $this->postModel->totalPosts();
      $totalCategories = $this->catModel->totalCategories();
      $totalUsers = $this->userModel->totalUsers();

      // showing 10 post per pages
      $perPage = 10;
      $startFrom = ($page-1)*$perPage;
      $allPosts = $this->postModel->totalPosts();
      $totalPages = ceil($allPosts/$perPage);
      
      $posts = $this->postModel->getPosts($startFrom, $perPage);

      $data = [
         'getPosts' => $posts,
         'categories' => $categories,
         'randomPost' => $postByRandom,
         'totalPages' => $totalPages,
         'totalPosts' => $totalPosts,
         'totalUsers' => $totalUsers,
         'totalCategories' => $totalCategories,
      ];
      $this->view('admin/index', $data);

   }

   public function addCategory(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         
         $data = [
            'catName' => trim($_POST['catName']),
            'cat_err' => ''
         ];
         if (empty($data['catName'])) {
            $data['cat_err'] = "Field must not be empty";
         }

         if (empty($data['cat_err'])) {
            // Validated, let's procced next functionality
            if($this->catModel->addCategory($data)){
               flash("catMsg", "Category Added");
               redirect("admins");
            }else{
               die("Somethin went wrong");
            }
            
         }else{
            // show with error
            flash("catMsg", "Category Not Added");
            redirect("admins");  
         }
      }else{
         $this->view('admin/index');
      }
   }

   public function viewCategory(){
      $categories = $this->catModel->getCategories();
      $data = [
         'categories' => $categories
      ];
      $this->view('admin/categories', $data);
   }

   public function editCategory($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         
         $data = [
            'id' => $id,
            'catName' => trim($_POST['catName']),
            'cat_err' => ''
         ];
         if (empty($data['catName'])) {
            $data['cat_err'] = "Field must not be empty";
         }

         if (empty($data['cat_err'])) {
            // Validated, let's procced next functionality
            if($this->catModel->updateCategory($data)){
               flash("catMsg", "Category Updated");
               redirect("admins/viewCategory");
            }else{
               die("Somethin went wrong");
            }
            
         }else{
            // show with error
            $category = $this->catModel->getCategoryById($id);
            $data = [
               'category' => $category,
               'cat_err' => "Field must not be empty"
            ];
            $this->view('admin/editCategory', $data);
         }
      }else{
         $category = $this->catModel->getCategoryById($id);
      
         $data = [
            'category' => $category
         ];
         $this->view('admin/editCategory', $data);
      }
   }

   public function categoryDelete($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $category = $this->catModel->getCategoryById($id);
         if ($this->catModel->deleteCategory($id)) {
            flash("catMsg", $category->catName. " Category Removed");
            redirect('admins/viewCategory');
         }
      }else{
         redirect('admins/viewCategory');
      }
   }

   public function viewUsers(){
      $perPage = 10;
      $startFrom = 0;
      $allUsers = $this->userModel->totalUsers();
      $totalPages = ceil($allUsers/$perPage);
      $users = $this->userModel->getUsers($startFrom, $perPage);
      $data = [
         'users' => $users,
         'totalPages' => $totalPages
      ];
      $this->view("admin/users", $data);
   }

   public function usersPage($page){
       
      //get all Users
      $totalUsers = $this->userModel->totalUsers();

      // showing 10 user per pages
      $perPage = 10;
      $startFrom = ($page-1)*$perPage;
      $allUsers = $this->userModel->totalUsers();
      $totalPages = ceil($allUsers/$perPage);
      
      $users = $this->userModel->getUsers($startFrom, $perPage);

      $data = [
         'users' => $users,
         'totalPages' => $totalPages
      ];
      $this->view('admin/users', $data);
   }
   
   // public function checkSearch(){
   //    if ($_SERVER['REQUEST_METHOD'] == "POST") {
   //       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   //       $search = $_POST['search'];
   //      $sUsers = $this->userModel->searchUsers($search);
   //      $data=[
   //         'susers' => $sUsers
   //      ];
   //      $this->view('admin/users',$data);
   //    }
   // }
} 
   