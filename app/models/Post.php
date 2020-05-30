<?php 
class Post{
   private $db;
   public function __construct(){
      $this->db = new Database;
   }

   public function getPosts($startfrom, $perpage){
      $this->db->query("SELECT *,
                        posts.id as postId,
                        users.id as userId,
                        users.name as userName,
                        categories.id as cat_id,
                        posts.cat_id as cat_id,
                        posts.created_at as postCreated,
                        users.created_at as usersCreated
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        INNER JOIN categories
                        ON posts.cat_id = categories.id
                        ORDER BY posts.created_at DESC LIMIT :startfrom, :perpage
                        ");
      $this->db->bind(':startfrom', $startfrom, PDO::PARAM_INT);
      $this->db->bind(':perpage', $perpage, PDO::PARAM_INT);
      $this->db->execute();
      $result = $this->db->resultSet();
      return $result;
   }

   public function addPost($data){
      $this->db->query("INSERT INTO posts (title, user_id, cat_id, body) VALUES(:title, :user_id, :cat_id, :body)");

      // bind the values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':body', $data['body']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':cat_id', $data['cat_id']);

      // execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }

   public function getPostById($id){
      $this->db->query("SELECT * FROM posts WHERE id = :id ");
      $this->db->bind(':id', $id);
      $row = $this->db->single();
      return $row;
   }

   public function updatePost($data){
      $this->db->query("UPDATE posts SET cat_id=:cat_id, title=:title, body=:body WHERE id=:id");

      // bind the values
      $this->db->bind(':cat_id', $data['cat_id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':body', $data['body']);
      $this->db->bind(':id', $data['id']);

      // execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }

   public function deletePost($id){
      $this->db->query("DELETE FROM posts WHERE id=:id");

      // bind the values
      $this->db->bind(':id', $id);

      // execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }

   public function getPostsByCatId($catId){
      $this->db->query('SELECT *,
                        posts.id as postId,
                        users.id as userId,
                        posts.created_at as postCreated
                        FROM posts
                        INNER JOIN users
                        ON
                        posts.user_id = users.id
                        INNER JOIN categories
                        ON
                        posts.cat_id = categories.id
                      WHERE cat_id=:cat_id ');
      $this->db->bind(':cat_id', $catId);
     $result = $this->db->resultSet();
     return $result;
   }

   public function getPostByRandom(){
      $this->db->query("SELECT * FROM posts ORDER BY rand() LIMIT 6 ");
      return $this->db->resultSet();
   }

   public function getPostsLimit6(){
      $this->db->query("SELECT * FROM posts LIMIT 6 ");
      return $this->db->resultSet();
   }

   public function totalPosts(){
      $this->db->query("SELECT * FROM posts");
      $this->db->resultSet();
      if ($this->db->rowCount()) {
         return $this->db->rowCount();
      }
   }
}