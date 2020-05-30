<?php 
class Category{
   private $db;
   public function __construct(){
      $this->db = new Database;
   }

   public function getCategories(){
      $this->db->query("SELECT * FROM categories");
      $result = $this->db->resultSet();
      return $result;
   }

   public function getCategoryById($id){
      $this->db->query("SELECT * FROM categories WHERE id = :id ");
      $this->db->bind(':id', $id);
      return $this->db->single();
   }

   public function totalCategories(){
      $this->db->query("SELECT * FROM categories");
      $this->db->resultSet();
      if ($this->db->rowCount()) {
         return $this->db->rowCount();
      }
   }

   public function addCategory($data){
      $this->db->query("INSERT INTO categories(catName) VALUES(:catName)");
      $this->db->bind(':catName', $data['catName']);
      if($this->db->execute()){
         return true;
      }else{
         return false;
      }
   }

   public function updateCategory($data){
      $this->db->query("UPDATE categories SET catName=:catName WHERE id=:id");
      $this->db->bind(':catName', $data['catName']);
      $this->db->bind(':id', $data['id']);
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }

   }

   public function deleteCategory($id){
      $this->db->query("DELETE FROM categories WHERE id=:id");

      // bind the values
      $this->db->bind(':id', $id);

      // execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }
}
