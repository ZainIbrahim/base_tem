<?php
session_start();
spl_autoload_register(function($std)
{
    // require_once "".$std. ".php";
    require_once "../classess/" . $std . ".php";
});
$action = $_POST['action'];
$tbl = "actions";
function load($tbl)
{
    $std_select = new Base();
    $std_select->selectAll("select_action");
}

function insert($tbl)
{
    $priv = "AC00";
    $obj = new Base();
    $id = "action_id";
   $action_id =  $obj->generate_id($id,$tbl,$priv);
    $user_id = $_SESSION['user_id'];
    extract($_POST);
    $fields = [
        "action_id" => "'$action_id'",
        "name" => "'$name'",
        "sub_id" => "'$sub_id'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_actions",$fields);
}
function update()
{
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $fields = [
        "action_id" => "'$action_id'",
        "name" => "'$name'",
        "sub_id" => "'$sub_id'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_actions",$fields);
}
function fetch($tbl)
{
    extract($_POST);
    $idL =[
        "action_id" => $action_id
    ];
    $std_edit = new Base();
    $std_edit->fetch($idL,$tbl);
}
function fill($tbl)
{
    extract($_POST);
    $idL =[
        "sub_id" => "",
        "name" => ""
    ];
    $std_edit = new Base();
    $result =  $std_edit->fill("submenus",$idL);
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


if (isset($action)) {
    $action($tbl);
}
