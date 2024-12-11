<?php
session_start();
spl_autoload_register(function($std)
{
    // require_once "".$std. ".php";
    require_once "../classess/" . $std . ".php";
});
$action = $_POST['action'];
$tbl = "users";
function load()
{
    $user_id = $_SESSION['user_id'];
    $fields =[
        "user_id"=>"'$user_id'"
    ];
    $std_select = new Base();
    $std_select->selectAllWithfill("usp_select_sup",$fields);
}

function insert($tbl)
{
    $priv = "USR000";
    $obj = new Base();
    $user_id = "user_id";
   $user_id =  $obj->generate_id($user_id,$tbl,$priv);
    extract($_POST);
    $pic = "user.jpg";
    $created_user = $_SESSION['user_id'];
    $fields = [
        "user_id"=>"'$user_id'",
        "user_name" => "'$user_name'",
        "email" => "'$email'",
        "full_name" => "'$full_name'",
        "type"=>"'$type'",
        "password" => "'$password'",
        "img_profile"=>"'$pic'",
        "user_status" => "'$user_status'",
        "created_user"=>"'$created_user'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_users",$fields);
}
function update()
{
    $created_user = $_SESSION['user_id'];
    extract($_POST);
    $fields = [
        "user_id"=>"'$user_id'",
        "user_name" => "'$user_name'",
        "email" => "'$email'",
        "full_name" => "'$full_name'",
        "type"=>"'$type'",
        "password" => "''",
        "img_profile"=>"''",
        "user_status" => "'$user_status'",
        "created_user"=>"'$created_user'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_users",$fields);
}
function update_prof_content($tbl)
{
    extract($_POST);
    $fields = [
        'user_id'=>"'$user_id'",
        "password" => "'$password'",
    ];
    $obj = new Base();
    $obj->dml("update_pass",$fields);
}
function login()
{
    extract($_POST);
     
   $ob = new Base();
   $ob->login($user_name,$password);
}
function fetch($tbl)
{
    extract($_POST);
    $idL =[
        "user_id" => $id
    ];
    $std_edit = new Base();
    $std_edit->fetch($idL,$tbl);
}

function fetch_profile_img($tbl)
{
    $user_id = $_SESSION['user_id'];
    extract($_POST);
    $idL =[
        "user_id" => $user_id
    ];
    $std_edit = new Base();
    $std_edit->fetch($idL,$tbl);
}

function del($tbl)
{
    extract($_POST);
    $id =[
        "user_id" => $user_id
    ];
    $std_del = new Base();
    $std_del->delete($id,$tbl);
}
function img(){
    extract($_POST);
    $obj = new Base();
    $name = $_FILES['file']['name'];
    $user_id = $_POST['id'];
    $obj->img_update($user_id,$name);
}


if (isset($action)) {
    $action($tbl);
}
