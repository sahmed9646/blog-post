<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blogen Admin Area</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/styleadmin.css">
  
</head>
<body>

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
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="<?php echo URLROOT; ?>/admins" class="navbar-brand">Admin Panel</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="<?php echo URLROOT; ?>/admins" class="nav-link <?php if($url[0] == 'admins' && $url[1] == '' || $url[1] == 'index'){?> active <?php }?>">Dashboard</a>
          </li>
          <!-- <li class="nav-item px-2">
            <a href="<?php //echo URLROOT; ?>/admins" class="nav-link">Posts</a>
          </li> -->
          <li class="nav-item px-2 <?php if($url[0] == 'admins' && $url[1] == 'viewCategory' || $url[1] == 'editCategory'){?> active <?php }?>">
            <a href="<?php echo URLROOT; ?>/admins/viewCategory" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="<?php echo URLROOT; ?>/admins/viewUsers" class="nav-link <?php if($url[0] == 'admins' && $url[1] == 'viewUsers' || $url[1] == 'usersPage'){?> active <?php }?>">Users</a>
          </li>
          <li class="nav-item px-2">
            <a href="<?php echo URLROOT; ?>" target="_blank" class="nav-link">Visit Website</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link active">
              <i class="fa fa-user"></i>  Welcome  <?php echo $_SESSION['admin-name']; ?>
            </a>
            <!-- <div class="dropdown-menu">
              <a href="profile.html" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Profile
              </a>
              <a href="settings.html" class="dropdown-item">
                <i class="fa fa-gear"></i> Settings
              </a>
            </div> -->
          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>/AdminAuth/adminLogout" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
