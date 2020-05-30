<?php require "inc/header.php"; ?>


  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mr-auto">
          <a href="<?php echo URLROOT; ?>/admins" class="btn btn-light btn-block">
            <i class="fa fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Category</h4>
            </div>
            <div class="card-body">
              <form action="<?php echo URLROOT; ?>/admins/editCategory/<?php echo $data['category']->id; ?>" method="post">
                <div class="form-group">
                  <label for="catName">Category Name</label>
                  <input type="text" class="form-control <?php echo (!empty($data['cat_err'])) ? 'is-invalid' : ''; ?>" name="catName" value="<?php echo $data['category']->catName; ?>">
                  <span class="invalid-feedback"><?php echo $data['cat_err']; ?></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">
                     <i class="fa fa-check"></i> Save Changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require "inc/footer.php"; ?>
