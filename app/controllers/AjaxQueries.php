<?php
class AjaxQueries extends Controller{
   public function __construct(){
      $this->userModel = $this->model("User");
   }

   public function index(){
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $search = $_POST['search'];
         $getData = $this->userModel->searchUsers($search);
         
         if ($getData) {
         $value = "";
         $value .= '<table class="table table-striped">
                        <tr>
                           <th>Name</th>
                           <th>Email</th>
                        </tr>';
         foreach ($getData as $result) {
            $value .= '<tr>
                           <td>'.$result->name.'</td>
                           <td>'.$result->email.'</td>
                        </tr>';
         }
         echo $value;
         }else{
         echo "data not found";
         }
      }
   }

} 