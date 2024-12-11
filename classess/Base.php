<?php
header("Content-Type: application/json");
// session_start();
class Base extends Dbase
{
 //sms details creating
 public function sms_details($pr,$fields)
 {
     $implode = implode(",",$fields);
     $result_date = array();
     $query = "EXEC $pr $implode";
     $stat = $this->conn()->prepare($query);
     $stat->execute();
     if ($stat) {
        
            // $result_date = array("status" => true, "message" => " Data has been processed successfully");
            return 1;
         
     } else {
         $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        // return 0;
     }
     // return $test;

     echo json_encode($result_date);
 }

 //dynamic Create and Update Procedure
 public function dml($pr,$fields)
 {
     $implode = implode(",",$fields);
     $result_date = array();
     $query = "EXEC $pr $implode";
     $stat = $this->conn()->prepare($query);
     $stat->execute();
     if ($stat) {
        
            $result_date = array("status" => true, "message" => " Data has been processed successfully");
         
     } else {
         $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
     }
     // return $test;

     echo json_encode($result_date);
 }

 //dynamic Create and Update Procedure with loop
 public function dml_loop($pr,$fields)
 {
     $implode = implode(",",$fields);
     $result_date = array();
     $query = "EXEC $pr $implode";
     $stat = $this->conn()->prepare($query);
     $stat->execute();
     if ($stat) {
        
            return 1;
         
     } else {
         $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
     }
     // return $test;

     echo json_encode($result_date);
 }


 // dynamic insert
    public function insert($fields,$tbl)
    {
       
        try {
            $implode_fields = implode(",", array_keys($fields));
            $implode_fields_place = implode(",:", array_keys($fields));
            // var_dump($implode_fields);
            $sql = "INSERT INTO $tbl($implode_fields) VALUES (:" . $implode_fields_place . ")";
            // echo $sql;
            $stat = $this->conn()->prepare($sql);
            foreach ($fields as $key => $value) {
                $stat->bindValue(":" . $key, $value);
            }
            $result_data = array();
            $result = $stat->execute();
            if ($result) {
                // echo "Inserted success";
                $result_data = array("status" => true, "message" => "User has been saved successfully.");
            } 
        } catch (PDOException $ex) {
            echo $ex->getMessage();
           
        }
        echo json_encode($result_data);
    }
     // dynamic update
    public function update($fields, $ids,$tbl)
    {
        $id = implode(",",$ids);
        $column = implode(",",array_keys($ids));
        $st = "";
        $counter = 1;
        $totalFields = count($fields);
        foreach ($fields as $key => $value) {
            if ($counter === $totalFields) {
                $set = "$key = :" . $key;
                $st = $st . $set;
            } else {
                $set = "$key = :" . $key . ", ";
                $st = $st . $set;
                $counter++;
            }
        }


        $sql = "";
        $sql .= "UPDATE $tbl SET ".$st;
        $sql .= " where $column = :".$column."";
        // var_dump($fields);
        $stmt = $this->conn()->prepare($sql);
        foreach ($fields as $key => $value) {
            $stmt->bindValue(':'. $key, $value);
        }
        $stmt->bindValue(":".$column, $id);
        // var_dump($stmt);
        $stmtExec = $stmt->execute();

        // if($stmtExec){
        // header('Location: index.php');
        // }
        $result_data = array();
        if ($stmtExec) {
            // echo "Inserted success";
            return 1;
        } else {
            //    echo "not inserted";
            $result_data = array("status" => false, "message" => "Data has not been Updated successfully.");
        }
        // var_dump($fields);
        echo json_encode($result_data);
    }
 // dynamic select All with proceduces
    public function selectAll($pr)
    {
        $result_date = array();
        $query = "EXEC $pr";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                $result_date = array("status" => true, "message" => $data);
            }
            else {
                $result_date = array("status" => false, "message" => "Data Not Found");
            }
        } else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }
    //dynamic select All with proceduces
    public function selectAllWithfill($pr,$fields)
    {
        $implode = implode(",",$fields);
        $result_date = array();
        $query = "EXEC $pr $implode";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                $result_date = array("status" => true, "message" => $data);
            }
            else {
                $result_date = array("status" => false, "message" => "Data Not Found");
            }
        } else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }
    // getting row data of number and email for member
    public function get_numANDemail($pr,$fields)
    {
        $implode = implode(",",$fields);
        $query = "EXEC $pr $implode";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            $data = [];
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            }
            else {
               echo "Data Not Found";
            }
        } else {
           echo $this->conn()->pdo->errorInfo();
        }
        // return $test;
    }
   // getting any column oftable with filter
   public function get_column($idl,$fields,$tbl)
   {
       $data = [];
       $implode_id = implode(",",array_keys($idl));
       $column = implode(",",array_keys($fields));
       $id = implode(",",$idl);
       $query = "select $column from $tbl where $implode_id = :id";
       $stat = $this->conn()->prepare($query);
       $stat->execute([':id' => $id]);
       if ($stat) {
        $data = [];
        if($stat->rowCount()){
            while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        else {
         
            $result_date = array("status" => false, "message" =>"Email is not Found");
            echo json_encode($result_date);
        }
    } else {
       echo $this->conn()->pdo->errorInfo();
    }
   }

 //dynamic column count with proceduces
 public function column_count($pr,$id)
 {
    //  $implode = implode(",",$fields);
    //  $result_date = array();
     $query = "EXEC $pr $id";
     $stat = $this->conn()->prepare($query);
     $stat->execute();
     if ($stat) {
         if($stat->rowCount()){
             $row = $stat->fetch(PDO::FETCH_ASSOC);
                 $data = $row;
             
             $result_date = array("status" => true, "message" => $data);
            //  $_SESSION['members_count'] = $data['members'];
         }
         else {
             $result_date = array("status" => false, "message" => "No column count Found");
         }
     } else {
         $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
     }
     // return $test;

     echo json_encode($result_date);
 }




     // dynamic Generate id
    public function generate_id($id,$tbl,$priv)
    {
        $result_date = array();
        $query = "select $id from $tbl order by $id asc";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
           if($stat->rowCount()){
               $user_id = '';
            while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                $user_id= $row[$id];
            }
            $user_id ++;

           
        } else {
           $user_id = $priv."1";
        }
      
    }
        return $user_id;
        echo json_encode($result_date);
    }
     // dynamic fetch
    public function fetch($idl,$tbl)
    {
        $implode_id = implode(",",array_keys($idl));
        $id = implode(",",$idl);
        $query = "select * from $tbl where $implode_id = :id";
        $stat = $this->conn()->prepare($query);
        $stat->execute([':id' => $id]);
        if ($stat) {
                $row = $stat->fetch(PDO::FETCH_ASSOC);
                $result_date = array("status" => true, "message" => $row);
            }
         else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        

        echo json_encode($result_date);
    }

     // fetch user_actions
    public function fetch_actions($idl,$tbl)
    {
        $data = [];
        $implode_id = implode(",",array_keys($idl));
        $id = implode(",",$idl);
        $query = "select * from $tbl where $implode_id = :id";
        $stat = $this->conn()->prepare($query);
        $stat->execute([':id' => $id]);
        if ($stat) {
            while($row = $stat->fetch(PDO::FETCH_ASSOC)){
                $data [] = $row;
            }  
                $result_date = array("status" => true, "message" => $data);
            }
         else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }
     // dynamic fill
    public function fill($tbl,$fields)
    {
        $implode = implode(",",array_keys($fields));
        $result_date = array();
        $query = "select $implode from $tbl";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                $result_date = array("status" => true, "message" => $data);
            }
            else {
                $result_date = array("status" => false, "message" => "Data Not Found");
            }
        } else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }

    // filtering fill
    public function fill_filteration($tbl,$fields)
    {
        $result_date = array();
        $implode = implode(",",$fields);
        $query = "exec $tbl $implode";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                $result_date = array("status" => true, "message" => $data);
                // return $data;
            }
            else {
                $result_date = array("status" => false, "message" => "Data Not Found");
            }
        } else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }
  

     // dynamic delete
    public function delete($idl,$tbl)
    {
        $implode_id = implode(",",array_keys($idl));
        $user_id = implode(",",$idl);
        $result_data = array();
        try {
        $sql = "DELETE FROM $tbl WHERE $implode_id = '$user_id'";
        $res = $this->conn()->prepare($sql);
        $res->execute();
        // return $final;
        if ($res) {
            $result_data = array("status" => true, "message" => "Data has been deleted successfully.");
        } 
    }   
    catch(PDOException $ex){
        //echo $ex->getMessage();
        $result_data = array("status" => false, "message" =>"Failed to delete due to reference");
    }

        echo json_encode(($result_data));
    }

    //  // login function
    public function login($user_name,$password)
    {
        $query = "Exec usp_users_login  '$user_name','$password'";
        $stat = $this->conn()->query($query);
      $result_data = array();
      $stat->execute();

        if ($stat) {

    while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
       if(isset($row['message'])){
           if($row['message']=='invalid'){
            $result_data = array("status" => false, "message" => "Username Or Password is incorrect!");
           }
       }else{
        foreach($row as $key=>$value){
            $_SESSION[$key]=$value;
        }
        // echo $_SESSION['user_name'];
        if($_SESSION['user_status']=='disabled'){
            $result_data = array("status" => true, "message" => "blocked");
        }else{
            $result_data = array("status" => true, "message" => "You Welcome");
        }
        
       }
    }
    }

        echo json_encode($result_data);
    }
     // sidebar selection
    public function selection($sp,$fields)
    {
        $param = implode(",",$fields);
        $query = "Exec $sp  $param";
        $stat = $this->conn()->query($query);
        $result_data = array();
        if ($stat) {
            // $stat->fetch(PDO::FETCH_ASSOC);
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                // $_SESSION['user_id'];
                $result_data = array("status" => true, "message" => $data);

            }else {
                $result_data = array("status" => false, "message" => "Data not found");
            }
       
        } else {
            $result_data = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_data);
    }
     // checking the user current page link
    public function cehck_link($user_id,$link)
    {
        $query = "select DISTINCT(auth.sub_id),submenus.link from auth join submenus on auth.sub_id=submenus.sub_id
        where auth.auth_user='$user_id' and submenus.link='$link'";
        $stat = $this->conn()->query($query);
        $stat->execute();
        // var_dump($stat);
      $result_data = array();

        if ($stat) {
           $result =  $stat->rowCount();
        //    echo $result;
            // $stat->fetch(PDO::FETCH_ASSOC);
            if($stat->rowCount()){

                
                // $_SESSION['user_id'];
                $result_data = array("status" => true, "message" => "valid");
                

            }else {
                $result_data = array("status" => false, "message" => "Data not found");
                // header("Location no.php");
            }
       
        } else {
            $result_data = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_data);
    }

   // checking which action user have
    public function user_action_auth_checking($user_id,$link)
    {
        $result_date = array();
        $query = "exec usp_check_actions $user_id,'$link'";
        $stat = $this->conn()->prepare($query);
        $stat->execute();
        if ($stat) {
            if($stat->rowCount()){
                while ($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                $result_date = array("status" => true, "message" => $data);
            }
            else {
                $result_date = array("status" => false, "message" => "Data Not Found");
            }
        } else {
            $result_date = array("status" => false, "message" =>$this->conn()->pdo->errorInfo());
        }
        // return $test;

        echo json_encode($result_date);
    }
     // Loop delete
    public function LoopDelete($idl,$tbl)
    {
        $implode_id = implode(",",array_keys($idl));
        $user_id = implode(",",$idl);
        $result_data = array();
        $sql = "DELETE FROM $tbl WHERE $implode_id = :user_id";
        $res = $this->conn()->prepare($sql);
        $final =  $res->execute([':user_id' => $user_id]);
        // return $final;
        if ($final) {
            return 1;
        } else {
            return $this->pdo->errorInfo();
        }
        echo json_encode(($result_data));
    }
     // Loop Insert
    public function LoopInsert($fields,$tbl)
    {
       
        try {
            $implode_fields = implode(",", array_keys($fields));
            // var_dump($implode_fields);
            $implode_fields_place = implode(",:", array_keys($fields));
            // var_dump($implode_fields);
            $sql = "INSERT INTO $tbl($implode_fields) VALUES (:" . $implode_fields_place . ")";
            // echo $sql;
            $stat = $this->conn()->prepare($sql);
            foreach ($fields as $key => $value) {
                $stat->bindValue(":" . $key, $value);
            }
            $result = $stat->execute();
            if ($result) {
                // echo "Inserted success";
                return 1;
            } else {
                //    echo "not inserted";
                return $this->pdo->errorInfo();
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        
    }
// update image function
public function img_update($id,$name)
{

/* Getting file name */

 $filename = "$id"."-". $name;
/* Location */
$location = "../uploads/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location, PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg", "jpeg", "png");
/* Check file extension */
if (!in_array(strtolower($imageFileType), $valid_extensions)) {
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo 0;
} else {
    /* Upload file */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        // deleting old user image
        $query = 'select img_profile from users where user_id=:id';
        $result = $this->conn()->prepare($query);
        $result->execute([':id'=>$id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $default_image = '../uploads/user.jpg';
         $file_p = '../uploads/'.$data["img_profile"];;
        if(file_exists($file_p) and $file_p != $default_image){
            unlink($file_p);
        }
        
        $query = "update users set users.img_profile  = '$filename' where users.user_id='$id'";
        $result = $this->conn()->query($query);
        if ($result) {
            $result_d = array();
            $result_d = array("status"=>true,"message"=>"Image Has Been Save Sauccessfully");
        } else {
            // echo "Not";
            $result_d = array("status"=>false,"message"=>$this->conn()->pdo->errorInfo());
        }

        //echo $location;
    } else {
        // echo 0;
        $result_d = array("status"=>true,"message"=>"Image Has Not Been Uploaded Sauccessful");
    }
}
echo json_encode($result_d);
}

}
