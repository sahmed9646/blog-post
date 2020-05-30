<?php
class User{
   private $db;

   public function __construct(){
      $this->db = new Database;
   }

   //find user by email
   public function findUserByEmail($email){
      $this->db->query("SELECT * FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      if($this->db->rowCount() > 0){
         return true;
      }else{
         return false;
      }
   }

   // register functionality
   public function register($data){
      $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");

      //bind the values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      //execute
      if ($this->db->execute()) {
         return true;
      }else{
         return false;
      }
   }

   // Login functionality
   public function login($email, $password){
      $this->db->query("SELECT * FROM users WHERE email= :email ");
      $this->db->bind(":email", $email);

      $row = $this->db->single();
      $hashed_password = $row->password;
      if (password_verify($password, $hashed_password)) {
         return $row;
      }else{
         return false;
      }
   }

   public function getUserById($id){
      $this->db->query("SELECT * FROM users WHERE id= :id ");
      $this->db->bind(":id", $id);

      $row = $this->db->single();
      return $row;
   }

   public function totalUsers(){
      $this->db->query("SELECT * FROM users");
      $this->db->resultSet();
      if ($this->db->rowCount()) {
         return $this->db->rowCount();
      }
   }

   public function getUsers($startfrom, $perpage){
      $this->db->query("SELECT * FROM users LIMIT :startfrom, :perpage");
      $this->db->bind(':startfrom', $startfrom, PDO::PARAM_INT);
      $this->db->bind(':perpage', $perpage, PDO::PARAM_INT);
      $this->db->execute();
      return $this->db->resultSet();  
   }

   public function searchUsers($search){
      $this->db->query("SELECT * FROM users WHERE name LIKE :search ");
      $this->db->bind(':search', '%'.$search.'%');
      $this->db->execute();
      return $this->db->resultSet();
      // if ($result) {
      //    $value = "";
      //    $value .= '<table class="table table-striped">
      //                <thead thead-inverse bg-dark text-light>
      //                   <tr>
      //                      <th>Name</th>
      //                      <th>Email</th>
      //                   </tr>
      //                </thead> ';
      //    foreach ($result as $searchData) {
      //       $value .= '<tbody>
      //                   <tr>
      //                      <td>'.$searchData->name.'</td>
      //                      <td>'.$searchData->email.'</td>
      //                   </tr>
      //                </tbody>';
      //    }
      //    echo $value;
      // }
   }

   public function search($search){
      echo $search;
   }
}