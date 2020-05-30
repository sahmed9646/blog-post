<?php require APPROOT.'/views/inc/header.php'; ?>
<?php echo flash('postMsg'); ?>
<style>

</style>
<div class="row mb-3">
   <div class="col-md-6">
      <h1>Posts</h1>
   </div>
   <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
         <i class="fa fa-pencil"></i> Add Post
      </a>
   </div>
</div>

<div class="container container-posts">
   <div>
      <?php foreach($data['posts'] as $post): ?>
      <div class="card card-body overflow mb-3">
         <h4 class="card-title"><?php echo $post->title?><small class="bg-light h6 ml-4 pt-1 pl-3 pr-3 pb-1"><?php echo $post->catName?></small></h4>
         <div class="bg-light p-2 mb-3">
            written by <strong><?php echo $post->userName; ?></strong> on <?php echo $post->postCreated; ?>
         </div>
         <p class="card-text">
            <?php echo textShorten($post->body, 50); ?>
         </p>
         <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Read More</a>
      </div>
      <?php endforeach; ?>

      <!--Pagination -->
      <span class="bg-dark text-center p-2 rounded d-inline float-right mt-2">
         <a href="<?php echo URLROOT; ?>/posts/pagination/1" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light">First Page</a>
         <?php 
         if (isset($data['totalPages'])) {
            for($i=1; $i<=$data['totalPages']; $i++){?>
               <a href="<?php echo URLROOT; ?>/posts/pagination/<?php echo $i; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none border-right border-light"><?php echo $i; ?></a>
         <?php } }?>
         <a href="<?php echo URLROOT; ?>/posts/pagination/<?php echo $data['totalPages']; ?>" class="text-light text-center py-2 px-2 mr-2 ml-2 text-decoration-none">Last Page</a>
      </span>
   </div>
   <div>
   <div class="">
      <div class="category-sidebar mb-3">
         <h2 class="text-center">Categories</h2>
         <hr>
         <ul class="category-ul">
            <?php foreach($data['categories'] as $category): ?>
               <li><a href="<?php echo URLROOT; ?>/posts/postByCat/<?php echo $category->id; ?>"><?php echo $category->catName; ?></a></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <div class="latest-post-area ">
         <h2 class="text-center mt-2">Popular Posts</h2>
         <hr>
         <ul class="populer-ul">
         <?php if (!empty($data['randomPost'])) {?>
            <?php foreach($data['randomPost'] as $randPost): ?>
               <li><a href="<?php echo URLROOT; ?>/posts/show/<?php echo $randPost->id; ?>"><?php echo $randPost->title; ?></a></li>
            <?php endforeach; ?>
         <?php } elseif(!empty($data['posts'])){?>
            <?php foreach($data['posts'] as $randPost): ?>
               <li><a href="<?php echo URLROOT; ?>/posts/show/<?php echo $randPost->id; ?>"><?php echo $randPost->title; ?></a></li>
            <?php endforeach; ?>
         <?php } else{?>    
            <h4 class="lead">No Post Available</h4>
         <?php } ?>   
         </ul>
      </div>
   </div>

 
</div>
 
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
