<?php require "inc/header.php"; ?>


  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <!-- <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
            <i class="fa fa-plus"></i> Add Post
          </a>
        </div> -->
        <div class="col-md-3">
          <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fa fa-plus"></i> Add Category
          </a>
          <?php echo flash("catMsg"); ?>
        </div>
        <!-- <div class="col-md-3">
          <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#addUserModal">
            <i class="fa fa-plus"></i> Add User
          </a>
        </div> -->
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Latest Posts</h4>
            </div>
            <?php echo flash("postMsg"); ?>
            <table class="table table-striped">
              <thead class="thead-inverse bg-dark text-light">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Date Posted</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=0; foreach($data['getPosts'] as $posts): $i++; ?>
                <tr>
                  <td scope="row"><?php echo $i; ?></td>
                  <td><?php echo $posts->title; ?></td>
                  <td><?php echo $posts->catName; ?></td>
                  <td><?php echo $posts->postCreated; ?></td>
                  <td><a href="<?php echo URLROOT; ?>/admins/postDetails/<?php echo $posts->postId; ?>" class="btn btn-secondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                </tr>
              <?php endforeach; ?> 
              </tbody>
            </table> 
          </div>
          <!--Pagination -->
          <span class="bg-dark text-center p-2 rounded d-inline float-right my-2">
              <a href="<?php echo URLROOT; ?>/admins/pagination/1" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light">First Page</a>
              <?php 
              if (isset($data['totalPages'])) {
                  for($i=1; $i<=$data['totalPages']; $i++){?>
                    <a href="<?php echo URLROOT; ?>/admins/pagination/<?php echo $i; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light"><?php echo $i; ?></a>
              <?php } }?>
              <a href="<?php echo URLROOT; ?>/admins/pagination/<?php echo $data['totalPages']; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none">Last Page</a>
          </span>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Posts</h3>
              <h1 class="display-4">
                <i class="fa fa-pencil"></i> <?php echo $data['totalPosts']; ?>
              </h1>
              <!-- <a href="posts.html" class="btn btn-outline-light btn-sm">View</a> -->
            </div>
          </div>

          <div class="card text-center bg-success text-white mb-3">
            <div class="card-body">
              <h3>Categories</h3>
              <h1 class="display-4">
                <i class="fa fa-folder-open-o"></i> <?php echo $data['totalCategories']; ?>
              </h1>
              <!-- <a href="categories.html" class="btn btn-outline-light btn-sm">View</a> -->
            </div>
          </div>

          <div class="card text-center bg-warning text-white mb-3">
            <div class="card-body">
              <h3>Users</h3>
              <h1 class="display-4">
                <i class="fa fa-users"></i> <?php echo $data['totalUsers']; ?>
              </h1>
              <!-- <a href="users.html" class="btn btn-outline-light btn-sm">View</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- POST MODAL -->
  <!-- <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add Post</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="/admins/postAdd" method="post" id="submit-form">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" placeholder="Enter post title" class="form-control form-control-lg">
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select name="cat_id" class="form-control">
                <option value=""></option> 
              </select>
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <textarea id="CKEditor" name="body" class="form-control"></textarea>
            </div>
            <span class="invalid-feedback"></span>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="submitButton" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div> -->


  <!-- CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="submit-form" action="<?php echo URLROOT; ?>/admins/addCategory" method="post">
            <div class="form-group">
              <label for="catName">Category Name</label>
              <input type="text" name="catName" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-success" id="submitButton" data-dismiss="modal">Add</button>
        </div>
      </div>
    </div>
  </div>

  <!-- USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Confirm Password</label>
              <input type="password" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
    </div> 
  <?php require "inc/footer.php"; ?>