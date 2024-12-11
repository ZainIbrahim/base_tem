<?php
session_start();
spl_autoload_register(function($std)
{
    // require_once "".$std. ".php";
    require_once "../classess/" . $std . ".php";
});
$action = $_POST['action'];
$tbl = "submenus";
function load($tbl)
{
    $std_select = new Base();
    $std_select->selectAll("select_sub");
}

function insert($tbl)
{
    $priv = "SM000";
    $obj = new Base();
    $id = "sub_id";
   $sub_id =  $obj->generate_id($id,$tbl,$priv);
   $user_id = $_SESSION['user_id'];
    extract($_POST);
    $fields = [
        "sub_id"=>"'$sub_id'",
        "name" => "'$name'",
        "link" => "'$link'",
        "menu_id" => "'$menu_id'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_submenus",$fields);
}
function update()
{
    $user_id =  $_SESSION['user_id'];
    extract($_POST);
    $fields = [
        "sub_id"=>"'$sub_id'",
        "name" => "'$name'",
        "link" => "'$link'",
        "menu_id" => "'$menu_id'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_submenus",$fields);
}
function fetch($tbl)
{
    extract($_POST);
    $idL =[
        "sub_id" => $sub_id
    ];
    $std_edit = new Base();
    $result =  $std_edit->fetch($idL,$tbl);
}
function fill($tbl)
{
    extract($_POST);
    $idL =[
        "menu_id" => "",
        "name" => ""
    ];
    $std_edit = new Base();
    $result =  $std_edit->fill("menus",$idL);
}
function del($tbl)
{
    extract($_POST);
    $id =[
        "sub_id" => $sub_id
    ];
    $std_del = new Base();
    $std_del->delete($id,$tbl);
}


if (isset($action)) {
    $action($tbl);
}
