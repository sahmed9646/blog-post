<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
   <a class="navbar-brand" href="<?php echo URLROOT; ?>/pages"><?php echo SITENAME; ?></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
<?php 
  function getUrl(){
    if (isset($_GET['url'])) {
       $url = rtrim($_GET['url'], '/');
       $url = filter_var($url, FILTER_SANITIZE_URL);
       $url = explode('/', $url);
       return $url;
    }
 }
 $url = getUrl();
?>
   <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item <?php if($url[0] == '' || ($url[0] == 'pages' && $url[1] == '') || ($url[0] == 'posts' && $url[1] == '') || $url[1] == 'index'){?> active <?php }?>">
         <a class="nav-link" href="<?php echo URLROOT; ?>/pages">Home</a>
         </li>
         <li class="nav-item <?php if($url[0] == 'pages' && $url[1] == 'about'){?> active <?php }?>">
         <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
         </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user-id'])) {?>
         <li class="nav-item">
         <a class="nav-link" href=""> Welcome <?php echo $_SESSION['user-name']; ?></a>
         </li>
         <li class="nav-item">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"> Log Out </a>
         </li>
      <?php } else {?>
         <li class="nav-item <?php if($url[0] == 'users' && $url[1] == 'register'){?> active <?php }?>">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
         </li>
         <li class="nav-item <?php if($url[0] == 'users' && $url[1] == 'login'){?> active <?php }?>">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
         </li>
      <?php }?> 
      </ul>
   </div>
  </div>
</nav>