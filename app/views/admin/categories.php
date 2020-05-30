<?php require "inc/header.php"; ?>

  <!-- ACTIONS -->
 <!-- <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-success">Search</button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>  -->

  <!-- CATEGORIES -->
  <section id="posts">
    <div class="container mt-3 w-70">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Categories</h4>
              <?php echo flash("catMsg"); ?>
            </div>
            <table class="table table-striped text-center">
              <thead class="thead-inverse bg-dark text-light">
                <tr>
                  <th width="25%">#</th>
                  <th width="35%">Title</th>
                  <th width="20%">Edit</th>
                  <th width="20%">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; foreach($data['categories'] as $category): $i++;?>
                <tr>
                  <td scope="row"><?php echo $i; ?></td>
                  <td><?php echo $category->catName; ?></td>
                  <td><a href="<?php echo URLROOT; ?>/admins/editCategory/<?php echo $category->id; ?>" class="btn btn-success">
                    <i class="fa fa-check"></i> Change
                    </a>
                  </td>
                  <td>
                    <form action="<?php echo URLROOT; ?>/admins/categoryDelete/<?php echo $category->id; ?>" method="post">
                      <button type="submit" class="btn btn-danger text-light">
                        <i class="fa fa-remove"></i> Delete
                      </button>
                    </form> 
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <!-- <nav class="ml-4">
              <ul class="pagination">
                <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>
                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
              </ul>
            </nav> -->
          </div>
        </div>
      </div>
    </div>
  </section>



  <?php require "inc/footer.php"; ?>
