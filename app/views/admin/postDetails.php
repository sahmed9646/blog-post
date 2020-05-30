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
        <div class="col-md-3">       
          <button id="submitButton" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Save Changes
          </button>
        </div>
        <div class="col-md-3">
        <form action="<?php echo URLROOT; ?>/admins/postDelete/<?php echo $data['post']->id; ?>" method="post">
          <button class="btn btn-danger btn-block">
            <i class="fa fa-remove"></i> Delete Post
          </button>
        </form> 
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
              <h4>Edit Post</h4>
            </div>
            <div class="card-body">
              <form action="<?php echo URLROOT; ?>/admins/postDetails/<?php echo $data['post']->id; ?>" id="submit-form" method="post">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" value="<?php echo $data['post']->title; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Category</label>
                  <select name="cat_id" class="form-control">
                  <?php foreach($data['categories'] as $category): ?> 
                    <option 
                    <?php if ($data['cat_id'] == $category->id) {?>
                      selected = 'selected';
                    <?php }?>
                    value="<?php echo $category->id; ?>"><?php echo $category->catName; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="body" class="form-control"><?php echo $data['post']->body; ?></textarea>
                </div>
                <input type="submit" style="display:none">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'body' );
  </script>

  <?php require "inc/footer.php"; ?>
