<?php
session_start();
spl_autoload_register(function($std)
{
    // require_once "".$std. ".php";
    require_once "../classess/" . $std . ".php";
});
$action = $_POST['action'];
$tbl = "menus";
function load($tbl)
{
    $std_select = new Base();
    $std_select->selectAll("select_menu");
}

function insert($tbl)
{
    $priv = "M000";
    $obj = new Base();
    $id = "menu_id";
   $menu_id =  $obj->generate_id($id,$tbl,$priv);
   $user_id = $_SESSION['user_id'];
    // $user_id = 1;
    extract($_POST);
    $fields = [
        "menu_id"=>"'$menu_id'",
        "name" => "'$name'",
        "icon" => "'$icon'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_menus",$fields);
}
function update()
{
    extract($_POST);
    $user_id =$_SESSION['user_id'];
    $fields = [
        "menu_id"=>"'$menu_id'",
        "name" => "'$name'",
        "icon" => "'$icon'",
        "user_id" => "'$user_id'",
        "created_date" => "'$created_date'"
    ];
    $Std_insert = new Base();
    $Std_insert->dml("usp_menus",$fields);
}
function fetch($tbl)
{
    extract($_POST);
    $idL =[
        "menu_id" => $id
    ];
    $std_edit = new Base();
    $result =  $std_edit->fetch($idL,$tbl);
}
function del($tbl)
{
    extract($_POST);
    $id =[
        "menu_id" => $menu_id
    ];
    $std_del = new Base();
    $std_del->delete($id,$tbl);
}


if (isset($action)) {
    $action($tbl);
}
