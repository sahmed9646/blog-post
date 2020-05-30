<?php 
class Posts extends Controller{

   public function __construct(){
      if (!userLoggedIn()) {
         redirect("users/login");
      }

      $this->postModel = $this->model("Post");
      $this->userModel = $this->model("User");
      $this->catModel = $this->model("Category");
   }
   public function index(){
      
      
      //get all categories
      $categories = $this->catModel->getCategories();
      //get posts as popular by random() function
      $postByRandom = $this->postModel->getPostByRandom();

      //pagination
      $perPage = 5;
      $allPosts = $this->postModel->totalPosts();
      $totalPages = ceil($allPosts/$perPage);

      //get all posts
      //I want to show latest 5 post and 5 post per pages
      $startFrom = 0;   
      $posts = $this->postModel->getPosts($startFrom, $perPage);

      $data = [
         'posts' => $posts,
         'categories' => $categories,
         'randomPost' => $postByRandom,
         'totalPages' => $totalPages
      ];
      $this->view('posts/index', $data);
   }
   
   public function add(){
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         
         $data = [
            'cat_id' => trim($_POST['cat_id']),
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['user-id'],
            'cat_err' => '',
            'title_err' => '',
            'body_err' => ''
         ];
         if ($data['cat_id'] == 0) {
            $data['cat_err'] = "Please select one";
         }
         
         if (empty($data['title'])) {
            $data['title_err'] = "Please write post title";
         }
         if (empty($data['body'])) {
            $data['body_err'] = "Please write post description";
         }

         if (empty($data['cat_err']) && empty($data['title_err']) && empty($data['body_err'])) {
            // Validated, let's procced next functionality
            if($this->postModel->addPost($data)){
               flash("postMsg", "Post Added Successfully");
               redirect("posts");
            }else{
               die("Somethin went wrong");
            }
            
         }else{
            // show with error
            $categories = $this->catModel->getCategories();
            $data=[
               'categories' => $categories,
               'cat_id' => trim($_POST['cat_id']),
               'title' => trim($_POST['title']),
               'body' => trim($_POST['body']),
               'user_id' => $_SESSION['user-id'],
               'cat_err' => '',
               'title_err' => '',
               'body_err' => ''
            ];
            if ($data['cat_id'] == 0) {
               $data['cat_err'] = "Please select one";
            }
            if (empty($data['title'])) {
               $data['title_err'] = "Please write post title";
            }
            if (empty($data['body'])) {
               $data['body_err'] = "Please write post description";
            }
            $this->view('posts/add', $data);
         }
      }else{
         $categories = $this->catModel->getCategories();
         $data = [
            'categories' => $categories,
            'cat_id' => '',
            'title' => '',
            'body' => '',
            'title_err' => '',
            'body_err' => ''
         ];
         $this->view('posts/add', $data);
      }   
   }

   public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);
      $category = $this->catModel->getCategoryById($post->cat_id);
      
      $data = [
         'post' => $post,
         'user' => $user,
         'category' => $category
         
      ];

      $this->view("posts/show", $data);
   }

   public function edit($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data = [
            'id' => $id,
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['user-id'],
            'cat_id' => trim($_POST['cat_id']),
            'title_err' => '',
            'body_err' => '',
            'cat_err' => ''
         ];
         if ($data['cat_id'] == 0) {
            $data['cat_err'] = "Please select one";
         }
         if (empty($data['title'])) {
            $data['title_err'] = "Please write post title";
         }
         if (empty($data['body'])) {
            $data['body_err'] = "Please write post description";
         }

         if (empty($data['cat_err']) && empty($data['title_err']) && empty($data['body_err'])) {
            // Validated, let's procced next functionality
            if($this->postModel->updatePost($data)){
               flash("postMsg", "Post Updated Successfully");
               redirect("posts");
            }else{
               die("Somethin went wrong");
            }
            
         }else{
            // show with error
            $categories = $this->catModel->getCategories();
            $data=[
               'categories' => $categories,
               'cat_id' => trim($_POST['cat_id']),
               'title' => trim($_POST['title']),
               'body' => trim($_POST['body']),
               'user_id' => $_SESSION['user-id'],
               'cat_err' => '',
               'title_err' => '',
               'body_err' => ''
            ];
            if ($data['cat_id'] == 0) {
               $data['cat_err'] = "Please select one";
            }
            if (empty($data['title'])) {
               $data['title_err'] = "Please write post title";
            }
            if (empty($data['body'])) {
               $data['body_err'] = "Please write post description";
            }
            $this->view('posts/edit', $data);
         }
      }else{
         $post = $this->postModel->getPostById($id);
         if ($post->user_id != $_SESSION['user-id']) {
            redirect('posts');
         }

         $category = $this->catModel->getCategoryById($post->id);
         $categories = $this->catModel->getCategories();

         $data = [
            'id' => $id,
            'cat_id' => $post->cat_id,
            'title' => $post->title,
            'body' => $post->body,
            'categories' => $categories
            
         ];
         $this->view('posts/edit', $data);
      }
   }

   public function delete($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         $post = $this->postModel->getPostById($id);
         if ($post->user_id != $_SESSION['user-id']) {
            redirect('posts');
         }

         if ($this->postModel->deletePost($id)) {
            flash("postMsg", "Post Removed");
            redirect('posts');
         }
      }else{
         redirect('posts');
      }
   }

   public function postByCat($catId){
      $posts = $this->postModel->getPostsByCatId($catId);
      $categories = $this->catModel->getCategories();
      $postByRandom = $this->postModel->getPostByRandom();
      $postsLimit6 = $this->postModel->getPostsLimit6();
      $data = [
         'posts' => $posts,
         'categories' => $categories,
         'randPost' => $postByRandom,
         'postsLimit6' => $postsLimit6
      ];   
      $this->view('posts/showPostByCat', $data); 
   }

   public function pagination($page){
      
      //get all categories
      $categories = $this->catModel->getCategories();
      //get posts as popular by random() function
      $postByRandom = $this->postModel->getPostByRandom();

      // showing 5 post per pages
      $perPage = 5;
      $startFrom = ($page-1)*$perPage;
      $allPosts = $this->postModel->totalPosts();
      $totalPages = ceil($allPosts/$perPage);
      
      $posts = $this->postModel->getPosts($startFrom, $perPage);

      $data = [
         'posts' => $posts,
         'categories' => $categories,
         'randomPost' => $postByRandom,
         'totalPages' => $totalPages,
      ];
      $this->view('posts/index', $data);

   }
}