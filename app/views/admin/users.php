<?php require "inc/header.php"; ?>
  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4 ml-auto">
            <form class="input-group" action="<?php echo URLROOT; ?>/admins/checkSearch" method="post">
              <input type="text" id="searchBar" name="search" class="form-control" placeholder="Search">
              <input type="submit" class="btn btn-warning ml-1" value="Search">
            </form>
        </div>
        <!-- <div>
        <table class="table table-striped">
              <thead class="thead-inverse bg-dark text-light">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                <?php //foreach($data['susers'] as $user): ?>
                <tr>
                  <td><?php //echo $user->name; ?></td>
                  <td><?php //echo $user->email; ?></td>
                </tr>
                <?php// endforeach; ?>           
              </tbody>
            </table>
        </div> -->
      </div>
      <div id="liveStatus">

      </div>
    </div>
  </section>

  <!-- USERS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>All Users</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse bg-dark text-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($data['users'] as $user): $i++; ?>
                <tr>
                  <td scope="row"><?php echo $i; ?></td>
                  <td><?php echo $user->name; ?></td>
                  <td><?php echo $user->email; ?></td>
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
          
            <!--Pagination -->
            <span class="bg-dark text-center p-2 rounded float-right my-2">
              <a href="<?php echo URLROOT; ?>/admins/usersPage/1" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light">First Page</a>
              <?php 
              if (isset($data['totalPages'])) {
                  for($i=1; $i<=$data['totalPages']; $i++){?>
                    <a href="<?php echo URLROOT; ?>/admins/usersPage/<?php echo $i; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light"><?php echo $i; ?></a>
              <?php } }?>
              <a href="<?php echo URLROOT; ?>/admins/usersPage/<?php echo $data['totalPages']; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none">Last Page</a>
            </span>
        </div>
      </div>
    </div>
  </section>


  <?php require "inc/footer.php"; ?>