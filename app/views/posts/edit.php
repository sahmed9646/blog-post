<?php require APPROOT.'/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Go Back</a>
<div class="card card-body bg-light mt-5">
   <h2 class="text-center">Edit Post</h2>
   <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
         <div class="divcustom-select" style="width:400px;">
            <select name="cat_id" class="form-control form-control-lg <?php echo (!empty($data['cat_err'])) ? 'is-invalid' : ''; ?>">
               <option>Select A Category</option>
               <?php foreach($data['categories'] as $category): ?>
               <option
               <?php if($data['cat_id'] == $category->id){?>
               selected = 'selected';
               <?php } ?>
                value="<?php echo $category->id; ?>"><?php echo $category->catName; ?></option>
               <?php endforeach; ?>
            </select>
            <span class="invalid-feedback cat_err"><?php echo $data['cat_err']; ?></span>
         </div>
      </div>
      <br>
      <div class="form-group">
         <label for="title">Post Title : <sup>*</sup></label>
         <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" >
         <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
      </div>
      <div class="form-group">
         <label for="body">Body : <sup>*</sup></label>
         <textarea type="text" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['body']; ?></textarea>
         <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
      </div>
      <input type="submit" value="Update" class="btn btn-success">
   </form>
</div>

<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'body' );
  </script>
<?php require APPROOT.'/views/inc/footer.php'; ?>
