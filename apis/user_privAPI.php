<?php
session_start();
spl_autoload_register(function($std)
{
    // require_once "".$std. ".php";
    require_once "../classess/" . $std . ".php";
});
$action = $_POST['action'];
$tbl = "auth";
function load($tbl)
{
    $user_id = $_SESSION['user_id'];
    $fields = [
        "user_id"=>"'$user_id'",
    ];
    $std_select = new Base();
    $std_select->selectAllWithfill("select_priv",$fields);
}

function selection($tbl)
{
    // $user_id = 1;
    $user_id = $_SESSION['user_id'];
    $fields = [
        "auth_user"=>$user_id,
    ];
    $std_select = new Base();
    $std_select->selection("select_nav",$fields);
}


function insert($tbl)
{
    $result_data = array();
    $result = "";
    extract($_POST);
    $id =[
        "auth_user" => $user_id
    ];
    $std_del = new Base();
    $std_del->LoopDelete($id,$tbl);
    if(!isset($_POST['actions'])){
        $result_data = array("status" => true, "message" => "User has been revoked authority.");
    }
    else{

        for($i = 0; $i<count($actions); $i++ ){
            $id = $_SESSION['user_id'];
        // $id = 1;
            $date = date('Y-m-d');
            $fields = [
                "menu_id" => "'$menus[$i]'",
                "sub_id" => "'$sub_menus[$i]'",
                "action_id" => "'$actions[$i]'",
                "user_id" => "'$id'",
                "auth_user" => "'$user_id'",
                "created_date" => "'$date'"
            ];
            $Std_insert = new Base($tbl);
            $result = $Std_insert->dml_loop("usp_auth",$fields);
    }
}
if($result == 1){
    $result_data = array("status" => true, "message" => "User has been granted Authority.");
}

echo json_encode($result_data);
}
function fetch($tbl)
{
    extract($_POST);
    $idL =[
        "user_id" => $user_id
    ];
    $std_edit = new Base();
    $std_edit->fetch($idL,$tbl);
}
function fetch_actions($tbl)
{
    extract($_POST);
    $idL =[
        "auth_user" => $user_id
    ];
    $std_edit = new Base();
    $std_edit->fetch_actions($idL,$tbl);
}

function fill($tbl)
{
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $std_select = new Base();
    $feilds = [
        "user_id" =>"'$user_id'",
        "user_name" =>"'$user_id'"
    ];
    $std_select->fill("users",$feilds);
}


function del($tbl)
{
    extract($_POST);
    $id =[
        "action_id" => $action_id
    ];
    $std_del = new Base();
    $std_del->delete($id,$tbl);
}
function check_link(){
    extract($_POST);
    $obj = new Base();
    $obj->cehck_link($user_id,$link); 
}

function user_action_auth_checking(){
    extract($_POST);
    $act = new Base();
    $act->user_action_auth_checking($user_id,$link);
}

if (isset($action)) {
    $action($tbl);
}
