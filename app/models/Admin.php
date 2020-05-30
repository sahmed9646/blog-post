<?php 
class Admin{
   private $db;
   public function __construct(){
      $this->db = new Database;
   }

   //find admin by email
   public function findAdminByEmail($email){
      $this->db->query("SELECT * FROM tbl_admin WHERE email = :email");
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      if($this->db->rowCount() > 0){
         return true;
      }else{
         return false;
      }
   }

   public function register($data){
      $this->db->query("INSERT INTO tbl_admin (name, email, password, bio) VALUES(:name, :email, :password, :bio)");

      //bind the values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':bio', $data['bio']);

      //execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }

   public function login($email, $password){
      $this->db->query("SELECT * FROM tbl_admin WHERE email=:email ");
      $this->db->bind(':email', $email);
      $row = $this->db->single();
      $passOriginal = $row->password;
      if (password_verify($password, $passOriginal)) {
         return $row;
      }else{
         return false;
      }
   }
} 