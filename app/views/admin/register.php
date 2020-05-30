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
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
</head>
<body>
<header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-gear"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>


  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

<div class="row">
   <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
         <h2>Create an account</h2>
         <form action="<?php echo URLROOT; ?>/admins/adminRegister" method="post">
            <div class="form-group">
               <label for="name">Name : <sup>*</sup></label>
               <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" >
               <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>

            <div class="form-group">
               <label for="emaiil">Email : <sup>*</sup></label>
               <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" >
               <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>

            <div class="form-group">
               <label for="password">Password : <sup>*</sup></label>
               <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" >
               <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>

            <div class="form-group">
               <label for="bio">BioData : <sup>*</sup></label>
               <textarea type="text" name="bio" class="form-control form-control-lg <?php echo (!empty($data['bio_err'])) ? 'is-invalid' : ''; ?>" value="" ><?php echo $data['bio']; ?></textarea>
               <span class="invalid-feedback"><?php echo $data['bio_err']; ?></span>
            </div>

            <div class="form-group" style="display:none">
               <label for="label">label : <sup>*</sup></label>
               <input type="text" name="label" class="form-control form-control-lg " value="<?php echo $data['label']; ?>" >  
            </div>

            <div class="row">
               <div class="col">
                  <input type="submit" value="Register" class="btn btn-success btn-block">
               </div>
               <div class="col">
                  <a href="<?php echo URLROOT; ?>/admins/adminLogin" class="btn btn-light btn-block">Have an account? Login Here</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>


<?php require APPROOT.'/views/admin/inc/footer.php'; ?>